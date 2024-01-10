<?php
include "../db/config.php";
include 'akses.php';
?>
<?php include 'layout/sidebar.php' ?>

<!-- Main Content -->
<div class="min-h-screen flex flex-col mb-4 pb-10 px-8 mx-4 rounded-3xl bg-gray-100 border-4 border-[#4287f5]">
    <div class="relative mt-5 grid grid-cols-3 gap-5">
        <!-- Jumlah semua siswa -->
        <div class="bg-white text-gray-800 p-5 rounded-md flex flex-col justify-center items-center">
            <span class="text-lg font-semibold">Jumlah Semua Siswa</span>
            <?php

            // Query untuk mendapatkan jumlah semua siswa
            $queryTotalStudents = mysqli_query($konek, "SELECT COUNT(*) as total_students FROM biodata_siswa");
            $totalStudentsData = mysqli_fetch_assoc($queryTotalStudents);
            $totalStudents = $totalStudentsData['total_students'];

            // Menampilkan jumlah siswa di dalam span
            echo '<span class="text-2xl font-bold">' . $totalStudents . '</span>';
            ?>
        </div>

        <!-- Jumlah calon siswa teladan -->
        <div class="bg-white text-gray-800 p-5 rounded-md flex flex-col justify-center items-center">
            <span class="text-lg font-semibold">Jumlah Calon Siswa Teladan</span>
            <?php
            // Query untuk mendapatkan jumlah calon siswa teladan
            $queryTotalCandidates = mysqli_query($konek, "SELECT COUNT(*) as total_candidates FROM calon_siswa_teladan");
            $totalCandidatesData = mysqli_fetch_assoc($queryTotalCandidates);
            $totalCandidates = $totalCandidatesData['total_candidates'];

            // Menampilkan jumlah calon siswa teladan di dalam span
            echo '<span class="text-2xl font-bold">' . $totalCandidates . '</span>';
            ?>
        </div>

        <!-- Jumlah siswa teladan -->
        <div class="bg-white text-gray-800 p-5 rounded-md flex flex-col justify-center items-center">
            <span class="text-lg font-semibold">Siswa Teladan</span>
            <?php
            // Query untuk mendapatkan jumlah siswa teladan
            $queryTotalOutstanding = mysqli_query($konek, "SELECT COUNT(*) as total_outstanding FROM siswa_teladan");
            $totalOutstandingData = mysqli_fetch_assoc($queryTotalOutstanding);
            $totalOutstanding = $totalOutstandingData['total_outstanding'];

            // Menampilkan jumlah siswa teladan di dalam span
            echo '<span class="text-2xl font-bold">' . $totalOutstanding . '</span>';
            ?>
        </div>
    </div>


    <div class="relative mt-5 grid grid-cols-1 gap-5">
        <div class="w-full bg-white text-black p-5 rounded-md flex flex-col justify-center items-center">
            <span>More Informations</span>
            <div class="flex flex-col mt-6 w-full">
                <div class="overflow-x-auto rounded-lg">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden shadow sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                <thead class="bg-gray-50 dark:bg-gray-200">
                                    <tr>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-black uppercase dark:text-gray-900">
                                            Kelas
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-black uppercase dark:text-gray-900">
                                            Jumlah Lokal
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-black uppercase dark:text-gray-900">
                                            Jumlah Siswa
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-white">
                                    <tr class="bg-gray-50 dark:bg-gray-100">
                                        <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap ">
                                            <span class="font-semibold">Kelas VII</span>
                                        </td>
                                        <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-gray-900">
                                            <?php

                                            // Query untuk mendapatkan jumlah semua siswa
                                            $queryTotallokal = mysqli_query($konek, "SELECT COUNT(*) as total_lokal FROM lokal WHERE idkelas=1");
                                            $totallokalData = mysqli_fetch_assoc($queryTotallokal);
                                            $totallokal = $totallokalData['total_lokal'];

                                            // Menampilkan jumlah siswa di dalam span
                                            echo  $totallokal;
                                            ?>
                                        </td>
                                        <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap ">
                                            <?php

                                            // Query untuk mendapatkan jumlah semua siswa
                                            $queryTotalStudents = mysqli_query($konek, "SELECT COUNT(*) as total_students FROM biodata_siswa WHERE idkelas=1");
                                            $totalStudentsData = mysqli_fetch_assoc($queryTotalStudents);
                                            $totalStudents = $totalStudentsData['total_students'];

                                            // Menampilkan jumlah siswa di dalam span
                                            echo  $totalStudents;
                                            ?>
                                        </td>

                                    </tr>
                                    <tr class="bg-gray-50 dark:bg-gray-200">
                                        <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap ">
                                            <span class="font-semibold">Kelas VIII</span>
                                        </td>
                                        <td class="p-4 text-sm font-normal text-black whitespace-nowrap dark:text-gray-900">
                                            <?php

                                            // Query untuk mendapatkan jumlah semua siswa
                                            $queryTotallokal = mysqli_query($konek, "SELECT COUNT(*) as total_lokal FROM lokal WHERE idkelas=1");
                                            $totallokalData = mysqli_fetch_assoc($queryTotallokal);
                                            $totallokal = $totallokalData['total_lokal'];

                                            // Menampilkan jumlah siswa di dalam span
                                            echo  $totallokal;
                                            ?>
                                        </td>
                                        <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap ">
                                            <?php

                                            // Query untuk mendapatkan jumlah semua siswa
                                            $queryTotalStudents = mysqli_query($konek, "SELECT COUNT(*) as total_students FROM biodata_siswa WHERE idkelas=2");
                                            $totalStudentsData = mysqli_fetch_assoc($queryTotalStudents);
                                            $totalStudents = $totalStudentsData['total_students'];

                                            // Menampilkan jumlah siswa di dalam span
                                            echo  $totalStudents;
                                            ?>
                                        </td>

                                    </tr>
                                    <tr class="bg-gray-50 dark:bg-gray-100">
                                        <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap ">
                                            <span class="font-semibold">Kelas IX</span>
                                        </td>
                                        <td class="p-4 text-sm font-normal text-black whitespace-nowrap dark:text-gray-900">
                                            <?php

                                            // Query untuk mendapatkan jumlah semua siswa
                                            $queryTotallokal = mysqli_query($konek, "SELECT COUNT(*) as total_lokal FROM lokal WHERE idkelas=1");
                                            $totallokalData = mysqli_fetch_assoc($queryTotallokal);
                                            $totallokal = $totallokalData['total_lokal'];

                                            // Menampilkan jumlah siswa di dalam span
                                            echo  $totallokal;
                                            ?>
                                        </td>
                                        <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap ">
                                            <?php

                                            // Query untuk mendapatkan jumlah semua siswa
                                            $queryTotalStudents = mysqli_query($konek, "SELECT COUNT(*) as total_students FROM biodata_siswa WHERE idkelas=3");
                                            $totalStudentsData = mysqli_fetch_assoc($queryTotalStudents);
                                            $totalStudents = $totalStudentsData['total_students'];

                                            // Menampilkan jumlah siswa di dalam span
                                            echo  $totalStudents;
                                            ?>
                                        </td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table -->


    </div>


</div>
<?php include 'layout/endmain.php' ?>