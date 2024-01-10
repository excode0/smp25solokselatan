<?php
include "../../../db/config.php";


sleep(3);
// Ambil data dari tabel calon_siswa_teladan
$sql = "SELECT * FROM calon_siswa_teladan WHERE semester=$_GET[semester] AND tahun_ajaran=$_GET[tahun_ajaran]";
$result = mysqli_query($konek, $sql);

// Simpan data dalam bentuk array
$dataSiswaArray = array();
while ($dataSiswa = mysqli_fetch_assoc($result)) {
    $dataSiswaArray[] = $dataSiswa;
}

// Mendefinisikan bobot untuk setiap kriteria
$weightKeaktifan = 0.3;
$weightKehadiran = 0.5;
$weightRataRata = 0.2;

// Matriks keputusan
$matrix = array();
foreach ($dataSiswaArray as $dataSiswa) {
    $matrix[] = array(
        'keaktifan' => $dataSiswa['nilai_keaktifan'],
        'kehadiran' => $dataSiswa['jumlah_kehadiran'],
        'rata_rata' => $dataSiswa['nilai_rata_rata']
    );
}
// Normalisasi matriks keputusan

$normalizedMatrixTotal = array(
    'keaktifan' => 0,
    'kehadiran' => 0,
    'rata_rata' => 0);
foreach ($matrix as $row) {
    $normalizedMatrixTotal['keaktifan'] += pow($row['keaktifan'], 2);
    $normalizedMatrixTotal['kehadiran'] += pow($row['kehadiran'], 2);
    $normalizedMatrixTotal['rata_rata'] += pow($row['rata_rata'], 2);
    // $normalizedMatrixTotal['kehadiran'] = $normalizedMatrixTotal['kehadiran'] + ($row['kehadiran']*$row['kehadiran']);
    // $normalizedMatrixTotal['rata_rata'] = $normalizedMatrixTotal['rata_rata'] + ($row['rata_rata']*$row['rata_rata']);
}
$normalizedMatrixTotal['keaktifan'] = $resultFormatted = number_format(sqrt($normalizedMatrixTotal['keaktifan']), 4, '.', '');
$normalizedMatrixTotal['kehadiran'] = $resultFormatted = number_format(sqrt($normalizedMatrixTotal['kehadiran']), 4, '.', '');
$normalizedMatrixTotal['rata_rata'] = $resultFormatted = number_format(sqrt($normalizedMatrixTotal['rata_rata']), 4, '.', '');
// var_dump($normalizedMatrixTotal);
$normalizedMatrix = array();
foreach ($matrix as $row) {

    $normalizedRow = array(
        'keaktifan' => number_format($row['keaktifan'] / $normalizedMatrixTotal['keaktifan'], 4, '.', ''),
        'kehadiran' => number_format($row['kehadiran'] / $normalizedMatrixTotal['kehadiran'], 4, '.', ''),
        'rata_rata' => number_format($row['rata_rata'] / $normalizedMatrixTotal['rata_rata'], 4, '.', ''),
    );
    $normalizedMatrix[] = $normalizedRow;
}
$weightedMatrix = array();
foreach ($normalizedMatrix as $row) {
    $weightedRow = array(
        'keaktifan' => number_format($row['keaktifan'] * $weightKeaktifan, 4, '.', ''),
        'kehadiran' => number_format($row['kehadiran'] * $weightKehadiran, 4, '.', ''),
        'rata_rata' => number_format($row['rata_rata'] * $weightRataRata, 4, '.', ''),
    );
    $weightedMatrix[] = $weightedRow;
}

// Solusi ideal positif dan negatif
$positiveIdeal = array(
    'keaktifan' => max(array_column($weightedMatrix, 'keaktifan')),
    'kehadiran' => max(array_column($weightedMatrix, 'kehadiran')),
    'rata_rata' => max(array_column($weightedMatrix, 'rata_rata')),
);
$negativeIdeal = array(
    'keaktifan' => min(array_column($weightedMatrix, 'keaktifan')),
    'kehadiran' => min(array_column($weightedMatrix, 'kehadiran')),
    'rata_rata' => min(array_column($weightedMatrix, 'rata_rata')),
);

// // Hitung jarak relatif
$positiveDistances = array();
$negativeDistances = array();
foreach ($weightedMatrix as $row) {
    $positiveDistances[] = number_format(sqrt(
        pow($row['keaktifan'] - $positiveIdeal['keaktifan'], 2) +
        pow($row['kehadiran'] - $positiveIdeal['kehadiran'], 2) +
        pow($row['rata_rata'] - $positiveIdeal['rata_rata'], 2)
    ), 4, '.', '');

    $negativeDistances[] = number_format(sqrt(
        pow($row['keaktifan'] - $negativeIdeal['keaktifan'], 2) +
        pow($row['kehadiran'] - $negativeIdeal['kehadiran'], 2) +
        pow($row['rata_rata'] - $negativeIdeal['rata_rata'], 2)
    ), 4, '.', '');
}

// // Hitung nilai akhir
$topsisValues = array();
for ($i = 0; $i < count($dataSiswaArray); $i++) {
    $sql = "SELECT * FROM calon_siswa_teladan JOIN biodata_siswa ON calon_siswa_teladan.id_siswa = biodata_siswa.id_biodata_siswa WHERE id_calon_siswa_teladan=".  $dataSiswaArray[$i]['id_calon_siswa_teladan']." ";
    $result = mysqli_query($konek, $sql);
    $data = mysqli_fetch_assoc($result);
    $topsisValues[] = array(
        'id_calon_siswa_teladan' => $dataSiswaArray[$i]['id_calon_siswa_teladan'],
        'nama_siswa' => strtoupper($data['nama']),
        'nilai_rata_rata' => strtoupper($data['nilai_rata_rata']),
        'jumlah_kehadiran' => strtoupper($data['jumlah_kehadiran']),
        'nilai_keaktifan' => strtoupper($data['nilai_keaktifan']),
        'distance_positive' => $positiveDistances[$i],
        'distance_negative' => $negativeDistances[$i],
        'topsis_value' => number_format(($positiveDistances[$i] + $negativeDistances[$i] !== 0) ? $negativeDistances[$i] / ($positiveDistances[$i] + $negativeDistances[$i]) : ($negativeDistances[$i] === 0 ? 0 : 1), 4, '.', ''),
    );
}

// // Sorting nilai TOPSIS dari yang terbaik ke yang terburuk
usort($topsisValues, function ($a, $b) {
    return $a['topsis_value'] <=> $b['topsis_value'];
});

// Menampilkan hasil
// foreach ($topsisValues as $siswa) {
//     echo "ID Calon Siswa Teladan: " . $siswa['id_calon_siswa_teladan'] . "<br>";
//     echo "TOPSIS Value: " . $siswa['topsis_value'] . "<br>";
//     echo "<hr>";
// }
header('Content-Type: application/json');
echo json_encode($topsisValues);
?>
