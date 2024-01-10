<?php 
include "../../../db/config.php";
if (isset($_GET['semester']) && isset($_GET['tahun_ajaran'])) {
    $selectedSemester = $_GET['semester'];
    $selectedTahunAjaran = $_GET['tahun_ajaran'];

    $queryNama = mysqli_query($konek, "SELECT * FROM calon_siswa_teladan JOIN biodata_siswa ON calon_siswa_teladan.id_siswa = biodata_siswa.id_biodata_siswa WHERE calon_siswa_teladan.semester = '$selectedSemester' AND calon_siswa_teladan.tahun_ajaran = '$selectedTahunAjaran'");

    if ($queryNama) {
        while ($row = mysqli_fetch_assoc($queryNama)) {
             $nm = strtoupper($row['nama']);
            echo "
            <tr>
                <td class='px-6 py-4 whitespace-no-wrap text-sm leading-5' >{$nm}</td>
                <td class='px-6 py-4 whitespace-no-wrap text-sm leading-5' >{$row['nilai_rata_rata']}</td>
                <td class='px-6 py-4 whitespace-no-wrap text-sm leading-5' >{$row['jumlah_kehadiran']}</td>
                <td class='px-6 py-4 whitespace-no-wrap text-sm leading-5' >{$row['nilai_keaktifan']}</td>
                <td class='px-6 py-4 whitespace-no-wrap text-sm leading-5' >{$row['semester']}</td>
                <td class='px-6 py-4 whitespace-no-wrap text-sm leading-5' >
                <div class='flex space-x-4'>
                    <a href='#' class='text-red-500 hover:text-red-600'>
                        <svg xmlns='http://www.w3.org/2000/svg' class='w-5 h-5 mr-1 ml-3' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16' />
                        </svg>
                        <p>Delete</p>
                    </a>
                </div>

                </td>
            </tr>";
        }
    } else {
        echo "Error in the query: " . mysqli_error($konek);
    }
} else {
    echo "Invalid parameters provided.";
}
?>
