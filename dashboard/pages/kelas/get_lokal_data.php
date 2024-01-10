<?php
include "../../../db/config.php";

if (isset($_GET['kelas'])) {
    $selectedKelas = $_GET['kelas'];

    $queryLokal = mysqli_query($konek, "SELECT * FROM lokal WHERE idkelas = $selectedKelas");

    if ($queryLokal) {
        while ($row = mysqli_fetch_assoc($queryLokal)) {
            echo "<option value='" . $row['id_lokal'] . "'>" . $row['nama_lokal'] . "</option>";
        }
    } else {
        echo "Error in the query: " . mysqli_error($konek);
    }
} else {
    echo "No 'kelas' parameter provided.";
}
?>
