<!-- Top notification bar -->
<div class="top-bar py-2 text-center">
  <div class="container">
    <a href="#" class="text-decoration-none text-dark">
      Amazing toys for amazing brains
    </a>
  </div>
</div>

<!-- Main navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light py-2" style="background-color: #fff0d2;">
        <div class="container" style="background-color: #fff0d2;">
            <!-- Logo -->
            <a class="navbar-brand" href="./">
                <img src="../view/resources/logo.png" alt="Logo" class="img-fluid" style="max-height: 40px;">
            </a>

            <!-- Mobile toggle button and cart icon -->
            <div class="d-flex align-items-center">
                <!-- Navbar toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- Collapsible content -->
            <div class="collapse navbar-collapse mt-2 mt-lg-0" id="mainNavbar">
                <!-- Search form -->
                <form class="d-flex mx-lg-auto mb-3 mb-lg-0" style="max-width: 500px; width: 100%;" id="searchForm">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Nhập từ khóa để tìm kiếm..." aria-label="Search" id="searchInput">
                        <button class="btn btn-outline-secondary" type="submit" id="searchbtn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>

                <!-- User links (hidden on very small screens) -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item d-none d-sm-block">
                        <a class="nav-link" href="?page=ordertracking">
                            <i class="fa-solid fa-truck"></i> Theo dõi đơn hàng
                        </a>
                    </li>
                    <?php session_start(); ?>
                    <li class="nav-item d-none d-sm-block">
                        <?php if(isset($_SESSION['userName'])):?>
                            <a class="nav-link" href="?page=account">
                                <i class="fa-solid fa-user"></i> Tài khoản
                            </a>
                        <?php else: ?>
                            <a class="nav-link" href="?page=login" id="login-button-header">
                                <i class="fa-solid fa-user"></i> Đăng nhập
                            </a>
                        <?php endif;?>
                    </li>
                    <!-- Giỏ hàng dropdown - Chuyển thành nav-item giống các mục khác -->
                    <li class="nav-item dropdown cart-dropdown">
                        <a class="nav-link dropdown-toggle position-relative" href="?page=cart" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-shopping-cart"></i>Giỏ hàng
                            <span class="badge bg-danger badge-cart position-absolute top-0 start-100 translate-middle">3</span>
                        </a>
                        
                        <div class="dropdown-menu dropdown-cart dropdown-menu-end shadow">
                            <div class="p-2 border-bottom">
                                <h6 class="mb-0"><b>Giỏ hàng của bạn</b></h6>
                            </div>
                            
                            <div class="cart-items overflow-auto" style="max-height: 300px;">
                                <!-- Cart Item 1 -->
                                <div class="d-flex align-items-center p-2 border-bottom">
                                    <img src="../view/resources/IMG/5.jpg" alt="Đồ chơi" class="cart-item-img rounded me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fs-6">Đồ chơi</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-danger fw-bold">250.000₫</span>
                                            <span class="badge bg-light text-dark">x1</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Cart Item 2 -->
                                <div class="d-flex align-items-center p-2 border-bottom">
                                    <img src="../view/resources/IMG/5.jpg" alt="Quần jean nữ" class="cart-item-img rounded me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fs-6">Đồ chơi</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-danger fw-bold">450.000₫</span>
                                            <span class="badge bg-light text-dark">x1</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Cart Item 3 -->
                                <div class="d-flex align-items-center p-2 border-bottom">
                                    <img src="../view/resources/IMG/5.jpg" alt="Giày thể thao" class="cart-item-img rounded me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fs-6">Đồ chơi</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-danger fw-bold">850.000₫</span>
                                            <span class="badge bg-light text-dark">x1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-2 border-bottom">
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>Tổng cộng:</span>
                                    <span>1.550.000₫</span>
                                </div>
                            </div>
                            
                            <div class="p-2">
                                <a href="?page=cart" class="btn btn-danger w-100">Xem giỏ hàng</a>
                            </div>
                        </div>
                    </li>
                </ul>

                <!-- Main menu items (on mobile only) -->
                <ul class="navbar-nav d-lg-none mt-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="?page=product" data-bs-toggle="dropdown" aria-expanded="false">
                            SẢN PHẨM
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <h6 class="dropdown-header">ĐỒ CHƠI THEO PHIM</h6>
                                <a class="dropdown-item" href="?page=product&danhmuc=sieuanhhung">Siêu anh hùng</a>
                                <a class="dropdown-item" href="?page=product&danhmuc=sieurobot">Siêu Robot</a>
                                <a class="dropdown-item" href="?page=product&danhmuc=sieuthu">Siêu thú</a>
                                <a class="dropdown-item" href="?page=product&danhmuc=maybay-ptxe">Máy bay, phương tiện xe</a>
                                <a class="dropdown-item" href="?page=product&danhmuc=doikhang">Đối kháng</a>
                                <a class="dropdown-item" href="?page=product&danhmuc=conquay">Con quay</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <h6 class="dropdown-header">ĐỒ CHƠI PHƯƠNG TIỆN</h6>
                                <a class="dropdown-item" href="?page=product&danhmuc=xedieukhien">Xe điều khiển</a>
                                <a class="dropdown-item" href="?page=product&danhmuc=xediecast">Xe sưu tập die-cast</a>
                                <a class="dropdown-item" href="xemohinh">Xe mô hình</a>
                                <a class="dropdown-item" href="xelaprap">Xe lắp ráp</a>
                                <a class="dropdown-item" href="playsetphukien">Playset & phụ kiện</a>
                                <!-- <a class="dropdown-item" href="#">Các phương tiện khác</a> -->
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <h6 class="dropdown-header">ĐỒ CHƠI LẮP GHÉP</h6>
                                <a class="dropdown-item" href="?page=product&danhmuc=lego">LEGO</a>
                                <!-- <a class="dropdown-item" href="#">Khác</a> -->
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <h6 class="dropdown-header">ĐỒ DÙNG HỌC TẬP</h6>
                                <a class="dropdown-item" href="?page=product&danhmuc=balodihoc">Ba lô đi học</a>
                                <a class="dropdown-item" href="?page=product&danhmuc=balomamnon">Ba lô mầm non</a>
                                <a class="dropdown-item" href="?page=product&danhmuc=hopviet">Hộp viết</a>
                                <a class="dropdown-item" href="?page=product&danhmuc=vanphongpham">Văn phòng phẩm</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <h6 class="dropdown-header">ĐỒ CHƠI SÁNG TẠO</h6>
                                <a class="dropdown-item" href="?page=product&danhmuc=butmau-bangve">Bút màu & bảng vẽ</a>
                                <a class="dropdown-item" href="?page=product&danhmuc=botnan">Bột nặn</a>
                                <a class="dropdown-item" href="?page=product&danhmuc=catdongluc">Cát động lực</a>
                                <a class="dropdown-item" href="?page=product&danhmuc=dochoidungphim">Đồ chơi dựng phim</a>
                                <a class="dropdown-item" href="?page=product&danhmuc=diy">DIY</a>
                                <a class="dropdown-item" href="?page=product&danhmuc=steam">STEAM</a>
                                <a class="dropdown-item" href="?page=product&danhmuc=slime">Slime</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            KHUYẾN MÃI
                        </a>
                        <ul class="dropdown-menu">
                            <li class="px-2 py-1">
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="promo-item" style="width: 120px;">
                                        <img src="../view/resources/IMG/5.jpg" alt="Sale 1" class="img-fluid mb-1">
                                        <small>Sản phẩm 1 - Giảm 30%</small>
                                    </div>
                                    <div class="promo-item" style="width: 120px;">
                                        <img src="../view/resources/IMG/5.jpg" alt="Sale 2" class="img-fluid mb-1">
                                        <small>Sản phẩm 2 - Giảm 50%</small>
                                    </div>
                                    <div class="promo-item" style="width: 120px;">
                                        <img src="../view/resources/IMG/5.jpg" alt="Sale 2" class="img-fluid mb-1">
                                        <small>Sản phẩm 2 - Giảm 50%</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">HÀNG MỚI</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">THƯƠNG HIỆU</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=forum">DIỄN ĐÀN</a></li>
                    <!-- Tracking and login links only visible on xs screens -->
                    <li class="nav-item d-sm-none"><a class="nav-link" href="#"><i class="fa-solid fa-truck"></i> Theo dõi đơn hàng</a></li>
                    <li class="nav-item d-sm-none"><a class="nav-link" href="#"><i class="fa-solid fa-user"></i> Đăng nhập</a></li>
                    <!-- <li class="nav-item d-sm-none"><a class="nav-link" href="?page=cart"><i class="fa-solid fa-shopping-cart"></i> Giỏ hàng</a></li> -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- Category navbar (visible only on desktop) -->
    <nav class="navbar navbar-expand-lg navbar-light border-bottom py-0 d-none d-lg-block">
        <div class="container">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <!-- Products -->
                    <li class="nav-item dropdown position-static">
                        <a class="nav-link dropdown-toggle py-3" href="?page=product" id="desktopProductsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            SẢN PHẨM
                        </a>
                        <div class="dropdown-menu w-100 border-0 rounded-0 m-0 py-3" aria-labelledby="desktopProductsDropdown">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-3 mb-3">
                                        <h6 class="fw-bold text-uppercase small">Đồ chơi theo phim</h6>
                                        <div class="dropdown-divider mb-2"></div>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=sieuanhhung">Siêu anh hùng</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=sieurobot">Siêu Robot</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=sieuthu">Siêu thú</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=maybay-ptxe">Máy bay, phương tiện xe</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=doikhang">Đối kháng</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=conquay">Con quay</a>
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <h6 class="fw-bold text-uppercase small">Đồ chơi phương tiện</h6>
                                        <div class="dropdown-divider mb-2"></div>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=xedieukhien">Xe điều khiển</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=xediecast">Xe sưu tập die-cast</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=xemohinh">Xe mô hình</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=xelaprap">Xe lắp ráp</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=playsetphukien">Playset & phụ kiện</a>
                                        <!-- <a class="dropdown-item py-1 category-link" href="#">Các phương tiện khác</a> -->
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <h6 class="fw-bold text-uppercase small">Đồ chơi lắp ghép</h6>
                                        <div class="dropdown-divider mb-2"></div>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=lego">LEGO</a>
                                        <!-- <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=">Khác</a> -->

                                        <h6 class="fw-bold text-uppercase small mt-4">Đồ dùng học tập</h6>
                                        <div class="dropdown-divider mb-2"></div>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=balodihoc">Ba lô đi học</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=balomamnon">Ba lô mầm non</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=hopviet">Hộp viết</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=vanphongpham">Văn phòng phẩm</a>
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <h6 class="fw-bold text-uppercase small">Đồ chơi sáng tạo</h6>
                                        <div class="dropdown-divider mb-2"></div>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=butmau-bangve">Bút màu & bảng vẽ</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=botnan">Bột nặn</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=catdongluc">Cát động lực</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=dochoidungphim">Đồ chơi dựng phim</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=diy">DIY</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=steam">STEAM</a>
                                        <a class="dropdown-item py-1 category-link" href="?page=product&danhmuc=slime">Slime</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Promotions -->
                    <li class="nav-item dropdown position-static">
                        <a class="nav-link dropdown-toggle py-3" href="#" id="navbarPromotion" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            KHUYẾN MÃI
                        </a>
                        <!-- Dropdown menu chứa banner khuyến mãi -->
                        <div class="dropdown-menu w-100 p-4" aria-labelledby="navbarPromotion">
                            <section class="promotion-carousel">
                                <div class="container">
                                    <div class="tab-content" id="promotionTabContent">
                                        <div class="tab-pane fade show active" id="deal1" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-4 mb-4">
                                                    <div class="card promo-card rounded-4 border-0 overflow-hidden h-100">
                                                        <img src="../view/resources/IMG/5.jpg" class="card-img-top" alt="Deal Riêng Web">
                                                        <div class="card-img-overlay d-flex flex-column justify-content-end">
                                                            <button class="btn btn-danger btn-sm align-self-center px-4 mb-3 fw-bold">MUA NGAY</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <div class="card promo-card rounded-4 border-0 overflow-hidden h-100">
                                                        <img src="../view/resources/IMG/5.jpg" class="card-img-top" alt="Độc Quyền Online">
                                                        <div class="card-img-overlay d-flex flex-column justify-content-end">
                                                            <button class="btn btn-danger btn-sm align-self-center px-4 mb-3 fw-bold">MUA NGAY</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <div class="card promo-card rounded-4 border-0 overflow-hidden h-100">
                                                        <img src="../view/resources/IMG/5.jpg" class="card-img-top" alt="LEGO F1">
                                                        <div class="card-img-overlay d-flex flex-column justify-content-end">
                                                            <button class="btn btn-danger btn-sm align-self-center px-4 mb-3 fw-bold">MUA NGAY</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </li>

                    <!-- Other links -->
                    <li class="nav-item">
                        <a class="nav-link py-3" href="#">HÀNG MỚI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-3" href="#">THƯƠNG HIỆU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-3" href="?page=forum">DIỄN ĐÀN</a>
                    </li>
                </ul>
            </div>
        </div>

        <div id="session-data" 
            data-email="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" 
            data-userID="<?php echo isset($_SESSION['userID']) ? $_SESSION['userID'] : ''; ?>">
        </div>
    </nav>
    