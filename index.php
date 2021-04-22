<?php

/******************************************
PRAKTIKUM RPL
******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

if (isset($_POST['add'])) {
	$nama = $_POST['tnama'];
	$detail = $_POST['talamat'];
	$subject = $_POST['tjenis'];
	$priority = $_POST['tposisi'];
	$deadline = $_POST['tmasuk'];
	$status = "Bekerja";

	$otask->setTask($nama, $detail, $subject, $priority, $deadline, $status);
}

if (isset($_GET['id_hapus'])) {
	$id = $_GET['id_hapus'];
	$otask->deleteTask($id);

}

if(isset($_GET['id_status'])){
	$id = $_GET['id_status'];
	$otask->updateSelesai($id);
}

// Memanggil method getTask di kelas Task
$otask->getTask();

// Proses mengisi tabel dengan data
$data = null;
$no = 1;

while (list($id, $tnama, $talamat, $tjenis, $tposisi, $tmasuk, $tstatus) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if($tstatus == "Ex-pegawai"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tnama . "</td>
		<td>" . $talamat . "</td>
		<td>" . $tjenis . "</td>
		<td>" . $tposisi . "</td>
		<td>" . $tmasuk . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger' name = 'btn_hapus'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika status task nya belum dikerjakan
	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tnama . "</td>
		<td>" . $talamat . "</td>
		<td>" . $tjenis . "</td>
		<td>" . $tposisi . "</td>
		<td>" . $tmasuk . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger' name = 'btn_hapus'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' name = 'status'><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}



// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();