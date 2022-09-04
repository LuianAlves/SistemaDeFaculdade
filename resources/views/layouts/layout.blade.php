<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('sistema/assets/') }}" data-template="vertical-menu-template-free">

<head>
    @include('layouts.head')
</head>

<body>

    <div class="layout-wrapper layout-content-navbar">  
        <div class="layout-container">

            <!-- Menu - Sidenav -->
            @auth
                @include('layouts.sidenav')
            @endauth

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                @auth
                    @include('layouts.navbar')
                @endauth

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    
                    <!-- Footer -->
                    @include('layouts.footer')

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!-- Include Scripts -->
    @include('layouts.scripts')
</body>

</html>