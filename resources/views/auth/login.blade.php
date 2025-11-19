<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Desa Siwalan</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-green-50 to-blue-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full">

            <div class="bg-white rounded-lg shadow-lg p-8">

                <div class="text-center mb-8">
                    <div class="text-5xl mb-3">🏘️</div>
                    <h1 class="text-2xl font-bold text-gray-800">Desa Siwalan</h1>
                    <p class="text-gray-600 mt-1">Portal Admin</p>
                </div>

                <!-- Error Message -->
                @if ($errors->any())
                    <div class="bg-red-200 text-red-700 p-3 rounded mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="admin@desa.com">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>

                        <div class="relative">
                            <input type="password" name="password" id="login_password" required
                                class="w-full px-4 py-2 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="••••••••">

                            <span onclick="togglePassword('login_password', 'login_eye')"
                                class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500">
                                <i id="login_eye" class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300">
                        <label for="remember" class="ml-2 text-sm text-gray-600">Ingat saya</label>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                        Login
                    </button>
                </form>

                <div class="my-6 flex items-center">
                    <div class="flex-1 border-t border-gray-300"></div>
                    <span class="px-3 text-gray-400 text-sm">Atau</span>
                    <div class="flex-1 border-t border-gray-300"></div>
                </div>

                <p class="text-center text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-green-600 font-semibold hover:text-green-700">
                        Daftar di sini
                    </a>
                </p>

            </div>

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
