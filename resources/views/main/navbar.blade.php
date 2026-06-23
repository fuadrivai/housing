<!-- Top Navbar -->
<header class="top-navbar" role="banner">
    <div class="navbar-left">
        <button class="hamburger-btn" id="hamburgerBtn" aria-label="Open navigation menu" aria-expanded="false"
            aria-controls="sidebar" tabindex="0">
            <i data-lucide="menu" style="width:24px;height:24px;"></i>
        </button>
        <h1 class="page-title" id="pageTitle">{{ $title ?? 'Dashboard' }}</h1>
    </div>

    <div class="navbar-right">
        <!-- Notification -->
        <div class="dropdown">
            <button class="btn-notification dropdown-toggle" id="notificationDropdownBtn" data-bs-toggle="dropdown"
                aria-expanded="false" aria-label="Notifications" tabindex="0" title="Notifications">
                <i data-lucide="bell" style="width:20px;height:20px;"></i>
                <span class="notification-badge" aria-label="3 new notifications"></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end notification-dropdown"
                aria-labelledby="notificationDropdownBtn">
                <div class="dropdown-header">Notifications</div>
                <div class="notification-item">
                    <span class="notification-dot"></span>
                    <div>
                        <span class="notification-text">Phoenix House reached <strong>5,000 points</strong>
                            milestone</span>
                        <span class="notification-time">12 minutes ago</span>
                    </div>
                </div>
                <div class="notification-item">
                    <span class="notification-dot"></span>
                    <div>
                        <span class="notification-text">New member <strong>Sarah Johnson</strong> joined Dragon
                            House</span>
                        <span class="notification-time">1 hour ago</span>
                    </div>
                </div>
                <div class="notification-item">
                    <span class="notification-dot"></span>
                    <div>
                        <span class="notification-text">Monthly report for <strong>October</strong> is
                            ready</span>
                        <span class="notification-time">3 hours ago</span>
                    </div>
                </div>
                <div class="notification-item" style="text-align:center;">
                    <a href="#" style="font-size:0.8rem;font-weight:600;color:#6366f1;text-decoration:none;">View
                        all
                        notifications</a>
                </div>
            </div>
        </div>

        <!-- User Profile -->
        <div class="dropdown">
            <button class="btn-user dropdown-toggle" id="userDropdownBtn" data-bs-toggle="dropdown"
                aria-expanded="false" aria-label="User profile menu" tabindex="0" title="Profile">
                <div class="user-avatar" aria-hidden="true">AD</div>
                <div class="user-info d-none d-md-block">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                </div>
                <i data-lucide="chevron-down" style="width:16px;height:16px;" class="d-none d-md-block"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end user-dropdown-menu" aria-labelledby="userDropdownBtn">
                <li><a class="dropdown-item" href="#"><i data-lucide="user" style="width:16px;height:16px;"></i>
                        My Profile</a></li>
                <li><a class="dropdown-item" href="#"><i data-lucide="settings"
                            style="width:16px;height:16px;"></i> Account Settings</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item text-danger" href="#"><i data-lucide="log-out"
                            style="width:16px;height:16px;"></i> Sign Out</a></li>
            </ul>
        </div>
    </div>
</header>
