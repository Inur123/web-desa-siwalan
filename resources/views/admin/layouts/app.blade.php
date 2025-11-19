<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Desa Siwalan</title>
      @vite('resources/css/app.css')
    <!-- Added Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        /* Sidebar smooth transitions */
        #sidebar {
            transition: transform 0.3s ease-in-out;
        }

        /* Desktop: sidebar visible */
        @media (min-width: 769px) {
            #sidebar {
                transform: translateX(0);
            }
        }

        /* Mobile: sidebar hidden by default */
        @media (max-width: 768px) {
            #sidebar {
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                transform: translateX(-100%);
                z-index: 50;
            }

            #sidebar.sidebar-open {
                transform: translateX(0);
            }
        }

        /* Overlay for mobile */
        #sidebarOverlay {
            transition: opacity 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Main container: sidebar + content -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
          @include('admin.layouts.sidebar')

        <!-- Main content area -->
        <div id="mainContent" class="flex-1 flex flex-col w-full">
            <!-- Top Bar -->

             @include('admin.layouts.header')
            <!-- Content -->
            <main class="p-4 md:p-8 flex-1">
                <!-- Stats Cards -->
                 @yield('content')

            </main>
        </div>
    </div>

    <!-- Mobile overlay -->
    <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 md:hidden z-40" onclick="toggleSidebar()"></div>

    <script>


        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            const arrow = document.getElementById('dropdownArrow');

            dropdown.classList.toggle('hidden');

            // Change arrow direction
            if (dropdown.classList.contains('hidden')) {
                arrow.classList.remove('fa-chevron-up');
                arrow.classList.add('fa-chevron-down');
            } else {
                arrow.classList.remove('fa-chevron-down');
                arrow.classList.add('fa-chevron-up');
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            const dropdown = document.getElementById('userDropdown');
            const button = e.target.closest('button');

            if (!button || !button.closest('[onclick="toggleDropdown()"]')) {
                dropdown.classList.add('hidden');
                document.getElementById('dropdownArrow').classList.remove('fa-chevron-up');
                document.getElementById('dropdownArrow').classList.add('fa-chevron-down');
            }
        });



        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.toggle('sidebar-open');
            overlay.classList.toggle('hidden');
        }

        // Close sidebar when a link is clicked on mobile
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    toggleSidebar();
                }
            });
        });
    </script>
</body>
</html>
