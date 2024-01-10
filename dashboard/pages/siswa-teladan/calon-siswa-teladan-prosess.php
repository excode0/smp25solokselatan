<?php include "../../../db/config.php"; ?>
<?php include '../../layout/sidebar.php' ?>

<div class="min-h-screen  mb-4 pb-10 px-8 mx-4 rounded-3xl bg-gray-100 border-4 border-[#4287f5] z-30">
    <div id="loading-container" class="w-full h-screen flex justify-center items-center">
        <img src="/smp25solokselatan/assets/images/block_loading.gif" alt="Loading...">
        <p>Mohon tunggu, sedang memproses...</p>
    </div>
    <div class="col-span-12 mt-5" id="results-container" class="hidden">
        <div class="grid gap-2 grid-cols-1 lg:grid-cols-1">
            <div class="bg-white p-4 shadow-lg rounded-lg">
                <h1 class="font-bold text-base text-2xl">Table Hasil Prosses Metode Topsis</h1>
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
                                                        <span class="mr-2">Jarak Positif</span>
                                                    </div>
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    <div class="flex cursor-pointer">
                                                        <span class="mr-2">Jarak Negativ</span>
                                                    </div>
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    <div class="flex cursor-pointer">
                                                        <span class="mr-2">TOPSIS</span>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="result-topsis">

                                        </tbody>
                                    </table>
                                    <div class="bg-gray-700 flex flex-col mt-10 justify-beetwen ">
                                        <div class="p-5" id="kesimpulan">
                                        </div>
                                        <div class="p-5 flex justify-end items-end">
                                            <form method="POST" action="/smp25solokselatan/siswa-teladan/prosses?tipe=tambah_siswa_teladan" id="form-hasil">
                                                

                                            </form>
                                        </div>
                                    </div>
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
<input type="text" id="getSemester" value="<?php echo $_POST['semester'];?>" class="hidden">
<input type="text" id="getTahunAjaran" value="<?php echo $_POST['tahun_ajaran'];?>" class="hidden">
<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch(`topsis/start?semester=${document.getElementById('getSemester').value} &tahun_ajaran=${document.getElementById('getTahunAjaran').value}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('loading-container').style.display = 'none';
                document.getElementById('results-container').style.display = 'block';

                var resultsContainer = document.getElementById('result-topsis');
                var kesimpulanContainer = document.getElementById('kesimpulan');
                var formHasilContainer = document.getElementById('form-hasil');
                data.sort((a, b) => b.topsis_value - a.topsis_value);
                data.forEach(siswa => {
                    resultsContainer.innerHTML += `
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">${siswa.nama_siswa}</td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">${siswa.nilai_rata_rata}</td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">${siswa.jumlah_kehadiran}</td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">${siswa.nilai_keaktifan}</td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">${siswa.distance_positive}</td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">${siswa.distance_negative}</td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">${siswa.topsis_value}</td>
                    </tr>
                    
                `;
                });
                var siswaTerbaik = data[0];
                kesimpulanContainer.innerHTML += `<span class="text-lg dark:text-white">Kesimpulan : Dari Hasil Penentuan Dengan metode Topsis Siswa yang menjadi siswa teladan di SMP 25 SOLOK SELATAN ialah <span class="font-bold">"${siswaTerbaik.nama_siswa}"</span> dengan Nilai Topsis <span class="font-bold">${siswaTerbaik.topsis_value} </span></span> `;
                
                formHasilContainer.innerHTML +=`<input type="text" name="id_siswa_teladan" class="hidden" value=${siswaTerbaik.id_calon_siswa_teladan}>
                                                <input type="text" name="jarak_positif" class="hidden" value=${siswaTerbaik.distance_positive}>
                                                <input type="text" name="jarak_negative" class="hidden" value=${siswaTerbaik.distance_negative}>
                                                <input type="text" name="nilai_topsis" class="hidden" value=${siswaTerbaik.topsis_value}>
                                                <button type="submit" class="bg-blue-600 rounded-md p-2 dark:text-white font-bold">SIMPAN</button>`;
            
            })
            .catch(error => console.error('Error fetching data:', error));
    });
</script>