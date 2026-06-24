<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduAdmin - House Member Management</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@0.344.0/dist/umd/lucide.min.js"></script>

    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 72px;
            --sidebar-bg: #1e293b;
            --sidebar-bg-gradient: linear-gradient(180deg, #1e293b 0%, #1a2332 100%);
            --sidebar-hover: rgba(255, 255, 255, 0.06);
            --sidebar-active: rgba(99, 132, 227, 0.18);
            --sidebar-accent: #7c9aff;
            --sidebar-text: #cbd5e1;
            --sidebar-text-active: #e2e8f0;
            --sidebar-icon-color: #94a3b8;
            --sidebar-icon-active: #b4c6ff;
            --body-bg: #f1f5f9;
            --card-bg: #ffffff;
            --card-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 1px 2px rgba(0, 0, 0, 0.06);
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border-color: #e2e8f0;
            --accent-blue: #6366f1;
            --accent-teal: #14b8a6;
            --accent-amber: #f59e0b;
            --accent-purple: #8b5cf6;
            --accent-rose: #f43f5e;
            --transition-speed: 280ms;
            --navbar-height: 64px;
            --radius-sm: 8px;
            --radius: 12px;
            --radius-lg: 16px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--body-bg);
            color: var(--text-primary);
            margin: 0;
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg-gradient);
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: width var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1),
                transform var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border-right: 1px solid rgba(255, 255, 255, 0.06);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.5);
            z-index: 1035;
            opacity: 0;
            pointer-events: none;
            transition: opacity var(--transition-speed) ease;
            backdrop-filter: blur(2px);
        }

        .sidebar-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px;
            min-height: var(--navbar-height);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            flex-shrink: 0;
        }

        .sidebar.collapsed .sidebar-logo {
            justify-content: center;
        }

        .sidebar-logo-icon {
            width: 38px;
            height: 38px;
            border-radius: var(--radius-sm);
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 18px;
        }

        .sidebar-logo-text {
            font-weight: 700;
            font-size: 1.2rem;
            color: #f1f5f9;
            white-space: nowrap;
            letter-spacing: -0.02em;
            transition: opacity var(--transition-speed) ease,
                width var(--transition-speed) ease;
            overflow: hidden;
        }

        .sidebar.collapsed .sidebar-logo-text {
            opacity: 0;
            width: 0;
            pointer-events: none;
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 12px;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .nav-section {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748b;
            padding: 14px 12px 6px;
            font-weight: 600;
            white-space: nowrap;
            transition: all var(--transition-speed) ease;
        }

        .sidebar.collapsed .nav-section {
            opacity: 0;
            height: 0;
            padding: 0;
            overflow: hidden;
        }

        .nav-item,
        .nav-parent {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: var(--radius-sm);
            color: var(--sidebar-text);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            white-space: nowrap;
            transition: all 160ms ease;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            outline: none;
            position: relative;
        }

        .nav-item:hover,
        .nav-parent:hover {
            background: var(--sidebar-hover);
            color: var(--sidebar-text-active);
        }

        .nav-item.active,
        .nav-parent.active {
            background: var(--sidebar-active);
            color: var(--sidebar-text-active);
            font-weight: 600;
            box-shadow: inset 3px 0 0 var(--sidebar-accent);
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            color: var(--sidebar-icon-color);
            transition: color 160ms ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-item.active .nav-icon,
        .nav-item:hover .nav-icon,
        .nav-parent:hover .nav-icon {
            color: var(--sidebar-icon-active);
        }

        .nav-label {
            transition: opacity var(--transition-speed) ease;
        }

        .nav-parent {
            justify-content: space-between;
        }

        .parent-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .submenu-arrow {
            transition: transform 0.2s ease;
            flex-shrink: 0;
            color: var(--sidebar-icon-color);
        }

        .nav-parent.expanded .submenu-arrow {
            transform: rotate(90deg);
        }

        .submenu {
            list-style: none;
            padding-left: 28px;
            margin: 0;
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease;
        }

        .submenu.expanded {
            max-height: 200px;
        }

        .submenu .nav-item {
            padding: 9px 14px;
            font-size: 0.85rem;
            border-radius: var(--radius-sm);
        }

        .sidebar.collapsed .nav-label,
        .sidebar.collapsed .nav-parent .parent-content .nav-label,
        .sidebar.collapsed .submenu-arrow {
            opacity: 0;
            width: 0;
            pointer-events: none;
        }

        .sidebar.collapsed .sidebar-nav .nav-item,
        .sidebar.collapsed .sidebar-nav .nav-parent {
            justify-content: center;
            padding: 12px;
            gap: 0;
        }

        .sidebar.collapsed .nav-item.active,
        .sidebar.collapsed .nav-parent.active {
            box-shadow: none;
            background: var(--sidebar-active);
        }

        .sidebar-toggle-btn {
            flex-shrink: 0;
            padding: 14px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            background: none;
            border: none;
            color: var(--sidebar-text);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 160ms ease;
            white-space: nowrap;
            width: 100%;
            text-align: left;
            font-family: inherit;
            outline: none;
        }

        .sidebar-toggle-btn:hover {
            background: var(--sidebar-hover);
            color: #f1f5f9;
        }

        .sidebar.collapsed .sidebar-toggle-btn {
            justify-content: center;
            padding: 14px;
            gap: 0;
        }

        .sidebar-toggle-btn .toggle-icon {
            transition: transform var(--transition-speed) ease;
        }

        .sidebar.collapsed .sidebar-toggle-btn .toggle-icon {
            transform: rotate(180deg);
        }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
        }

        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        .top-navbar {
            position: sticky;
            top: 0;
            z-index: 1025;
            background: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 0 24px;
            height: var(--navbar-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .hamburger-btn {
            display: none;
            background: none;
            border: none;
            padding: 8px;
            border-radius: var(--radius-sm);
            color: var(--text-primary);
            cursor: pointer;
            outline: none;
        }

        .hamburger-btn:hover {
            background: #f1f5f9;
        }

        .page-title {
            font-weight: 700;
            font-size: 1.25rem;
            letter-spacing: -0.02em;
            white-space: nowrap;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dashboard-content {
            flex: 1;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* ========== PAGE SPECIFIC ========== */
        .info-highlight {
            background: linear-gradient(135deg, #eef2ff 0%, #f0f4ff 100%);
            border-radius: var(--radius);
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            border: 1px solid #d1d5ff;
            margin-top: 12px;
        }

        .info-highlight .house-icon {
            font-size: 1.8rem;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .info-highlight .house-name {
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: -0.01em;
        }

        .info-highlight .year-badge {
            background: #6366f1;
            color: #fff;
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .selection-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .selection-card .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 16px 18px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.95rem;
        }

        .selection-card .card-body {
            padding: 16px 18px;
        }

        .people-list {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            margin-top: 10px;
        }

        .people-list .list-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-bottom: 1px solid #f8fafc;
            transition: background 0.2s;
            cursor: pointer;
        }

        .people-list .list-item:hover {
            background: #fafcfd;
        }

        .people-list .list-item.selected {
            background: #eef2ff;
        }

        .people-list .list-item .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
            color: #475569;
            flex-shrink: 0;
        }

        .people-list .list-item .name {
            font-weight: 600;
            font-size: 0.9rem;
            flex: 1;
            min-width: 0;
        }

        .people-list .list-item .badge-role {
            font-size: 0.7rem;
            padding: 2px 10px;
            border-radius: 20px;
            font-weight: 600;
        }

        .badge-student {
            background: #e0f2fe;
            color: #0c4a6e;
        }

        .badge-teacher {
            background: #fdf2f8;
            color: #9d174d;
        }

        .badge-staff {
            background: #fef3c7;
            color: #92400e;
        }

        .selected-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .selected-table td {
            vertical-align: middle;
            padding: 8px 8px;
        }

        .selected-table .avatar-sm {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #e2e8f0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.7rem;
            color: #475569;
        }

        .btn-remove-member {
            background: none;
            border: none;
            color: #ef4444;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
        }

        .btn-remove-member:hover {
            background: #fee2e2;
        }

        .sticky-footer {
            position: sticky;
            bottom: 20px;
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.06);
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 8px;
            z-index: 100;
        }

        .sticky-footer .selected-count {
            font-weight: 700;
            font-size: 0.95rem;
        }

        .sticky-footer .btn {
            border-radius: var(--radius-sm);
            padding: 10px 20px;
            font-weight: 600;
        }

        .btn-soft-primary {
            background: #eef2ff;
            color: #6366f1;
            border: 1px solid #c7d2fe;
        }

        .btn-soft-primary:hover {
            background: #e0e7ff;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
                box-shadow: 8px 0 40px rgba(0, 0, 0, 0.2);
            }

            .main-content {
                margin-left: 0 !important;
            }

            .hamburger-btn {
                display: flex;
            }

            .dashboard-content {
                padding: 16px;
                gap: 16px;
            }

            .people-list {
                max-height: 300px;
            }

            .action-buttons-vertical {
                flex-direction: row !important;
                justify-content: center;
                gap: 12px;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar Overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay" aria-hidden="true"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar" role="navigation" aria-label="Main navigation">
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon" aria-hidden="true">
                <i data-lucide="graduation-cap" style="width:22px;height:22px;"></i>
            </div>
            <span class="sidebar-logo-text">EduAdmin</span>
        </div>
        <nav class="sidebar-nav" aria-label="Primary navigation">
            <div class="nav-section">Main Menu</div>
            <a href="/" class="nav-item">
                <span class="nav-icon"><i data-lucide="layout-dashboard"></i></span>
                <span class="nav-label">Dashboard</span>
            </a>
            <a href="/houses" class="nav-item">
                <span class="nav-icon"><i data-lucide="building-2"></i></span>
                <span class="nav-label">Houses</span>
            </a>
            <button class="nav-parent expanded" id="membersParent">
                <span class="parent-content">
                    <span class="nav-icon"><i data-lucide="users"></i></span>
                    <span class="nav-label">Members</span>
                </span>
                <span class="submenu-arrow"><i data-lucide="chevron-right" style="width:16px;height:16px;"></i></span>
            </button>
            <ul class="submenu expanded" id="membersSubmenu">
                <li><a href="#" class="nav-item active" data-page="manage-members">
                        <span class="nav-icon"><i data-lucide="user-cog" style="width:16px;height:16px;"></i></span>
                        <span class="nav-label">House Member Mgmt</span>
                    </a></li>
                <li><a href="#" class="nav-item" data-page="list-members">
                        <span class="nav-icon"><i data-lucide="list" style="width:16px;height:16px;"></i></span>
                        <span class="nav-label">List Members</span>
                    </a></li>
            </ul>
            <a href="#" class="nav-item">
                <span class="nav-icon"><i data-lucide="star"></i></span>
                <span class="nav-label">Points</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon"><i data-lucide="trophy"></i></span>
                <span class="nav-label">Leaderboard</span>
            </a>
            <div class="nav-section">Management</div>
            <button class="nav-parent" id="masterParent">
                <span class="parent-content">
                    <span class="nav-icon"><i data-lucide="database"></i></span>
                    <span class="nav-label">Master</span>
                </span>
                <span class="submenu-arrow"><i data-lucide="chevron-right" style="width:16px;height:16px;"></i></span>
            </button>
            <ul class="submenu" id="masterSubmenu">
                <li><a href="#" class="nav-item"><span class="nav-icon"><i data-lucide="building"
                                style="width:16px;height:16px;"></i></span><span
                            class="nav-label">Organization</span></a></li>
                <li><a href="#" class="nav-item"><span class="nav-icon"><i data-lucide="git-branch"
                                style="width:16px;height:16px;"></i></span><span class="nav-label">Branch</span></a>
                </li>
                <li><a href="#" class="nav-item"><span class="nav-icon"><i data-lucide="calendar"
                                style="width:16px;height:16px;"></i></span><span class="nav-label">Academic
                            Year</span></a></li>
            </ul>
        </nav>
        <button class="sidebar-toggle-btn" id="sidebarToggleBtn" aria-label="Toggle sidebar collapse">
            <span class="toggle-icon"><i data-lucide="chevron-left"></i></span>
            <span class="nav-label">Collapse</span>
        </button>
    </aside>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <header class="top-navbar">
            <div class="navbar-left">
                <button class="hamburger-btn" id="hamburgerBtn" aria-label="Open navigation menu">
                    <i data-lucide="menu" style="width:24px;height:24px;"></i>
                </button>
                <h1 class="page-title">House Member Management</h1>
            </div>
            <div class="navbar-right">
                <!-- Notification & User dropdowns (simplified) -->
                <div class="dropdown">
                    <button class="btn btn-light btn-sm rounded-pill dropdown-toggle" data-bs-toggle="dropdown">
                        <i data-lucide="bell" style="width:18px;height:18px;"></i>
                    </button>
                </div>
                <div class="dropdown">
                    <button class="btn btn-light btn-sm rounded-pill dropdown-toggle" data-bs-toggle="dropdown">
                        <i data-lucide="user" style="width:18px;height:18px;"></i>
                    </button>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="dashboard-content">
            <!-- Top Card: Academic Year & House -->
            <div class="selection-card">
                <div class="card-body">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold"><i data-lucide="calendar"
                                    style="width:14px;height:14px;"></i> Academic Year</label>
                            <select class="form-select" id="academicYearSelect">
                                <option value="2025/2026">2025/2026</option>
                                <option value="2026/2027" selected>2026/2027</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold"><i data-lucide="building-2"
                                    style="width:14px;height:14px;"></i> House</label>
                            <select class="form-select" id="houseSelect">
                                <option value="eagle" selected>🦅 Eagle</option>
                                <option value="lions">🦁 Lions</option>
                                <option value="wolves">🐺 Wolves</option>
                                <option value="horse">🐴 Horse</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-primary w-100" id="loadHouseBtn">Load</button>
                        </div>
                    </div>
                    <!-- Highlighted info area -->
                    <div class="info-highlight" id="houseHighlight">
                        <div class="house-icon">🦅</div>
                        <div>
                            <div class="house-name text-uppercase">EAGLE HOUSE</div>
                            <span class="year-badge">2026/2027</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Selection Area -->
            <div class="row g-3">
                <!-- Left: Available People -->
                <div class="col-lg-5">
                    <div class="selection-card h-100">
                        <div class="card-header">
                            <span><i data-lucide="users" style="width:18px;height:18px;"></i> Available People</span>
                            <span class="badge bg-primary rounded-pill" id="totalRecords">20</span>
                        </div>
                        <div class="card-body">
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-transparent"><i data-lucide="search"
                                        style="width:16px;height:16px;"></i></span>
                                <input type="text" class="form-control" placeholder="Search people..."
                                    id="searchInput">
                            </div>
                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <select class="form-select form-select-sm" id="filterRole">
                                        <option value="">All Roles</option>
                                        <option value="student">Student</option>
                                        <option value="teacher">Teacher</option>
                                        <option value="staff">Staff</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select class="form-select form-select-sm" id="filterOrg">
                                        <option value="">All Organizations</option>
                                        <option value="primary">Primary</option>
                                        <option value="secondary">Secondary</option>
                                        <option value="operational">Operational</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select class="form-select form-select-sm" id="filterGrade">
                                        <option value="">All Grades</option>
                                        <option value="4">Grade 4</option>
                                        <option value="5">Grade 5</option>
                                        <option value="6">Grade 6</option>
                                        <option value="7">Grade 7</option>
                                        <option value="8">Grade 8</option>
                                        <option value="9">Grade 9</option>
                                        <option value="10">Grade 10</option>
                                        <option value="11">Grade 11</option>
                                        <option value="12">Grade 12</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select class="form-select form-select-sm" id="filterBranch">
                                        <option value="">All Branches</option>
                                        <option value="Bintaro">Bintaro</option>
                                        <option value="Bangka">Bangka</option>
                                        <option value="Semarang">Semarang</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAllCheckbox">
                                    <span class="form-check-label small">Select All</span>
                                </label>
                                <span class="small text-muted" id="visibleCount">0</span>
                            </div>
                            <div class="people-list" id="peopleList">
                                <!-- Dynamically filled -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Center: Action Buttons -->
                <div class="col-lg-2 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-lg-column gap-2 action-buttons-vertical">
                        <button class="btn btn-soft-primary" id="addSelectedBtn" title="Add selected">
                            <i data-lucide="arrow-right" style="width:18px;height:18px;"></i> Add →
                        </button>
                        <button class="btn btn-soft-primary" id="removeSelectedBtn" title="Remove selected">
                            <i data-lucide="arrow-left" style="width:18px;height:18px;"></i> ← Remove
                        </button>
                    </div>
                </div>

                <!-- Right: Selected Members -->
                <div class="col-lg-5">
                    <div class="selection-card h-100">
                        <div class="card-header">
                            <span><i data-lucide="check-square" style="width:18px;height:18px;"></i> Selected
                                Members</span>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                                <table class="selected-table" id="selectedTable">
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sticky Bottom Action Bar -->
            <div class="sticky-footer" id="stickyFooter">
                <div class="selected-count">
                    Selected Members: <span id="selectedCounter">0</span>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-light" id="cancelBtn">Cancel</button>
                    <button class="btn btn-primary" id="saveMembersBtn">Save Members</button>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/lucide@0.344.0/dist/umd/lucide.min.js"></script>

    <script>
        $(function() {
            // Initialize Lucide icons
            if (typeof lucide !== 'undefined') lucide.createIcons();

            // Sidebar logic (same as before)
            const $sidebar = $('#sidebar');
            const $mainContent = $('#mainContent');
            const MOBILE_BREAKPOINT = 992;
            let isMobile = window.innerWidth < MOBILE_BREAKPOINT;
            let isSidebarCollapsed = localStorage.getItem('eduadmin_sidebar_collapsed') === 'true' && !isMobile;

            function applySidebarState() {
                if (isMobile) {
                    $sidebar.removeClass('collapsed');
                    $mainContent.removeClass('expanded');
                } else {
                    $sidebar.toggleClass('collapsed', isSidebarCollapsed);
                    $mainContent.toggleClass('expanded', isSidebarCollapsed);
                    const icon = isSidebarCollapsed ? 'chevron-right' : 'chevron-left';
                    $('#sidebarToggleBtn .toggle-icon i').attr('data-lucide', icon);
                    lucide.createIcons();
                }
            }
            applySidebarState();

            $('#sidebarToggleBtn').on('click', function(e) {
                e.preventDefault();
                if (!isMobile) {
                    isSidebarCollapsed = !isSidebarCollapsed;
                    localStorage.setItem('eduadmin_sidebar_collapsed', isSidebarCollapsed);
                    applySidebarState();
                }
            });

            function openMobileSidebar() {
                $('#sidebarOverlay').addClass('active');
                $sidebar.addClass('mobile-open');
                $('body').css('overflow', 'hidden');
            }

            function closeMobileSidebar() {
                $('#sidebarOverlay').removeClass('active');
                $sidebar.removeClass('mobile-open');
                $('body').css('overflow', '');
            }
            $('#hamburgerBtn').on('click', function() {
                if (isMobile) $sidebar.hasClass('mobile-open') ? closeMobileSidebar() : openMobileSidebar();
                else {
                    isSidebarCollapsed = !isSidebarCollapsed;
                    localStorage.setItem('eduadmin_sidebar_collapsed', isSidebarCollapsed);
                    applySidebarState();
                }
            });
            $('#sidebarOverlay').on('click', closeMobileSidebar);
            $(window).on('resize', function() {
                const wasMobile = isMobile;
                isMobile = window.innerWidth < MOBILE_BREAKPOINT;
                if (wasMobile && !isMobile) {
                    closeMobileSidebar();
                    applySidebarState();
                } else if (!wasMobile && isMobile) {
                    $sidebar.removeClass('collapsed');
                    $mainContent.removeClass('expanded');
                    closeMobileSidebar();
                }
            });

            // Toggle submenus
            $('#membersParent, #masterParent').on('click', function(e) {
                e.preventDefault();
                if (isMobile || !isSidebarCollapsed) {
                    $(this).toggleClass('expanded');
                    $(this).next('.submenu').toggleClass('expanded');
                }
            });

            // ========== DATA ==========
            const peopleData = [{
                    id: 1,
                    fullname: 'John Doe',
                    role: 'student',
                    organization: 'primary',
                    branch: 'Bintaro',
                    grade: 5
                },
                {
                    id: 2,
                    fullname: 'Sarah Lee',
                    role: 'teacher',
                    organization: 'secondary',
                    branch: 'Bangka',
                    grade: null
                },
                {
                    id: 3,
                    fullname: 'Mike Brown',
                    role: 'staff',
                    organization: 'operational',
                    branch: 'Semarang',
                    grade: null
                },
                {
                    id: 4,
                    fullname: 'Emily Davis',
                    role: 'student',
                    organization: 'primary',
                    branch: 'Bintaro',
                    grade: 4
                },
                {
                    id: 5,
                    fullname: 'Chris Wilson',
                    role: 'teacher',
                    organization: 'primary',
                    branch: 'Semarang',
                    grade: null
                },
                {
                    id: 6,
                    fullname: 'Anna Taylor',
                    role: 'student',
                    organization: 'secondary',
                    branch: 'Bangka',
                    grade: 10
                },
                {
                    id: 7,
                    fullname: 'Robert Johnson',
                    role: 'staff',
                    organization: 'primary',
                    branch: 'Bintaro',
                    grade: null
                },
                {
                    id: 8,
                    fullname: 'Lisa Anderson',
                    role: 'teacher',
                    organization: 'operational',
                    branch: 'Bangka',
                    grade: null
                },
                {
                    id: 9,
                    fullname: 'James Thomas',
                    role: 'student',
                    organization: 'secondary',
                    branch: 'Semarang',
                    grade: 11
                },
                {
                    id: 10,
                    fullname: 'Patricia Jackson',
                    role: 'student',
                    organization: 'primary',
                    branch: 'Bintaro',
                    grade: 6
                },
                {
                    id: 11,
                    fullname: 'Mark White',
                    role: 'teacher',
                    organization: 'secondary',
                    branch: 'Semarang',
                    grade: null
                },
                {
                    id: 12,
                    fullname: 'Nancy Harris',
                    role: 'staff',
                    organization: 'operational',
                    branch: 'Bintaro',
                    grade: null
                },
                {
                    id: 13,
                    fullname: 'Kevin Martin',
                    role: 'student',
                    organization: 'primary',
                    branch: 'Bangka',
                    grade: 5
                },
                {
                    id: 14,
                    fullname: 'Sandra Thompson',
                    role: 'teacher',
                    organization: 'operational',
                    branch: 'Semarang',
                    grade: null
                },
                {
                    id: 15,
                    fullname: 'Gary Garcia',
                    role: 'student',
                    organization: 'secondary',
                    branch: 'Bintaro',
                    grade: 12
                },
                {
                    id: 16,
                    fullname: 'Laura Martinez',
                    role: 'staff',
                    organization: 'primary',
                    branch: 'Bangka',
                    grade: null
                },
                {
                    id: 17,
                    fullname: 'Brian Robinson',
                    role: 'student',
                    organization: 'secondary',
                    branch: 'Semarang',
                    grade: 9
                },
                {
                    id: 18,
                    fullname: 'Linda Clark',
                    role: 'teacher',
                    organization: 'primary',
                    branch: 'Bintaro',
                    grade: null
                },
                {
                    id: 19,
                    fullname: 'Edward Rodriguez',
                    role: 'student',
                    organization: 'operational',
                    branch: 'Bangka',
                    grade: 7
                },
                {
                    id: 20,
                    fullname: 'Dorothy Lewis',
                    role: 'staff',
                    organization: 'secondary',
                    branch: 'Semarang',
                    grade: null
                }
            ];

            let selectedMembers = []; // { ...person, houseRole: 'member' }

            // ========== RENDER FUNCTIONS ==========
            function getInitials(name) {
                const parts = name.split(' ');
                return (parts[0][0] + (parts[1] ? parts[1][0] : '')).toUpperCase();
            }

            function roleBadgeClass(role) {
                if (role === 'student') return 'badge-student';
                if (role === 'teacher') return 'badge-teacher';
                return 'badge-staff';
            }

            function renderAvailableList(filteredData) {
                const $list = $('#peopleList');
                $list.empty();
                if (filteredData.length === 0) {
                    $list.append('<div class="p-3 text-center text-muted">No people found.</div>');
                    return;
                }
                filteredData.forEach(person => {
                    const initials = getInitials(person.fullname);
                    const isSelected = selectedMembers.some(m => m.id === person.id);
                    const html = `
                        <div class="list-item ${isSelected ? 'selected' : ''}" data-id="${person.id}">
                            <input type="checkbox" class="form-check-input me-1 person-checkbox" ${isSelected ? 'checked' : ''}>
                            <div class="avatar">${initials}</div>
                            <div class="name">${person.fullname}</div>
                            <span class="badge-role ${roleBadgeClass(person.role)}">${person.role}</span>
                            ${person.grade ? `<span class="small text-muted ms-1">Grade ${person.grade}</span>` : ''}
                        </div>
                    `;
                    $list.append(html);
                });
                $('#visibleCount').text(filteredData.length);
                updateSelectAllCheckbox();
            }

            function updateSelectAllCheckbox() {
                const $visibleCheckboxes = $('#peopleList .person-checkbox');
                const allChecked = $visibleCheckboxes.length > 0 && $visibleCheckboxes.length === $visibleCheckboxes
                    .filter(':checked').length;
                $('#selectAllCheckbox').prop('checked', allChecked);
            }

            function renderSelectedTable() {
                const $tbody = $('#selectedTable tbody');
                $tbody.empty();
                if (selectedMembers.length === 0) {
                    $tbody.append(
                        '<tr><td colspan="5" class="text-center text-muted py-3">No members selected.</td></tr>'
                        );
                } else {
                    selectedMembers.forEach(member => {
                        const initials = getInitials(member.fullname);
                        const html = `
                            <tr>
                                <td><div class="avatar-sm">${initials}</div></td>
                                <td class="fw-semibold">${member.fullname}</td>
                                <td><span class="badge-role ${roleBadgeClass(member.role)}">${member.role}</span></td>
                                <td>
                                    <select class="form-select form-select-sm house-role-select" data-id="${member.id}">
                                        <option value="member" ${member.houseRole === 'member' ? 'selected' : ''}>Member</option>
                                        <option value="captain" ${member.houseRole === 'captain' ? 'selected' : ''}>Captain</option>
                                        <option value="vice_captain" ${member.houseRole === 'vice_captain' ? 'selected' : ''}>Vice Captain</option>
                                        <option value="advisor" ${member.houseRole === 'advisor' ? 'selected' : ''}>Advisor</option>
                                        <option value="supervisor" ${member.houseRole === 'supervisor' ? 'selected' : ''}>Supervisor</option>
                                    </select>
                                </td>
                                <td><button class="btn-remove-member" data-id="${member.id}"><i data-lucide="x-circle" style="width:16px;height:16px;"></i></button></td>
                            </tr>
                        `;
                        $tbody.append(html);
                    });
                }
                $('#selectedCounter').text(selectedMembers.length);
                lucide.createIcons();
            }

            function updateAllViews() {
                applyFilters();
                renderSelectedTable();
            }

            // ========== FILTERS ==========
            function getFilteredPeople() {
                const search = $('#searchInput').val().toLowerCase();
                const roleFilter = $('#filterRole').val();
                const orgFilter = $('#filterOrg').val();
                const gradeFilter = $('#filterGrade').val();
                const branchFilter = $('#filterBranch').val();

                return peopleData.filter(p => {
                    const matchSearch = !search || p.fullname.toLowerCase().includes(search) || p.role
                        .includes(search);
                    const matchRole = !roleFilter || p.role === roleFilter;
                    const matchOrg = !orgFilter || p.organization === orgFilter;
                    const matchGrade = !gradeFilter || (p.grade && p.grade.toString() === gradeFilter);
                    const matchBranch = !branchFilter || p.branch === branchFilter;
                    return matchSearch && matchRole && matchOrg && matchGrade && matchBranch;
                });
            }

            function applyFilters() {
                const filtered = getFilteredPeople();
                renderAvailableList(filtered);
            }

            // Event listeners for filters
            $('#searchInput, #filterRole, #filterOrg, #filterGrade, #filterBranch').on('input change',
            applyFilters);

            // ========== SELECTION LOGIC ==========
            function addSelectedByIds(ids) {
                ids.forEach(id => {
                    const person = peopleData.find(p => p.id === id);
                    if (person && !selectedMembers.some(m => m.id === id)) {
                        selectedMembers.push({
                            ...person,
                            houseRole: 'member'
                        });
                    }
                });
                updateAllViews();
            }

            function removeSelectedByIds(ids) {
                selectedMembers = selectedMembers.filter(m => !ids.includes(m.id));
                updateAllViews();
            }

            // Checkbox changes in available list
            $(document).on('change', '#peopleList .person-checkbox', function() {
                const id = parseInt($(this).closest('.list-item').data('id'));
                if ($(this).is(':checked')) {
                    addSelectedByIds([id]);
                } else {
                    removeSelectedByIds([id]);
                }
            });

            // Select All checkbox
            $('#selectAllCheckbox').on('change', function() {
                const $visibleCheckboxes = $('#peopleList .person-checkbox');
                if ($(this).is(':checked')) {
                    const ids = $visibleCheckboxes.map(function() {
                        return parseInt($(this).closest('.list-item').data('id'));
                    }).get();
                    addSelectedByIds(ids);
                } else {
                    const ids = $visibleCheckboxes.map(function() {
                        return parseInt($(this).closest('.list-item').data('id'));
                    }).get();
                    removeSelectedByIds(ids);
                }
            });

            // Add/Remove buttons
            $('#addSelectedBtn').on('click', function() {
                const ids = $('#peopleList .person-checkbox:checked').map(function() {
                    return parseInt($(this).closest('.list-item').data('id'));
                }).get();
                addSelectedByIds(ids);
            });

            $('#removeSelectedBtn').on('click', function() {
                const ids = $('#peopleList .person-checkbox:checked').map(function() {
                    return parseInt($(this).closest('.list-item').data('id'));
                }).get();
                removeSelectedByIds(ids);
            });

            // Remove individual member from selected table
            $(document).on('click', '.btn-remove-member', function() {
                const id = parseInt($(this).data('id'));
                removeSelectedByIds([id]);
            });

            // House role change
            $(document).on('change', '.house-role-select', function() {
                const id = parseInt($(this).data('id'));
                const newRole = $(this).val();
                const member = selectedMembers.find(m => m.id === id);
                if (member) member.houseRole = newRole;
                // No need to re-render everything, just update counter maybe
            });

            // Load house button (for highlight)
            $('#loadHouseBtn').on('click', function() {
                const year = $('#academicYearSelect').val();
                const house = $('#houseSelect option:selected').text();
                $('#houseHighlight').html(`
                    <div class="house-icon">${house.split(' ')[0]}</div>
                    <div><div class="house-name text-uppercase">${house}</div><span class="year-badge">${year}</span></div>
                `);
            });

            // Cancel button
            $('#cancelBtn').on('click', function() {
                if (confirm('Discard all changes?')) {
                    selectedMembers = [];
                    updateAllViews();
                }
            });

            // Save button (demo)
            $('#saveMembersBtn').on('click', function() {
                alert('Members saved! (demo)');
            });

            // Initial render
            applyFilters();
            renderSelectedTable();
        });
    </script>
</body>

</html>
