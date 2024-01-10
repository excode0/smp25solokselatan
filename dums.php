<?php
include "../../../db/config.php";
?>
<?php include '../../layout/sidebar.php' ?>


<div class="min-h-screen grid mb-4 pb-10 px-8 mx-4 rounded-3xl bg-gray-100 border-4 border-[#4287f5]">
    <div class="col-span-12 mt-5">
        <div class="grid gap-2 grid-cols-1 lg:grid-cols-1">
            <div class="bg-white p-4 shadow-lg rounded-lg">
                <div class="flex justify-between ">
                    <div>
                        <h1 class="font-bold text-base">Table Daftar Seleksi Siswa Teladan</h1>
                    </div>
                    <div>
                        <a href="siswa-teladan/tambah-siswa"> Tambah Siswa</a>
                    </div>

                </div>

                <?php
                // Fungsi TOPSIS
                $normalizedData = [];
                function topsis($siswa, $bobot)
                {
                    // Ekstrak atribut yang relevan dari data siswa
                    $nilai_rata_rata = $siswa['nilai_rata_rata'];
                    $jumlah_kehadiran = $siswa['jumlah_kehadiran'];
                    $jumlah_keaktifan = $siswa['jumlah_keaktifan'];

                    // Normalisasi data (asumsikan nilai dalam persentase)
                    $nilai_rata_rata_normalisasi = $nilai_rata_rata / 100;
                    $jumlah_kehadiran_normalisasi = $jumlah_kehadiran / 100;
                    $jumlah_keaktifan_normalisasi = $jumlah_keaktifan / 100;
                    echo "Normalisasi : ".$nilai_rata_rata_normalisasi;
                    // Hitung nilai terbobot yang dinormalisasi
                    $nilai_terbobot_rata = $nilai_rata_rata_normalisasi * $bobot['nilai_rata_rata'];
                    $nilai_terbobot_kehadiran = $jumlah_kehadiran_normalisasi * $bobot['jumlah_kehadiran'];
                    $nilai_terbobot_keaktifan = $jumlah_keaktifan_normalisasi * $bobot['jumlah_keaktifan'];
                    
                    // Solusi Ideal Positif
                    $solusi_ideal_positif = [
                        'nilai_rata_rata' => 1,  // Asumsikan 100% adalah yang terbaik
                        'jumlah_kehadiran' => 1,   // Asumsikan 100% adalah yang terbaik
                        'jumlah_keaktifan' => 1    // Asumsikan 100% adalah yang terbaik
                    ];

                    // Solusi Ideal Negatif
                    $solusi_ideal_negatif = [
                        'nilai_rata_rata' => 0,  // Asumsikan 0% adalah yang terburuk
                        'jumlah_kehadiran' => 0,   // Asumsikan 0% adalah yang terburuk
                        'jumlah_keaktifan' => 0    // Asumsikan 0% adalah yang terburuk
                    ];

                    // Hitung jarak Euclidean
                    $jarak_positif = hitungJarakEuclidean($siswa, $solusi_ideal_positif);
                    $jarak_negatif = hitungJarakEuclidean($siswa, $solusi_ideal_negatif);

                    // Hitung kedekatan relatif
                    $kedekatan_relatif = $jarak_negatif / ($jarak_negatif + $jarak_positif);
                    echo "kedekatan_relatif : ".$kedekatan_relatif;
                    return $kedekatan_relatif;
                }

                function hitungJarakEuclidean($siswa, $solusiIdeal)
                {
                    $jumlah = 0;
                    foreach ($solusiIdeal as $kriteria => $nilai) {
                        $jumlah += pow($siswa[$kriteria] - $nilai, 2);
                    }
                    return sqrt($jumlah);
                }
                ?>
                <div class="mt-4">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto">
                            <div class="py-2 align-middle inline-block min-w-full">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    <div class="flex cursor-pointer">
                                                        <span class="mr-2">Nama Siswa</span>
                                                    </div>
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    <div class="flex cursor-pointer">
                                                        <span class="mr-2">Nilai Rata-Rata</span>
                                                    </div>
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    <div class="flex cursor-pointer">
                                                        <span class="mr-2">Jumlah Kehadiran</span>
                                                    </div>
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    <div class="flex cursor-pointer">
                                                        <span class="mr-2">Jumlah Keaktifan</span>
                                                    </div>
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    <div class="flex cursor-pointer">
                                                        <span class="mr-2">ACTION</span>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <?php
                                           
                                            $weights = ['nilai_rata_rata' => 0.4, 'jumlah_kehadiran' => 0.3, 'jumlah_keaktifan' => 0.3];

                                            $queryDataSiswa = mysqli_query($konek, "SELECT *
                                                                            FROM calon_siswa_teladan
                                                                            JOIN biodata_siswa ON calon_siswa_teladan.id_siswa = biodata_siswa.id_biodata_siswa
                                                                            JOIN kelas ON biodata_siswa.idkelas = kelas.id_kelas 
                                                                            JOIN lokal ON biodata_siswa.idlokal = lokal.id_lokal");
                                            while ($dataSiswa = mysqli_fetch_array($queryDataSiswa)) {
                                                $topsisValue = topsis($dataSiswa, $weights);
                                            ?>
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <p><?php echo $dataSiswa['nama']; ?></p>
                                                        <p class="text-xs text-gray-400"><?php echo $dataSiswa['nama_kelas'] . "-" . $dataSiswa['nama_lokal']; ?>
                                                        </p>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <p><?php echo $dataSiswa['nilai_rata_rata']; ?></p>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <div class="flex text-green-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            <p><?php echo $dataSiswa['jumlah_kehadiran']; ?></p>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <div class="flex text-green-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            <p><?php echo $dataSiswa['jumlah_keaktifan']; ?></p>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <div class="flex space-x-4">
                                                            <a href="#" class="text-blue-500 hover:text-blue-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                </svg>
                                                                <p>Edit</p>
                                                            </a>
                                                            <a href="#" class="text-red-500 hover:text-red-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                                <p>Delete</p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../layout/endmain.php' ?>


<?php
// Konfigurasi koneksi ke database
include "../../../db/config.php";

// Step 1: Mengambil data dari tabel data_sample
$queryDataSiswa = mysqli_query($konek, "SELECT * FROM data_sample");

// Simpan data siswa ke dalam array
$siswaSet = [];
// $siswaSetNormalisasi = [];
while ($dataSiswa = mysqli_fetch_assoc($queryDataSiswa)) {
    $siswaSet[] = $dataSiswa;
    // $siswaSetNormalisasi[] = $dataSiswa;
}

print_r($siswaSet);
echo "<br>";


// echo "nilai Pembagi Normalisasi : ".sqrt($nilaiPembagi);
function normalizationSet($data)
{
    $nilaiPembagi = [
        "nilai_rata_raport" => 0.0,
        "jumlah_kehadiran" => 0.0,
        "jumlah_keaktifan" => 0.0,
    ];
    foreach ($data as $siswa) {
        $nilaiPembagi['nilai_rata_raport'] = $nilaiPembagi['nilai_rata_raport'] + ($siswa['nilai_rata_raport'] ** 2);
        $nilaiPembagi['jumlah_kehadiran'] = $nilaiPembagi['jumlah_kehadiran'] + ($siswa['jumlah_kehadiran'] ** 2);
        $nilaiPembagi['jumlah_keaktifan'] = $nilaiPembagi['jumlah_keaktifan'] + ($siswa['jumlah_keaktifan'] ** 2);
    }
    $dataSetNormalisasi = [];
    foreach ($data as $siswa) {
        $SetNormalisasi = [
            "id_sample" => $siswa['id_sample'],
            "idsiswa" => $siswa['idsiswa'],
            "nilai_rata_raport" => number_format($siswa['nilai_rata_raport'] / sqrt($nilaiPembagi['nilai_rata_raport']), 4, '.', ''),
            "jumlah_kehadiran" => number_format($siswa['jumlah_kehadiran'] / sqrt($nilaiPembagi['jumlah_kehadiran']), 4, '.', ''),
            "jumlah_keaktifan" => number_format($siswa['jumlah_keaktifan'] / sqrt($nilaiPembagi['jumlah_keaktifan']), 4, '.', ''),
        ];
        $dataSetNormalisasi[] = $SetNormalisasi;
    }
    return $dataSetNormalisasi;
}

function normalizationAndWeightSet($dataX)
{
    $bobotKriteria = [
        "nilai_rata_raport" => 0.2,
        "jumlah_kehadiran" => 0.5,
        "jumlah_keaktifan" => 0.3,
    ];

    $dataSetNormalisasiAndWeight = [];
    foreach ($dataX as $data) {
        $SetNormalisasi = [
            "id_sample" => $data['id_sample'],
            "idsiswa" => $data['idsiswa'],
            "nilai_rata_raport" => number_format($data['nilai_rata_raport'] * $bobotKriteria['nilai_rata_raport'], 4, '.', ''),
            "jumlah_kehadiran" => number_format($data['jumlah_kehadiran'] * $bobotKriteria['jumlah_kehadiran'], 4, '.', ''),
            "jumlah_keaktifan" => number_format($data['jumlah_keaktifan'] * $bobotKriteria['jumlah_keaktifan'], 4, '.', ''),
        ];
        $dataSetNormalisasiAndWeight[] = $SetNormalisasi;
    }
    return $dataSetNormalisasiAndWeight;
}
function MaxAndMinSet($dataX)
{

    $maxValues = [];
    $minValues = [];


    foreach ($dataX as $siswa) {
        foreach ($siswa as $kriteria => $nilai) {
            if (!isset($maxValues[$kriteria]) || $nilai > $maxValues[$kriteria]) {
                $maxValues[$kriteria] = $nilai;
            }

            if (!isset($minValues[$kriteria]) || $nilai < $minValues[$kriteria]) {
                $minValues[$kriteria] = $nilai;
            }
        }
    }

    // Menampilkan hasil
    // echo "Nilai Tertinggi:<br>";
    // print_r($maxValues);
    $minmaxSet = [
        "Max_data" => $maxValues,
        "Min_data" => $minValues,
    ];
    // echo "<br><br>Nilai Terendah:<br>";
    // print_r($minValues);
    return $minmaxSet;
}
function setPositifData($dataX, $dataPositif)
{
    $dataSetPositif = [];
    foreach ($dataX as $data) {
        $nrr =  ($data['nilai_rata_raport'] - $dataPositif['nilai_rata_raport']) ** 2;
        $jk =  ($data['jumlah_kehadiran'] - $dataPositif['jumlah_kehadiran']) ** 2;
        $jkn =  ($data['jumlah_keaktifan'] - $dataPositif['jumlah_keaktifan']) ** 2;
        $hasilPositif = sqrt($nrr + $jk + $jkn);
        $SetPositif = [
            "id_sample" => $data['id_sample'],
            "idsiswa" => $data['idsiswa'],
            "nilai_rata_raport" => number_format($nrr, 4, '.', ''),
            "jumlah_kehadiran" => number_format($jk, 4, '.', ''),
            "jumlah_keaktifan" => number_format($jkn, 4, '.', ''),
            "Hasil_positif" => number_format($hasilPositif, 4, '.', ''),
        ];
        $dataSetPositif[] = $SetPositif;
    }
    return $dataSetPositif;
}
function setNegatifData($dataX, $dataNegatif)
{
    $dataSetNegatif = [];
    foreach ($dataX as $data) {
        $nrr =  ($data['nilai_rata_raport'] - $dataNegatif['nilai_rata_raport']) ** 2;
        $jk =  ($data['jumlah_kehadiran'] - $dataNegatif['jumlah_kehadiran']) ** 2;
        $jkn =  ($data['jumlah_keaktifan'] - $dataNegatif['jumlah_keaktifan']) ** 2;
        $hasilNegatif = sqrt($nrr + $jk + $jkn);
        $SetNegatif = [
            "id_sample" => $data['id_sample'],
            "idsiswa" => $data['idsiswa'],
            "nilai_rata_raport" => number_format($nrr, 4, '.', ''),
            "jumlah_kehadiran" => number_format($jk, 4, '.', ''),
            "jumlah_keaktifan" => number_format($jkn, 4, '.', ''),
            "Hasil_negatif" => number_format($hasilNegatif, 4, '.', ''),
        ];
        $dataSetNegatif[] = $SetNegatif;
    }
    return $dataSetNegatif;
}
function setPreferensi($dataX, $dataPositif, $dataNegatif)
{
    $dataSetPreferensi = [];
    $indexs = 0;
    foreach ($dataX as $data) {
        $SetPref = [
            "id_sample" => $data['id_sample'],
            "idsiswa" => $data['idsiswa'],
            "Hasil_pref" =>$dataNegatif[$indexs]['Hasil_negatif']/($dataNegatif[$indexs]['Hasil_negatif']+$dataPositif[$indexs]['Hasil_positif']),
        ];
        // echo "<br>";
        // print_r($dataPositif[$indexs]['Hasil_positif']);
        // echo "<br>";
        // print_r($dataNegatif[$indexs]['Hasil_negatif']);
        $indexs = $indexs + 1;
        $dataSetPreferensi[] = $SetPref;
    }
    return $dataSetPreferensi;
}
echo "<br>";
echo "<br>";
echo "DATA NORMALISASI";
echo "<br>";
print_r(normalizationSet($siswaSet));
echo "<br>";
echo "<br>";
echo "DATA NORMALISASI DENGAN BOBOT";
echo "<br>";
$dataNormalisasi = normalizationSet($siswaSet);
print_r(normalizationAndWeightSet($dataNormalisasi));
echo "<br>";
echo "<br>";
$resultNormalizationWeight = normalizationAndWeightSet($dataNormalisasi);
$resultMaxAndMinValue = MaxAndMinSet($resultNormalizationWeight);
$resultPositifValue = setPositifData($resultNormalizationWeight, $resultMaxAndMinValue['Max_data']);
$resultNegatifValue = setNegatifData($resultNormalizationWeight, $resultMaxAndMinValue['Min_data']);
print_r($resultPositifValue);

echo "<br>";
echo "<br>";
print_r($resultNegatifValue);

echo "<br>";
echo "<br>";
$resultPreferensi = setPreferensi($resultNormalizationWeight, $resultPositifValue, $resultNegatifValue);
print_r($resultPreferensi);
// print_r($resultMaxAndMinValue['Min_data']['nilai_rata_raport']);
// Tutup koneksi ke database
