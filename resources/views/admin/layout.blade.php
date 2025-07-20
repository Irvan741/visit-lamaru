<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>

    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/admin/style.css') }}">

    <style>
        .sidebar {
            min-width: 220px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                z-index: 999;
                top: 56px;
                left: 0;
                height: calc(100vh - 56px);
                width: 220px;
                background: #f8f9fa;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .overlay {
                display: none;
                position: fixed;
                top: 56px;
                left: 0;
                width: 100%;
                height: calc(100vh - 56px);
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 998;
            }

            .overlay.show {
                display: block;
            }
        }
    </style>
    @yield('styles')

</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <button class="btn btn-outline-light d-lg-none me-2" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand" href="#">Admin Panel</a>
        <div class="ms-auto">
            <a class="btn btn-outline-light btn-sm" href="/">← View Website</a>
        </div>
    </nav>

    {{-- Sidebar + Overlay --}}
    <div class="overlay" id="sidebarOverlay"></div>

    <div class="d-flex">
        {{-- Sidebar --}}
        <aside class="sidebar bg-light p-3" id="sidebar">
            <h6 class="text-uppercase fw-bold">Menu</h6>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ url('/admin/category') }}" class="nav-link">🗂️ Categories</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/event') }}" class="nav-link">📅 Events</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/wisata') }}" class="nav-link">🏞️ Wisata</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/facility') }}" class="nav-link">🏠 Facilities</a>
                </li>
            </ul>
        </aside>

        {{-- Content Area --}}
        <main class="flex-fill p-4" style="width: 100%;">
            @yield('content')
        </main>
    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        toggleSidebar?.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        overlay?.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    </script>

    @stack('scripts')
</body>
</html>
