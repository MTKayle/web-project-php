<?php 
// Xử lý logout 
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_start();
    // unset all session variables
    unset($_SESSION['userID']);
    unset($_SESSION['userName']);
    unset($_SESSION['email']);
    unset($_SESSION['cartID']);
    unset($_SESSION['role']);
    // destroy the session
    session_destroy();
    echo "<script>window.location.href = 'http://localhost/web-project-php/public';</script>";
    exit();
} 
?>

<nav class="sidebar bg-white border-end">
    <!-- Sidebar Header with Toggle Button -->
    <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <!-- Logo/Brand -->
            <h5 class="mb-0 d-none d-lg-block">ShopAdmin</h5>
            <!-- Mobile Logo (Smaller) -->
            <h6 class="mb-0 d-lg-none">ShopAdmin</h6>
        </div>
        <!-- Toggle Button for Mobile -->
        <button class="btn btn-sm btn-light d-lg-none sidebar-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
            <i class="bi bi-list"></i>
        </button>
    </div>
    
    <!-- Sidebar Content (Collapsible) -->
    <div class="collapse d-lg-block" id="sidebarMenu">
        <div class="sidebar-menu p-2">
            <div class="nav flex-column">
                <!-- Menu Items with Icons Only on Mobile -->
                <a href="./" class="nav-link py-2">
                    <i class="bi bi-grid me-2"></i> 
                    <span class="menu-title">Tổng quan</span>
                </a>
                <a href="?page=products" class="nav-link py-2">
                    <i class="bi bi-bag me-2"></i> 
                    <span class="menu-title">Quản lí sản phẩm</span>
                </a>
                <a href="?page=orders" class="nav-link py-2">
                    <i class="bi bi-box me-2"></i> 
                    <span class="menu-title">Quản lí đơn hàng</span>
                </a>
                <!-- <a href="?page=customers" class="nav-link py-2">
                    <i class="bi bi-people me-2"></i> 
                    <span class="menu-title">Customers</span>
                </a> -->
                <a href="?page=news" class="nav-link py-2">
                    <i class="bi bi-bar-chart me-2"></i> 
                    <span class="menu-title">Quản lí tin tức</span>
                </a>
                <a href="?page=voucher" class="nav-link py-2">
                    <i class="bi bi-credit-card me-2"></i> 
                    <span class="menu-title">Quản lí voucher</span>
                </a>
                <!-- <a href="#" class="nav-link py-2">
                    <i class="bi bi-chat me-2"></i> 
                    <span class="menu-title">Messages</span>
                </a>
                <a href="#" class="nav-link py-2">
                    <i class="bi bi-bell me-2"></i> 
                    <span class="menu-title">Notifications</span>
                </a> -->
                <!-- <a href="#" class="nav-link py-2">
                    <i class="bi bi-gear me-2"></i> 
                    <span class="menu-title">Settings</span>
                </a> -->
            </div>
        </div>

        
        
        
        <!-- Logout Button -->
        <div class="mt-3 p-3 border-top">
            <a href="?action=logout" class="nav-link text-danger">
                <i class="bi bi-box-arrow-right me-2"></i> 
                <span class="menu-title">Logout</span>
            </a>
        </div>

        <!-- Admin Profile -->
        <div class="admin-profile mt-auto p-3 border-top">
            <div class="d-flex align-items-center">
                <img src="../assets/avatar/admin.jpg" class="avatar me-2" alt="Admin">
                <div class="d-none d-md-block text-start">
                    <div class="fw-bold text-white" id="adminName"></div>
                    <div class="small">Admin</div>
                </div>
            </div>
        </div>
    </div>
</nav>