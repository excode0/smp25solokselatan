<!-- component -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- Favicon -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="assets/images/ic_1.png" type="image/x-icon" />
    <title>SMP 25 SOLOK SELATAN</title>
</head>

<body>
    <div class="flex flex-col">
        <div class="absolute w-full flex justify-center items-cemter bg-gray-800 z-10">
            <div class="flex justify-center items-center p-5">
                <img src="assets/images/ic_1.png" alt="" class="w-[50px] h-[50px]" />
                <span class="whitespace-nowrap text-xl dark:text-white font-bold">SMP 25 SOLOK SELATAN</span>
            </div>
        </div>
        <div class="bg-[assets/images/ic_1.png] min-h-screen flex justify-center items-center filter blur-xl z-0" style="
          background-image: url('assets/images/bg_1.jpg');
          background-repeat: no-repeat;
          background-size: cover;
        ">
        </div>
        <div class="absolute w-full min-h-screen flex justify-center items-center z-20">
            <div class="dark:bg-white p-5 w-[30%] h-[30%] rounded-md ">
                <form id="loginform" method="post" action="prosses.php?tipe=login" class="mb-10">
                    <h1 class="text-3xl font-bold mb-4">LOGIN</h1>
                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                        <input type="text" id="username" name="username" class="border-2 border-gray-300 rounded-md p-2 w-full focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                        <input type="password" id="password" name="password" class="border-2 border-gray-300 rounded-md p-2 w-full focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="w-full flex justify-center items-center">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
                    </div>
                </form>
                <span class="mt-10">Belum Punya Akun ? <a href="http://localhost/homeang/pages/register" class="text-blue-600">Daftar</a></span>

            </div>
        </div>
    </div>
</body>

</html>