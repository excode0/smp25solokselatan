<?php
include "../../../db/config.php";

if (isset($_GET['kelas']) && isset($_GET['lokal'])) {
    
    echo 'console.log("Function INSIDE GetBiodata called!");';
    $selectedKelas = $_GET['kelas'];
    $selectedLokal = $_GET['lokal'];
    $selectedTahunAjaran = $_GET['tahun_ajaran'];

    $queryNama = mysqli_query($konek, "SELECT * FROM biodata_siswa WHERE idkelas = '$selectedKelas' AND idlokal = '$selectedLokal' AND tahun_ajaran = '$selectedTahunAjaran'");

    if ($queryNama) {
        while ($row = mysqli_fetch_assoc($queryNama)) {
            echo "<option value='" . $row['id_biodata_siswa'] . "'>" . $row['nama'] . "</option>";
        }
    } else {
        echo "Error in the query: " . mysqli_error($konek);
    }
} else {
    echo "Invalid parameters provided.";
}
?>
