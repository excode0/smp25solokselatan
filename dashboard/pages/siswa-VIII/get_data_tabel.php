<?php
include "../../../db/config.php";

if (isset($_GET['lokal'])) {
    $selectedlokal = $_GET['lokal'];

    $queryDataSiswa = mysqli_query($konek, "SELECT * FROM biodata_siswa JOIN kelas ON biodata_siswa.idkelas = kelas.id_kelas 
    JOIN lokal ON biodata_siswa.idlokal = lokal.id_lokal WHERE biodata_siswa.idlokal = $selectedlokal");
    if ($queryDataSiswa) {
        $i = 0;
        while ($row = mysqli_fetch_assoc($queryDataSiswa)) {
            if (($i % 2) == 0) {
                echo "<tr class='bg-gray-200'>";
            } else {
                echo "<tr class='bg-gray-100'>";
            }

            echo "<td class='px-6 py-4 whitespace-no-wrap text-sm leading-5'>
                                                        <p>". strtoupper($row['nama']). "</p>
                                                        <!-- <p class='text-xs text-gray-400'>PC & Laptop -->
                                                        </p>
                                                    </td>
                                                    <td class='px-6 py-4 whitespace-no-wrap text-sm leading-5'>
                                                        <p>". $row['nama_kelas']. "</p>
                                                    </td>
                                                    <td class='px-6 py-4 whitespace-no-wrap text-sm leading-5'>
                                                        <div class='flex '>
                                                            <!-- <svg xmlns='http://www.w3.org/2000/svg' class='w-5 h-5 mr-1' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' />
                                                            </svg> -->
                                                            <p>". strtoupper($row['nama_lokal']). "</p>
                                                        </div>
                                                    </td>
                                                    <td class='px-6 py-4 whitespace-no-wrap text-sm leading-5'>
                                                        <div class='flex space-x-4'>
                                                            <form class='text-blue-500 hover:text-blue-600' action='/smp25solokselatan/kelas/edit-siswa?tipe=edit_siswa' method='post'>

                                                                <button href='#'>
                                                                    <svg xmlns='http://www.w3.org/2000/svg' class='w-5 h-5 mr-1' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                                                        <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z' />
                                                                    </svg>
                                                                    <input name='id_siswa' class='hidden' type='text' value='". $row['id_biodata_siswa']. "'>
                                                                    <input name='alamat' class='hidden' type='text' value='siswa-IX'>
                                                                    <p>Edit</p>
                                                                </button>
                                                            </form>
                                                            <form class='text-red-500 hover:text-red-600' action='/smp25solokselatan/kelas/prosses?tipe=hapus_siswa' method='post'>
                                                                <button type='submit'>
                                                                    <svg xmlns='http://www.w3.org/2000/svg' class='w-5 h-5 mr-1 ml-3' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                                                        <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16' />
                                                                    </svg>
                                                                    <input name='id_siswa' class='hidden' type='text' value='". $row['id_biodata_siswa']. "'>
                                                                    <input name='alamat' class='hidden' type='text' value='siswa-IX'>
                                                                    <p>Delete</p>
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </td>";


            echo "</tr>";

            $i++;
        }
    } else {
        echo "Error in the query: " . mysqli_error($konek);
    }
} else {
    echo "No 'lokal' parameter provided.";
}
