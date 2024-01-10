<?php 
include "../../../db/config.php";
function MessagePopUp($message, $RedirectTo)
{
	echo "<script>window.location.href='" . $RedirectTo . "';alert('" . $message . "');</script>";
}

if (isset($_GET['tipe'])) {
	// code...
	if ($_GET['tipe'] == "tambah_siswa") {
		// code...

		
		$queryInputSiswa = mysqli_query($konek, "INSERT INTO biodata_siswa(nama, idkelas,idlokal) VALUES ('" . strtolower($_POST['nama']) . "','$_POST[kelas]','$_POST[lokal]')");
		if ($queryInputSiswa) {
			MessagePopUp("Data Siswa Tersimpan", "/smp25solokselatan/siswa-VI/tambah");
		} else {
			MessagePopUp("Data Siswa Tidak Tersimpan", "/smp25solokselatan/siswa-VI/tambah");
		}
	}
}
?>