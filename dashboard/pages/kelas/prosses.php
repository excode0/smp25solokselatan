<?php 
include "../../../db/config.php";
function MessagePopUp($message, $RedirectTo)
{
	echo "<script>window.location.href='" . $RedirectTo . "';alert('" . $message . "');</script>";
}

if (isset($_GET['tipe'])) {
	// code...
	if ($_GET['tipe'] == "tambah_lokal") {
		// code...
		
		$queryInputGuru = mysqli_query($konek, "INSERT INTO lokal(nama_lokal, idkelas) VALUES ('" . strtolower($_POST['nama_lokal']) . "','$_POST[kelas]')");
		if ($queryInputGuru) {
			MessagePopUp("Data Guru Tersimpan", "/smp25solokselatan/kelas/lokal");
		} else {
			MessagePopUp("Data Guru Tidak Tersimpan", "/smp25solokselatan/kelas/lokal");
		}
	}else if ($_GET['tipe'] == "tambah_siswa") {
		// code...

		$queryInputSiswa = mysqli_query($konek, "INSERT INTO biodata_siswa(nama, idkelas,idlokal) VALUES ('" . strtolower($_POST['nama']) . "','$_POST[kelas]','$_POST[lokal]')");
		if ($queryInputSiswa) {
			MessagePopUp("Data Siswa Tersimpan", "/smp25solokselatan/kelas/tambah-siswa");
		} else {
			MessagePopUp("Data Siswa Tidak Tersimpan", "/smp25solokselatan/kelas/tambah-siswa");
		}
	}else if ($_GET['tipe'] == "hapus_siswa") {
		// code...
		$queryHapussiswa = mysqli_query($konek, "DELETE FROM biodata_siswa WHERE id_biodata_siswa='$_POST[id_siswa]'");
		if ($queryHapussiswa) {
			MessagePopUp("Data Hapus Siswa Tersimpan", "/smp25solokselatan"."/".$_POST['alamat']."");
		} else {
			MessagePopUp("Data Hapus Siswa Tidak Tersimpan", "/smp25solokselatan"."/".$_POST['alamat']."");
		}
	}else if ($_GET['tipe'] == "edit_siswa") {
		// code...
		$queryEditSiswa = mysqli_query($konek, "UPDATE biodata_siswa SET nama='" . strtolower($_POST['nama']) . "', idkelas='$_POST[kelas]',idlokal='$_POST[lokal]' WHERE id_biodata_siswa='$_POST[id_siswa]'");
		if ($queryEditSiswa) {
			MessagePopUp("Data Edit Siswa Tersimpan", "/smp25solokselatan"."/".$_POST['alamat']."");
		} else {
			MessagePopUp("Data Edit Siswa Tidak Tersimpan", "/smp25solokselatan"."/".$_POST['alamat']."");
		}
	}
}
?>