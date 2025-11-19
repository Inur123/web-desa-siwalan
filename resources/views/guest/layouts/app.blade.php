<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Desa Siwalan - Website Resmi')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white text-gray-800 font-sans">

    @include('guest.layouts.header')

    @yield('content')

    @include('guest.layouts.footer')

    <button id="scrollTopBtn"
        class="fixed bottom-6 right-6 bg-green-600 text-white p-3 rounded-full shadow-lg hover:bg-green-700 transition opacity-0 pointer-events-none"
        title="Scroll to top">↑</button>

    <script>
        // Scroll to top
        const scrollTopBtn = document.getElementById('scrollTopBtn');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.remove('opacity-0', 'pointer-events-none');
            } else {
                scrollTopBtn.classList.add('opacity-0', 'pointer-events-none');
            }
        });

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>

</body>

</html>
