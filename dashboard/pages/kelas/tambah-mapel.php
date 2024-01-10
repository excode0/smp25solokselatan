<?php
include "../../../db/config.php";
?>
<?php include '../../layout/sidebar.php' ?>

<div class="min-h-screen grid mb-4 pb-10 px-8 mx-4 rounded-3xl bg-gray-100 border-4 border-[#4287f5]">
    <div class="col-span-12 mt-5">
        <div class="grid gap-2 grid-cols-1 lg:grid-cols-1">
            <div class="bg-white p-8 rounded shadow-md w-full">
                <h1 class="text-2xl font-semibold mb-6">Form Mapel</h1>

                <form action="../kelas/prosses?tipe=tambah_mapel" method="post">
                    <!-- Nama lokal -->
                    <div class="mb-4">
                        <label for="nama_mapel" class="block text-gray-600 text-sm font-medium mb-2">Nama Mapel</label>
                        <input type="text" id="nama_mapel" name="nama_mapel" class="form-input w-full rounded-md" placeholder="Masukkan nama mapel">
                    </div>

                    <!-- Kelas Dropdown -->
                    <div class="mb-4">
                        <label for="kelas" class="block text-gray-600 text-sm font-medium mb-2">Kelas</label>
                        <select id="kelas" name="kelas" class="form-select w-full rounded-md">
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

                   

                    <!-- Tombol Submit -->
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include '../../layout/endmain.php' ?>