<!-- component -->
<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <!-- Favicon -->
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="icon" href="assets/images/ic_1.png" type="image/x-icon" />
  <title>SMP 25 SOLOK SELATAN</title>
</head>

<body>
  <div class="flex flex-col">
    <div class="absolute w-full flex justify-center items-cemter bg-gray-800">
      <div class="flex justify-center items-center p-5">
        <img src="assets/images/ic_1.png" alt="" class="w-[50px] h-[50px]" />
        <span class="whitespace-nowrap text-xl dark:text-white font-bold">SMP 25 SOLOK SELATAN</span>
      </div>
    </div>
    <div class="bg-[assets/images/ic_1.png] min-h-screen grid grid-cols-2 gap-5 justify-center items-center" style="
          background-image: url('assets/images/bg_1.jpg');
          background-repeat: no-repeat;
          background-size: cover;
        ">
      <div class="min-h-screen dark:text-white text-xl p-20 flex flex-col justify-center">
        <span class="text-5xl font-bold">SMP 25 SOLOK SELATAN</span>
        <span>SMP negeri ini berdiri sejak 1910. Sekarang SMP Negeri 25 Solok
          Selatan memakai panduan kurikulum belajar pemerintah yaitu SMP
          2013</span>
        <a href="login" class="bg-blue-600 rounded-md w-[100px] p-2 flex justify-center items-center mt-5">LOGIN</a>
      </div>
      <div id="imageContainer" class="p-20 flex justify-center items-center w-full h-full relative">
        <div class="flex bg-white rounded-md w-[70%] justify-center items-center h-[50%] relative border-4 border-sky-500">
          <!-- Tempat untuk menampilkan gambar -->
          <img id="currentImage" class="w-full h-full object-cover rounded-md" src="" alt="">
          <div id="nextImageContainer" class="absolute right-0 bottom-0 border-4 border-sky-500">
            <!-- Tempat untuk menampilkan gambar kecil berikutnya -->
          </div>
        </div>

      </div>

    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const images = ["/smp25solokselatan/assets/images/g1.webp", "/smp25solokselatan/assets/images/g2.webp", "/smp25solokselatan/assets/images/g3.webp"]; // Ganti dengan nama file gambar sesuai dengan kebutuhan
      const imageContainer = document.getElementById("imageContainer");
      const currentImageElement = document.getElementById("currentImage");
      const nextImageContainer = document.getElementById("nextImageContainer");

      let currentIndex = 0;

      function updateImage() {
        // Hapus konten yang ada di dalam container
        nextImageContainer.innerHTML = "";

        // Tambahkan elemen <img> untuk menampilkan gambar berikutnya kecil
        const nextImageElement = document.createElement("img");
        nextImageElement.src = images[(currentIndex + 1) % images.length];
        nextImageElement.alt = `Next Image`;
        nextImageElement.classList.add("w-20", "h-20", "object-cover", "border-1", "border-white", "cursor-pointer");

        // Tampilkan gambar kecil di dalam container
        nextImageContainer.appendChild(nextImageElement);

        // Tambahkan event click untuk memperbarui gambar utama
        nextImageElement.addEventListener("click", function() {
          currentIndex = (currentIndex + 1) % images.length;
          updateImage();
        });

        // Tambahkan elemen <img> untuk menampilkan gambar utama
        currentImageElement.src = images[currentIndex];
        currentImageElement.alt = `Current Image`;
        currentImageElement.classList.add("w-full", "h-full", "object-cover", "rounded-md");

        // Tambahkan efek fadeIn (jika diperlukan)
        currentImageElement.style.animation = "fadeIn 1s ease-in-out";
      }

      // Atur interval untuk memperbarui gambar setiap beberapa detik
      setInterval(updateImage, 3000); // Ganti angka 3000 dengan interval waktu dalam milidetik (misalnya, 5000 untuk 5 detik)
    });
  </script>
</body>

</html>