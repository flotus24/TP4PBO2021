<?php 

/******************************************
PRAKTIKUM RPL
******************************************/

class Task extends DB{
	
	// Mengambil data
	function getTask(){
		// Query mysql select data ke tb_pegawai
		$query = "SELECT * FROM tb_pegawai";

		// Mengeksekusi query
		return $this->execute($query);
	}
	
	function setTask($tnama, $talamat, $tjenis, $tposisi, $tmasuk, $tstatus){
		// query insert data ke tb to_do
		$query = "INSERT INTO tb_pegawai (nama, alamat, jenis_kelamin, posisi, tgl_masuk, status) values ( '$tnama', '$talamat', '$tjenis', '$tposisi', '$tmasuk', '$tstatus' ) ";

		// Mengeksekusi query
		return $this->execute($query);
		
	}

	function deleteTask($id_hapus){
		// query delete 
		$query = "DELETE FROM tb_pegawai where id = '$id_hapus'";
		// Mengeksekusi query
		return $this->execute($query);
	    // Unset GET
	    unset($_GET['id_hapus']);
	    // refresh
    	header("Location: index.php");
			
	}

	function updateSelesai($id_status){
		// query update selesai
		$query = "UPDATE tb_pegawai SET status = 'Ex-pegawai' where id = '$id_status'";
		// Mengeksekusi query
		return $this->execute($query);
	    // Unset GET
	    unset($_GET['id_status']);
	    // refresh
    	header("Location: index.php");
	}

}



?>
