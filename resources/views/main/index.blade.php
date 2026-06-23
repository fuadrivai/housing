<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MHIS Houses System</title>

    <link href="/assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="/assets/plugins/lucide.min.js"></script>
    <link rel="stylesheet" href="/assets/app/app.css">

    @yield('content-style')
</head>

<body>

    <!-- ==================== SIDEBAR OVERLAY (mobile) ==================== -->
    <div class="sidebar-overlay" id="sidebarOverlay" aria-hidden="true"></div>

    @include('main.sidebar')

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="main-content" id="mainContent">
        @include('main.navbar')
        <!-- Dashboard Content -->
        <main class="dashboard-content" id="dashboardContent" role="main">
            @yield('content')
        </main>
    </div>

    <!-- ==================== SCRIPTS ==================== -->
    <!-- jQuery -->
    <script src="/assets/plugins/jquery-3.7.1.min.js"></script>
    <script src="/assets/plugins/popper.min.js"></script>
    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="/assets/plugins/bootstrap/bootstrap.min.js"></script>
    <!-- Chart.js -->
    <script src="/assets/plugins/chart.umd.min.js"></script>
    <script src="/assets/app/app.js"></script>
    @yield('content-script')

</body>

</html>
