<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Admin Desa Siwalan</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-green-50 to-blue-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full">
            <!-- Card -->
            <div class="bg-white rounded-lg shadow-lg p-8">

                <!-- Logo/Header -->
                <div class="text-center mb-8">
                    <div class="text-5xl mb-3">🏘️</div>
                    <h1 class="text-2xl font-bold text-gray-800">Desa Siwalan</h1>
                    <p class="text-gray-600 mt-1">Buat Akun Admin/Warga</p>
                </div>

                <!-- ERROR ALERT -->
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                        <ul class="list-disc ml-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- SUCCESS ALERT -->
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Register Form -->
                <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="Nama Anda">
                    </div>

                    <!-- NIK -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                        <input type="text" name="nik" value="{{ old('nik') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="35xxxxxxxxxxxxxx">
                    </div>

                    <!-- NO HP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor HP (Opsional)</label>
                        <input type="text" name="nohp" value="{{ old('nohp') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="08xxxxxxxxxx">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="admin@desa.com">
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>

                        <div class="relative">
                            <input type="password" name="password" id="reg_password" required minlength="6"
                                class="w-full px-4 py-2 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="••••••••">

                            <span onclick="togglePassword('reg_password', 'reg_eye')"
                                class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500">
                                <i id="reg_eye" class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>


                    <!-- Konfirmasi Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>

                        <div class="relative">
                            <input type="password" name="password_confirmation" id="reg_password_confirm" required
                                minlength="6"
                                class="w-full px-4 py-2 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="••••••••">

                            <span onclick="togglePassword('reg_password_confirm', 'reg_eye_confirm')"
                                class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500">
                                <i id="reg_eye_confirm" class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                        Daftar
                    </button>
                </form>

                <!-- Divider -->
                <div class="my-6 flex items-center">
                    <div class="flex-1 border-t border-gray-300"></div>
                    <span class="px-3 text-gray-400 text-sm">Atau</span>
                    <div class="flex-1 border-t border-gray-300"></div>
                </div>

                <!-- Login Link -->
                <p class="text-center text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:text-green-700">
                        Login di sini
                    </a>
                </p>
            </div>

            <!-- Footer Text -->
            <p class="text-center text-gray-600 text-sm mt-6">
                © 2025 Desa Siwalan. Semua hak cipta dilindungi.
            </p>
        </div>
    </div>
    <script>
        function togglePassword(inputId, eyeId) {
            const input = document.getElementById(inputId);
            const eye = document.getElementById(eyeId);

            if (input.type === "password") {
                input.type = "text";
                eye.classList.remove("fa-eye");
                eye.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                eye.classList.remove("fa-eye-slash");
                eye.classList.add("fa-eye");
            }
        }
    </script>

</body>

</html>
