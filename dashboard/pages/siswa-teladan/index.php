<?php
include "../../../db/config.php";
?>
<?php include '../../layout/sidebar.php' ?>

<div class="min-h-screen grid mb-4 pb-10 px-8 mx-4 rounded-3xl bg-gray-100 border-4 border-[#4287f5]">
    <div class="col-span-12 mt-5">
        <div class="grid gap-2 grid-cols-1 lg:grid-cols-1">
            <div class="bg-white p-4 shadow-lg rounded-lg">
                <div class="flex justify-center items-center">
                    <div>
                        <h1 class="font-bold text-base">Table Daftar Seleksi Siswa Teladan</h1>
                    </div>
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
                                                        <span class="mr-2">Nilai Topsis</span>
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
                                           
                                            $weights = ['nilai_rata_raport' => 0.4, 'jumlah_kehadiran' => 0.3, 'jumlah_keaktifan' => 0.3];

                                            $queryDataSiswa = mysqli_query($konek, "SELECT *
                                                                            FROM siswa_teladan 
                                                                            JOIN calon_siswa_teladan ON siswa_teladan.id_calon_siswa_teladan = calon_siswa_teladan.id_calon_siswa_teladan
                                                                            JOIN biodata_siswa ON calon_siswa_teladan.id_siswa = biodata_siswa.id_biodata_siswa");
                                            while ($dataSiswa = mysqli_fetch_array($queryDataSiswa)) {
                                            ?>
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <p><?php echo strtoupper($dataSiswa['nama']); ?></p>
                                                        <p class="text-gray-500">Semester : <?php echo $dataSiswa['semester']."-".$dataSiswa['tahun_ajaran']; ?></p>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <p><?php echo $dataSiswa['nilai_rata_rata']; ?></p>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <div class="flex ">
                                                            <p><?php echo $dataSiswa['jumlah_kehadiran']; ?></p>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <div class="flex ">
                                                            <p><?php echo $dataSiswa['nilai_keaktifan']; ?></p>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <div class="flex text-green-500">
                                                            <p><?php echo $dataSiswa['topsis_value']; ?></p>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                        <div class="flex space-x-4">
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