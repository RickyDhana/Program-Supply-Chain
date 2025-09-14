<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT PAL</title>

    {{-- CDN untuk TailwindCSS dan Phosphor Icons --}}
    {{-- Ini wajib ada di dalam <head> agar desain dan ikon muncul --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body class="bg-[#0a1730] text-white min-h-screen flex justify-center items-center">

    <div class="max-w-screen-xl w-full m-0 sm:m-10 bg-[#1c2e55] shadow sm:rounded-lg flex flex-1">

        {{-- BAGIAN KIRI: FORM LOGIN --}}
        <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12 flex flex-col justify-center items-center">
            {{-- Path gambar menggunakan helper 'asset()' dari Laravel --}}
            <img src="{{ asset('images/pal-logo.png') }}" class="w-60 mb-16" alt="Logo PT PAL" />
            {{--
                Form ini:
                1. Mengirim data ke route Laravel 'login'.
                2. Menggunakan token @csrf untuk keamanan.
                3. Input username diubah menjadi 'name' agar sesuai dengan backend Anda.
            --}}
            <form action="{{ route('login') }}" method="POST" class="w-full max-w-xs">
                @csrf

                {{-- Input Username --}}
                <div class="relative mb-2">
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                        <i class="ph ph-user text-gray-400"></i>
                    </div>
                    <input
                        class="w-full px-8 py-4 pr-12 rounded-lg font-medium bg-transparent border border-gray-600 placeholder-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="text"
                        name="name" {{-- DISESUAIKAN agar cocok dengan backend --}}
                        placeholder="Username"
                        required
                        autofocus />
                </div>

                {{-- Input Password --}}
                <div class="relative mt-5">
                    <input
                        id="password"
                        class="w-full px-8 py-4 pr-12 rounded-lg font-medium bg-transparent border border-gray-600 placeholder-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="password"
                        name="password"
                        placeholder="Password"
                        required />

                    {{-- Tombol untuk melihat/menyembunyikan password --}}
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-white">
                        <i id="eyeIcon" class="ph ph-eye"></i>
                    </button>
                </div>

                {{-- Tombol Submit --}}
                <button type="submit"
                    class="mt-5 tracking-wide font-semibold bg-blue-600 text-gray-100 w-full py-4 rounded-lg hover:bg-blue-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                    <span class="ml-3">
                        Login
                    </span>
                </button>
            </form>
        </div>

        {{-- BAGIAN KANAN: GAMBAR ILUSTRASI --}}
        <div class="flex-1 hidden lg:flex bg-center bg-cover" style="background-image: url('{{ asset('images/kanan.jpg') }}');">
        </div>

    </div>

    {{-- JavaScript untuk fungsi toggle password diletakkan sebelum body berakhir --}}
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('ph-eye');
                eyeIcon.classList.add('ph-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('ph-eye-slash');
                eyeIcon.classList.add('ph-eye');
            }
        }
    </script>
</body>
</html>