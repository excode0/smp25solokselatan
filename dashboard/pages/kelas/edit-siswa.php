<?php
include "../../../db/config.php";
?>
<?php include '../../layout/sidebar.php' ?>

<div class="min-h-screen grid mb-4 pb-10 px-8 mx-4 rounded-3xl bg-gray-100 border-4 border-[#4287f5]">
    <div class="col-span-12 mt-5">
        <div class="grid gap-2 grid-cols-1 lg:grid-cols-1">
            <div class="bg-white p-8 rounded shadow-md w-full">
                <h1 class="text-2xl font-semibold mb-6">Form Siswa</h1>
                
                <form action="../kelas/prosses?tipe=edit_siswa" method="post">
                    <!-- Nama -->
                    <?php 
                    if(isset($_GET['tipe']) && $_GET['tipe'] == "edit_siswa") {
                        // Use prepared statements to prevent SQL injection
                        $stmt = mysqli_prepare($konek, "SELECT * FROM biodata_siswa 
                                                            JOIN kelas ON biodata_siswa.idkelas = kelas.id_kelas 
                                                            JOIN lokal ON biodata_siswa.idlokal = lokal.id_lokal
                                                            WHERE biodata_siswa.id_biodata_siswa = ?");

                        mysqli_stmt_bind_param($stmt, "i", $_POST['id_siswa']);
                        mysqli_stmt_execute($stmt);

                        $queryDataSiswa = mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);

                        while ($dataSiswa = mysqli_fetch_array($queryDataSiswa)) {
                            // Use $dataSiswa to pre-fill the form fields
                        
                    
                    ?>
                    <input type="text" class="hidden" name="id_siswa" value="<?php echo $_POST['id_siswa']; ?>">
                    <input name="alamat" class="hidden" type="text" value="<?php echo $_POST['alamat']; ?>">
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-600 text-sm font-medium mb-2">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-input w-full rounded-md p-2" placeholder="Masukkan nama" value="<?php echo isset($dataSiswa['nama']) ? $dataSiswa['nama'] : ''; ?>">
                    </div>

                    <!-- Kelas Dropdown -->
                    <div class="mb-4">
                        <label for="kelas" class="block text-gray-600 text-sm font-medium mb-2">Kelas</label>
                        <select id="kelas" name="kelas" class="form-select w-full rounded-md p-2" onchange="getLokalData()">
                            <?php
                            $queryKelas = mysqli_query($konek, "SELECT * FROM kelas");

                            if ($queryKelas) {
                                while ($row = mysqli_fetch_assoc($queryKelas)) {
                                    $selected = ($row['id_kelas'] == $dataSiswa['idkelas']) ? 'selected' : '';
                                    echo "<option value='" . $row['id_kelas'] . "' $selected>" . $row['nama_kelas'] . "</option>";
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
                        <select id="lokal" name="lokal" class="form-select w-full rounded-md p-2">
                            <?php
                            $queryLokal = mysqli_query($konek, "SELECT * FROM lokal");

                            if ($queryLokal) {
                                while ($row = mysqli_fetch_assoc($queryLokal)) {
                                    $selected = ($row['id_lokal'] == $dataSiswa['idlokal']) ? 'selected' : '';
                                    echo "<option value='" . $row['id_lokal'] . "' $selected>" . $row['nama_lokal'] . "</option>";
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
                    <?php }}?>
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

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                lokalDropdown.innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "../kelas/get_lokal_data?kelas=" + encodeURIComponent(selectedKelas), true);
        xhttp.send();
    }
</script>

<?php include '../../layout/endmain.php' ?>
