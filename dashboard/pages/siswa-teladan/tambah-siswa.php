<?php
include "../../../db/config.php";
?>
<?php include '../../layout/sidebar.php' ?>

<div class="min-h-screen grid mb-4 pb-10 px-8 mx-4 rounded-3xl bg-gray-100 border-4 border-[#4287f5] overflow-auto">
    <div class="col-span-12 mt-5">
        <div class="grid gap-2 grid-cols-1 lg:grid-cols-1">
            <div class="bg-white p-8 rounded shadow-md w-full">
                <h1 class="text-2xl font-semibold mb-6">Form Calon Siswa Teladan</h1>

                <form action="../siswa-teladan/prosses?tipe=tambah_calon_siswa_teladan" method="post">
                    <!-- Kelas Dropdown -->
                    <div class="mb-4">
                        <label for="kelas" class="block text-gray-600 text-sm font-medium mb-2">Kelas</label>
                        <select id="kelas" name="kelas" class="form-select w-full rounded-md  p-2" onclick="getLokalData()">
                            <?php
                            // Koneksi ke database (gantilah sesuai dengan konfigurasi Anda)

                            // Query untuk mendapatkan data kelas
                            $queryKelas = mysqli_query($konek, "SELECT * FROM kelas");

                            // Periksa apakah query berhasil dijalankan
                            if ($queryKelas) {
                                // Loop untuk menampilkan opsi dropdown
                                while ($row = mysqli_fetch_assoc($queryKelas)) {
                                    echo "<option value='" . $row['id_kelas'] . "'>" . $row['nama_kelas'] . "</option>";
                                }
                            } else {
                                echo "Error in the query: " . mysqli_error($koneksi);
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Lokal Dropdown -->
                    <div class="mb-6">
                        <label for="lokal" class="block text-gray-600 text-sm font-medium mb-2">Lokal</label>
                        <select id="lokal" name="lokal" class="form-select w-full rounded-md  p-2" onclick="getBiodata()"></select>
                    </div>
                    
                    <!-- Lokal Dropdown -->
                    <div class="mb-6">
                        <label for="tahun_ajaran" class="block text-gray-600 text-sm font-medium mb-2">Tahun Ajaran</label>
                        <select id="tahun_ajaran" name="tahun_ajaran" class="form-select w-full rounded-md  p-2" onclick="getBiodata()">
                            <option value="2018" selected>2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>
                    </div>

                    <!-- Nama -->
                    <div class="mb-6">
                        <label for="idsiswa" class="block text-gray-600 text-sm font-medium mb-2">Nama</label>
                        <select id="idsiswa" name="idsiswa" class="form-select w-full rounded-md  p-2"></select>
                    </div>


                    <div class="mb-4">
                        <label for="n_rata" class="block text-gray-600 text-sm font-medium mb-2">Nilai Rata-Rata</label>
                        <input type="number" id="n_rata" name="n_rata" class="form-input w-full rounded-md  p-2" placeholder="Masukkan Rata-Rata" step="0.01">
                    </div>

                    <div class="mb-4">
                        <label for="jml_kehadiran" class="block text-gray-600 text-sm font-medium mb-2">Jumlah Kehadiran</label>
                        <input type="number" id="jml_kehadiran" name="jml_kehadiran" class="form-input w-full rounded-md p-2" placeholder="Masukkan Jumlah Kehadiran">
                    </div>

                    <div class="mb-4">
                        <label for="jml_keaktifan" class="block text-gray-600 text-sm font-medium mb-2">Jumlah Keaktifan</label>
                        <input type="number" id="jml_keaktifan" name="jml_keaktifan" class="form-input w-full rounded-md p-2" placeholder="Masukkan Jumlah Keaktifan">
                    </div>

                    <div class="mb-4">
                        <label for="semester" class="block text-gray-600 text-sm font-medium mb-2">Semester</label>
                        <select id="semester" name="semester" class="form-select w-full rounded-md p-2">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                        </select>
                    </div>


                    <!-- Tombol Submit -->
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function getLokalData() {
        console.log("Function called!");
        var selectedKelas = document.getElementById("kelas").value;
        var lokalDropdown = document.getElementById("lokal");

        // Use AJAX to fetch data for the Lokal dropdown
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                lokalDropdown.innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "../siswa-teladan/get_lokal_data?kelas=" + selectedKelas, true);
        xhttp.send();
    }

    function getBiodata() {
        console.log("Function GetBiodata called!");
        var selectedKelas = document.getElementById("kelas").value;
        var selectedLokal = document.getElementById("lokal").value;
        var selectedTahunAjaran = document.getElementById("tahun_ajaran").value;
        var namaDropdown = document.getElementById("idsiswa");

        // Use AJAX to fetch data for the Nama dropdown
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                namaDropdown.innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "../siswa-teladan/get_nama_data?kelas=" + selectedKelas + "&lokal=" + selectedLokal+ "&tahun_ajaran=" + selectedTahunAjaran, true);
        xhttp.send();
    }
</script>

<?php include '../../layout/endmain.php' ?>