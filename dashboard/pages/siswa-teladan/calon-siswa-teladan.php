<?php
include "../../../db/config.php";
?>
<?php include '../../layout/sidebar.php' ?>


<div class="min-h-screen grid mb-4 pb-10 px-8 mx-4 rounded-3xl bg-gray-100 border-4 border-[#4287f5] z-30">
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
                <form action="/smp25solokselatan/calon-siswa-teladan/prosses/topsis" method="POST">
                    <div class="grid grid-cols-6 p-2 gap-5">
                        <div class="w-full">
                            <label>Pilih Semester : </label>
                            <select name="semester" id="semester" class="form-select w-full rounded-md  p-2 mr-2" onclick="getSiswaTeladanData()">
                                <option value="1">1</option>
                                <option value="1">2</option>
                            </select>
                        </div>
                        <div class="w-full">
                            <label>Pilih tahun ajaran : </label>
                            <select id="tahun_ajaran" name="tahun_ajaran" class="form-select w-full rounded-md  p-2" onclick="getSiswaTeladanData()">
                                <option value="2018" selected>2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>
                        <div class="w-full">
                            <label>Penentuan Siswa Teladan :</label>
                            <button type="submit" class="bg-blue-600 rounded-md p-2 dark:text-white font-bold">PROSESS</button>
                        </div>
                    </div>
                </form>
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
                                                        <span class="mr-2">Nilai Keaktifan</span>
                                                    </div>
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    <div class="flex cursor-pointer">
                                                        <span class="mr-2">Semester</span>
                                                    </div>
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    <div class="flex cursor-pointer">
                                                        <span class="mr-2">ACTION</span>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="tabel-siswa-teladan">
                                            <!-- <tr>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                    <p></p>
                                                    <p class="text-xs text-gray-400">
                                                    </p>
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                    <p></p>
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                    <div class="flex text-green-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <p></p>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                    <div class="flex text-green-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <p></p>
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
                                            </tr> -->
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
    function getSiswaTeladanData() {
        // console.log("Function called!");
        var selectedSemester = document.getElementById("semester").value;
        var selectedTahunAjaran = document.getElementById("tahun_ajaran").value;
        var tabelSiswaTeladan = document.getElementById("tabel-siswa-teladan");

        // Use AJAX to fetch data for the Lokal dropdown
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                tabelSiswaTeladan.innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "/smp25solokselatan/siswa-teladan/get_data_table?semester=" + selectedSemester + "&tahun_ajaran=" + selectedTahunAjaran, true);
        xhttp.send();
    }
</script>


<?php include '../../layout/endmain.php' ?>