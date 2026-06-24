<aside class="sidebar" id="sidebar" role="navigation" aria-label="Main navigation">
    <!-- Logo -->
    <div class="sidebar-logo">
        <div class="sidebar-logo-icon" aria-hidden="true">
            <i data-lucide="graduation-cap" style="width:22px;height:22px;"></i>
        </div>
        <span class="sidebar-logo-text">Houses System</span>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav" aria-label="Primary navigation">
        <div class="nav-section">Main Menu</div>

        <a href="/" class="nav-item active" aria-current="page">
            <span class="nav-icon"><i data-lucide="layout-dashboard"></i></span>
            <span class="nav-label">Dashboard</span>
        </a>
        <a href="/member" class="nav-item">
            <span class="nav-icon"><i data-lucide="users"></i></span>
            <span class="nav-label">Members</span>
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon"><i data-lucide="star"></i></span>
            <span class="nav-label">Points</span>
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon"><i data-lucide="trophy"></i></span>
            <span class="nav-label">Leaderboard</span>
        </a>

        <div class="nav-section">Management</div>

        <!-- ⭐ Expandable Master Menu -->
        <button class="nav-parent" id="masterParent">
            <span class="parent-content">
                <span class="nav-icon"><i data-lucide="database"></i></span>
                <span class="nav-label">Master</span>
            </span>
            <span class="submenu-arrow"><i data-lucide="chevron-right" style="width:16px;height:16px;"></i></span>
        </button>
        <ul class="submenu" id="masterSubmenu">
            <li>
                <a href="/branch" class="nav-item">
                    <span class="nav-icon"><i data-lucide="git-branch" style="width:16px;height:16px;"></i></span>
                    <span class="nav-label">Branch</span>
                </a>
            </li>
            <li>
                <a href="/organization" class="nav-item">
                    <span class="nav-icon"><i data-lucide="building" style="width:16px;height:16px;"></i></span>
                    <span class="nav-label">Organization</span>
                </a>
            </li>
            <li>
                <a href="/year" class="nav-item">
                    <span class="nav-icon"><i data-lucide="calendar" style="width:16px;height:16px;"></i></span>
                    <span class="nav-label">Academic Year</span>
                </a>
            </li>
            <li>
                <a href="/houses" class="nav-item">
                    <span class="nav-icon"><i data-lucide="building-2"></i></span>
                    <span class="nav-label">Houses</span>
                </a>
            </li>
            <li>
                <a href="/person" class="nav-item">
                    <span class="nav-icon"><i data-lucide="user"></i></span>
                    <span class="nav-label">User</span>
                </a>
            </li>
        </ul>

        <a href="#" class="nav-item">
            <span class="nav-icon"><i data-lucide="file-text"></i></span>
            <span class="nav-label">Reports</span>
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon"><i data-lucide="settings"></i></span>
            <span class="nav-label">Settings</span>
        </a>
    </nav>

    <!-- Sidebar toggle (desktop) -->
    <button class="sidebar-toggle-btn" id="sidebarToggleBtn" aria-label="Toggle sidebar collapse">
        <span class="toggle-icon"><i data-lucide="chevron-left"></i></span>
        <span class="nav-label">Collapse</span>
    </button>
</aside>
