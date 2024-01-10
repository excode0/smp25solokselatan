<?php 
include "../../../db/config.php";
function MessagePopUp($message, $RedirectTo)
{
	echo "<script>window.location.href='" . $RedirectTo . "';alert('" . $message . "');</script>";
}

if (isset($_GET['tipe'])) {
	// code...
	// if ($_GET['tipe'] == "tambah_siswa_teladan") {
	// 	// code...
	// 	$queryInputDataSample = mysqli_query($konek, "INSERT INTO data_sample(idsiswa, nilai_rata_raport, jumlah_kehadiran, jumlah_keaktifan)
    //      VALUES ('$_POST[idsiswa]','$_POST[n_rata]','$_POST[jml_kehadiran]','$_POST[jml_keaktifan]')");
	// 	if ($queryInputDataSample) {
	// 		MessagePopUp("Data Seleksi Siswa Tersimpan", "/smp25solokselatan/siswa-teladan/tambah-siswa");
	// 	} else {
	// 		MessagePopUp("Data Seleksi Siswa Tersimpan", "/smp25solokselatan/siswa-teladan/tambah-siswa");
	// 	}
	// }
	if ($_GET['tipe'] == "tambah_calon_siswa_teladan") {
		// code...
		$queryInputDataSample = mysqli_query($konek, "INSERT INTO calon_siswa_teladan(id_siswa, nilai_rata_rata, jumlah_kehadiran, nilai_keaktifan, semester,tahun_ajaran)
         VALUES ('$_POST[idsiswa]','$_POST[n_rata]','$_POST[jml_kehadiran]','$_POST[jml_keaktifan]','$_POST[semester]','$_POST[tahun_ajaran]')");
		if ($queryInputDataSample) {
			MessagePopUp("Data Seleksi Siswa Tersimpan", "/smp25solokselatan/siswa-teladan/tambah-siswa");
		} else {
			MessagePopUp("Data Seleksi Siswa Tersimpan", "/smp25solokselatan/siswa-teladan/tambah-siswa");
		}
	}else if ($_GET['tipe'] == "tambah_siswa_teladan") {
		// code...
		$queryInputDataSample = mysqli_query($konek, "INSERT INTO siswa_teladan(id_calon_siswa_teladan, distance_positive, distance_negative, topsis_value)
         VALUES ('$_POST[id_siswa_teladan]','$_POST[jarak_positif]','$_POST[jarak_negative]','$_POST[nilai_topsis]')");
		if ($queryInputDataSample) {
			MessagePopUp("Data Seleksi Siswa Tersimpan", "/smp25solokselatan/siswa-teladan");
		} else {
			MessagePopUp("Data Seleksi Siswa Tersimpan", "/smp25solokselatan/siswa-teladan");
		}
	}

}
?>