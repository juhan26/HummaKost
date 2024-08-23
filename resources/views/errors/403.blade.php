<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white flex items-center justify-center h-screen">
    <div class="text-center mx-4 sm:mx-8 lg:mx-0">
        <!-- Gambar 404 -->
        <div class="relative inline-block">
            <img src="{{ asset('images/403.png') }}" alt="404 Image" class="mx-auto" width="658.3px" height="298.81">
        </div>

        <!-- Pesan Error -->
        <h1 class="text-2xl font-bold text-gray-800 mb-2" style="color: #20B486;">ANDA TIDAK MEMILIKI AKSES UNTUK MEMBUKA HALAMAN INI!!</h1>
        <a href="/" class="mt-4 inline-block text-white px-8 py-3 rounded-full shadow-lg" style="background-color: #20B486">Kembali ke Beranda</a>
    </div>
</body>
</html>
