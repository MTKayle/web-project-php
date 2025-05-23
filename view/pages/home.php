<!-- Main Content -->
<main>
        <!-- Main Carousel (Bootstrap) -->
        <section class="main-carousel py-4">
            <div class="container">
                <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    
                    <!-- Carousel items -->
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img src="../view/resources/IMG/bannerPromote.webp" class="d-block w-100" alt="Main Promotion 1">
                        </div>
                        <div class="carousel-item">
                            <img src="../view/resources/IMG/bannerPromote1.png" class="d-block w-100" alt="Main Promotion 2">
                        </div>
                        <div class="carousel-item">
                            <img src="../view/resources/IMG/bannerPromote2.webp" class="d-block w-100" alt="Main Promotion 3">
                        </div>
                    </div>
                    
                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>

        <!-- Brand Categories (Bootstrap) -->
        <section class="brand-categories py-5">
            <div class="container">
                <h2 class="section-title mb-4 fs-2">Thương hiệu nổi bật</h2>
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3">
                    <div class="col">
                        <div class="card brand-item h-100 text-center p-3 border">
                            <img src="../view/resources/IMG/lego.avif" alt="LEGO" class="img-fluid mx-auto mb-2" style="height: 80px; object-fit: contain;">
                            <div class="card-body p-0">
                                <p class="card-text fw-medium">LEGO</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card brand-item h-100 text-center p-3 border">
                            <img src="../view/resources/IMG/barbie.avif" alt="Barbie" class="img-fluid mx-auto mb-2" style="height: 80px; object-fit: contain;">
                            <div class="card-body p-0">
                                <p class="card-text fw-medium">Barbie</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card brand-item h-100 text-center p-3 border">
                            <img src="../view/resources/IMG/hotwheels.avif" alt="Hot Wheels" class="img-fluid mx-auto mb-2" style="height: 80px; object-fit: contain;">
                            <div class="card-body p-0">
                                <p class="card-text fw-medium">Hot Wheels</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card brand-item h-100 text-center p-3 border">
                            <img src="../view/resources/IMG/fiisherPrice.avif" alt="Fisher Price" class="img-fluid mx-auto mb-2" style="height: 80px; object-fit: contain;">
                            <div class="card-body p-0">
                                <p class="card-text fw-medium">Fisher Price</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card brand-item h-100 text-center p-3 border">
                            <img src="../view/resources/IMG/monopoly.avif" alt="Nerf" class="img-fluid mx-auto mb-2" style="height: 80px; object-fit: contain;">
                            <div class="card-body p-0">
                                <p class="card-text fw-medium">Monopoly</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card brand-item h-100 text-center p-3 border">
                            <img src="../view/resources/IMG/techdeck.avif" alt="SIKU" class="img-fluid mx-auto mb-2" style="height: 80px; object-fit: contain;">
                            <div class="card-body p-0">
                                <p class="card-text fw-medium">Tech Deck</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--Featured categories-->
        <section class="featured-categories py-5">
            <div class="container">
                <h2 class="section-title text-center mb-4 fs-2">Danh Mục Nổi Bật</h2>
                <!-- Row 1 -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="category-card text-center">
                            <a href="?page=product&danhmuc=lego" class="category-link">
                                <div class="category-image overflow-hidden mb-3 mx-auto">
                                    <img src="../view/resources/IMG/featuredCategory1.webp" alt="Đồ chơi mầm Non" class="img-fluid">
                                </div>
                                <h3 class="category-name fw-bold fs-4">Đồ chơi LEGO</h3>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="category-card text-center">
                            <a href="?page=product&danhmuc=sieuanhhung" class="category-link">
                                <div class="category-image overflow-hidden mb-3 mx-auto">
                                    <img src="../view/resources/IMG/featuredCategory2.webp" alt="Đồ Chơi thời trang" class="img-fluid">
                                </div>
                                <h3 class="category-name fw-bold fs-4">Đồ Chơi siêu anh hùng</h3>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Row 2 -->
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="category-card text-center">
                            <a href="?page=product&danhmuc=steam" class="category-link">
                                <div class="category-image overflow-hidden mb-3 mx-auto">
                                    <img src="../view/resources/IMG/featuredCategory3.webp" alt="Robot" class="img-fluid">
                                </div>
                                <h3 class="category-name fw-bold fs-4">Đồ chới STEM</h3>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="category-card text-center">
                            <a href="?page=product&danhmuc=sieurobot" class="category-link">
                                <div class="category-image overflow-hidden mb-3 mx-auto">
                                    <img src="../view/resources/IMG/featuredCategory4.webp" alt="Đồ chơi phương tiện" class="img-fluid">
                                </div>
                                <h3 class="category-name fw-bold fs-4">Đồ chơi Robot</h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Age Categories (Bootstrap) -->
        <section class="age-categories_custom py-5">
            <div class="container">
                <h2 class="section-title mb-4 fs-2">Đồ chơi theo độ tuổi</h2>
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4">
                    <a href="?page=product&tuoi=0-1"class="col toys-age">
                        <img src="../view/resources/IMG/0-12.avif" alt="0-12 Months" class="card-img-top rounded">
                        
                    </a>
                    <a href="?page=product&tuoi=1-3" class="col toys-age">
                        <img src="../view/resources/IMG/1-3.avif" alt="1-3 Years" class="card-img-top rounded">
                    </a>
                    <a href="?page=product&tuoi=3-6" class="col toys-age">
                        <img src="../view/resources/IMG/3-6tuoi.avif" alt="3-6 Years" class="card-img-top rounded">
                    </a>
                    <a href="?page=product&tuoi=6-12" class="col toys-age">
                        <img src="../view/resources/IMG/6-12tuoi.avif" alt="6-12 Years" class="card-img-top rounded">
                    </a>
                    <a href="?page=product&tuoi=12-100" class="col toys-age">
                        <img src="../view/resources/IMG/12+tuoi.avif" alt="12+ Years" class="card-img-top rounded">
                    </a>
                </div>
            </div>
        </section>

        <!-- Featured Products (Bootstrap) -->
        <section class="featured-products py-5">
            <div class="container">
                <h2 class="section-title mb-4 fs-2">Sản phẩm nổi bật</h2>
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4" id="productSell">
                    <!-- render product here -->
                
            </div>
            <div class="text-center mt-4">
                    <a href="?page=product" class="btn btn-outline-primary px-4">Xem tất cả</a>
                </div>
        </section>

        <!-- New Arrivals -->
        <section class="featured-products py-5">
            <div class="container">
                <h2 class="section-title mb-4 fs-2">Sản phẩm mới về</h2>
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4" id="productNew">
                    <!-- Product 1 -->
                    
                
            </div>
            <div class="text-center mt-4">
                    <a href="?page=product" class="btn btn-outline-primary px-4">Xem tất cả</a>
                </div>
        </section>

        <!-- Blog Section -->
        <section class="blog-section">
            <div class="container">
                <h2 class="section-title fs-2">TIN TỨC MỚI NHẤT</h2>
                <div class="blog-grid" id="blogList">
                    
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="?page=news" class="btn btn-outline-primary px-4">Xem tất cả</a>
                </div>
                <!-- <div class="view-all-btn">
                    <a href="#">Xem tất cả</a>
                </div> -->
            </div>
        </section>
    </main>