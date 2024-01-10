<?php
include "../../../db/config.php";
?>
<?php include '../../layout/sidebar.php' ?>


<div class="min-h-screen grid mb-4 pb-10 px-8 mx-4 rounded-3xl bg-gray-100 border-4 border-[#4287f5]">
    <div class="col-span-12 mt-5">
        <div class="grid gap-2 grid-cols-1 lg:grid-cols-1">
            <div class="bg-white p-4 shadow-lg rounded-lg"><div class="w-full flex justify-center items-center">
                    <h1 class="font-bold text-base">Table Daftar Siswa VIII</h1>
                </div>
                <div>
                    <label for="lokal" class="block text-gray-600 text-sm font-medium mb-2">Lokal : </label>
                    <select id="lokal" name="lokal" class="form-select w-[10%] rounded-md p-2" onclick="getDataTabel()">
                        <?php 
                            $queryLokal = mysqli_query($konek, "SELECT * FROM lokal WHERE idkelas = 2");

                            if ($queryLokal) {
                                while ($row = mysqli_fetch_assoc($queryLokal)) {
                                    echo "<option value='" . $row['id_lokal'] . "'>" . strtoupper($row['nama_lokal']) . "</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
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
                                                        <span class="mr-2">Kelas</span>
                                                    </div>
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    <div class="flex cursor-pointer">
                                                        <span class="mr-2">Lokal</span>
                                                    </div>
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    <div class="flex cursor-pointer">
                                                        <span class="mr-2">ACTION</span>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="data-tabel-siswa">
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

<script>
    function getDataTabel() {
        console.log("Function called!");
        var selectedlokal = document.getElementById("lokal").value;
        var dataSiswaTabel = document.getElementById('data-tabel-siswa');

        // Use AJAX to fetch data for the Lokal dropdown
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                dataSiswaTabel.innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "/smp25solokselatan/siswa-IX/get_data_tabel?lokal=" + selectedlokal, true);
        xhttp.send();
    }
</script>
<?php include '../../layout/endmain.php' ?>