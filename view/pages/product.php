<div class="container py-4">
    <div class="row">
        <!-- Filter Toggle Button (visible only on mobile) -->
        <div class="col-12 d-md-none mb-3">
            <button class="btn btn-danger" id="filterToggle">
                <i class="bi bi-funnel"></i> Lọc Sản Phẩm
            </button>
        </div>
      
      <!-- Backdrop for mobile filter -->
        <div class="filter-backdrop" id="filterBackdrop"></div>
      
      <!-- Filter Section -->
        <div class="col-md-3" id="filterSection">
            <div class="card">
                <div class="card-body">
                    <!-- Mobile header with close button -->
                    <div class="d-flex justify-content-between align-items-center d-md-none mb-3">
                        <h4 class="m-0">Bộ Lọc</h4>
                        <button type="button" class="btn-close" id="closeFilter" aria-label="Close"></button>
                    </div>
                
                    <!-- Categories Section -->
                    <h5 class="text-danger mb-3">Danh Mục</h5>
                    <ul class="list-unstyled mb-4" id="category-list">
                        <li class="d-flex justify-content-between mb-2 category-item" data-category="sieuanhhung" style="cursor: pointer;">
                            <span>Siêu anh hùng</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2 category-item" data-category="phuongtiengiaothong" style="cursor: pointer;">
                            <span>Phương tiện giao thông</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2 category-item" data-category="keodochoi" style="cursor: pointer;">
                            <span>Kẹo đồ chơi</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2 category-item" data-category="dochoilapghep" style="cursor: pointer;">
                            <span>Đồ chơi lắp ghép</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2 category-item" data-category="dochoisangtao" style="cursor: pointer;">
                            <span>Đồ chơi sáng tạo</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2 category-item" data-category="dothoitrang" style="cursor: pointer;">
                            <span>Đồ thời trang</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2 category-item" data-category="thegioidongvat" style="cursor: pointer;">
                            <span>Thế giới động vật</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2 category-item" data-category="bupbe" style="cursor: pointer;">
                            <span>Búp bê</span>
                        </li>
                    </ul>


                    <!-- Age Section -->
                    <h5 class="text-danger mb-3">Độ Tuổi</h5>
                    <div class="mb-4" id="age">
                        <div class="form-check mb-2">
                            <input class="form-check-input age-checkbox" type="checkbox" id="age1" value="0-1">
                            <label class="form-check-label" for="age1">0 - 1 tuổi</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input age-checkbox" type="checkbox" id="age2" value="1-3">
                            <label class="form-check-label" for="age2">1 - 3 tuổi</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input age-checkbox" type="checkbox" id="age3" value="3-6">
                            <label class="form-check-label" for="age3">3 - 6 tuổi</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input age-checkbox" type="checkbox" id="age4" value="6-12">
                            <label class="form-check-label" for="age4">6 - 12 tuổi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input age-checkbox" type="checkbox" id="age4" value="12-100">
                            <label class="form-check-label" for="age4">12 tuổi trở lên</label>
                        </div>
                    </div>

                    <!-- Brand Section -->
                    <h5 class="text-danger mb-3">Thương Hiệu</h5>
                    <div class="mb-4">
                        <div class="form-check mb-2">
                            <input class="form-check-input brand-checkbox" type="checkbox" id="brand1" value="lego">
                            <label class="form-check-label" for="brand1">LEGO</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input brand-checkbox" type="checkbox" id="brand2" value="fisher-price">
                            <label class="form-check-label" for="brand2">FISHER-PRICE</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input brand-checkbox" type="checkbox" id="brand3" value="vtech">
                            <label class="form-check-label" for="brand3">VTECH</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input brand-checkbox" type="checkbox" id="brand4" value="mattel">
                            <label class="form-check-label" for="brand3">MATTEL</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input brand-checkbox" type="checkbox" id="brand5" value="tommy">
                            <label class="form-check-label" for="brand3">TOMMY</label>
                        </div>
                    </div>

                    <!-- Price Section -->
                    <h5 class="text-danger mb-3">Giá (₫)</h5>
                    <div class="mb-4">
                        <div class="form-check mb-2">
                            <input class="form-check-input price-checkbox" type="checkbox" id="price1" value="0-200000">
                            <label class="form-check-label" for="price1">
                                Dưới 200.000₫
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input price-checkbox" type="checkbox" id="price2" value="200000-500000">
                            <label class="form-check-label" for="price2">
                                200.000₫ - 500.000₫
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input price-checkbox" type="checkbox" id="price3" value="500000-1000000000">
                            <label class="form-check-label" for="price3">
                                Trên 500.000₫
                            </label>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
      
        <div class = "col-md-9" id="product-container">
            <!-- JS sẽ render nội dung vào đây -->

        </div>

        <!-- Pagination -->
        <nav aria-label="Order Pagination" class="mt-4">
                        <ul class="pagination justify-content-center" id="pagination">
                            <!-- render pagination here -->
                        </ul>
                    </nav>
       
      <!-- Content area (for demo purposes) -->
        <!-- <div class="col-4 mb-4 ms-4">
            <div class="row g4 gy-4 mt-4">
                <div class="card product-card h-100 border-0 position-relative">
                    <div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-15%</div>
                    <div class="product-image position-relative">
                        <img src="img/product-lego.jpg" alt="LEGO Classic" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">LEGO</div>
                        <h5 class="card-title product-name h6 mb-2">LEGO Classic Medium Creative Brick Box 10696</h5>
                        <div class="product-price mb-3">
                            <span class="text-decoration-line-through text-muted me-2">799.000đ</span>
                            <span class="fw-bold text-danger">679.000đ</span>
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
            <div class="row g4 gy-4 mt-4">
                <div class="card product-card h-100 border-0 position-relative">
                    <div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-15%</div>
                    <div class="product-image position-relative">
                        <img src="img/product-lego.jpg" alt="LEGO Classic" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">LEGO</div>
                        <h5 class="card-title product-name h6 mb-2">LEGO Classic Medium Creative Brick Box 10696</h5>
                        <div class="product-price mb-3">
                            <span class="text-decoration-line-through text-muted me-2">799.000đ</span>
                            <span class="fw-bold text-danger">679.000đ</span>
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
            <div class="row g4 gy-4 mt-4">
                <div class="card product-card h-100 border-0 position-relative">
                    <div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-15%</div>
                    <div class="product-image position-relative">
                        <img src="img/product-lego.jpg" alt="LEGO Classic" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">LEGO</div>
                        <h5 class="card-title product-name h6 mb-2">LEGO Classic Medium Creative Brick Box 10696</h5>
                        <div class="product-price mb-3">
                            <span class="text-decoration-line-through text-muted me-2">799.000đ</span>
                            <span class="fw-bold text-danger">679.000đ</span>
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
            <div class="row g4 gy-4 mt-4">
                <div class="card product-card h-100 border-0 position-relative">
                    <div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-15%</div>
                    <div class="product-image position-relative">
                        <img src="img/product-lego.jpg" alt="LEGO Classic" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">LEGO</div>
                        <h5 class="card-title product-name h6 mb-2">LEGO Classic Medium Creative Brick Box 10696</h5>
                        <div class="product-price mb-3">
                            <span class="text-decoration-line-through text-muted me-2">799.000đ</span>
                            <span class="fw-bold text-danger">679.000đ</span>
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
            <div class="row g4 gy-4 mt-4">
                <div class="card product-card h-100 border-0 position-relative">
                    <div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-15%</div>
                    <div class="product-image position-relative">
                        <img src="img/product-lego.jpg" alt="LEGO Classic" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">LEGO</div>
                        <h5 class="card-title product-name h6 mb-2">LEGO Classic Medium Creative Brick Box 10696</h5>
                        <div class="product-price mb-3">
                            <span class="text-decoration-line-through text-muted me-2">799.000đ</span>
                            <span class="fw-bold text-danger">679.000đ</span>
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
        </div> -->
        
        <!-- Product 2 -->
        <!-- <div class="col-4 mb-4 ms-4">
            <div class="row g4 gy-4 mt-4">
                <div class="card product-card h-100 border-0 position-relative">
                    <div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-15%</div>
                    <div class="product-image position-relative">
                        <img src="img/product-lego.jpg" alt="LEGO Classic" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">LEGO</div>
                        <h5 class="card-title product-name h6 mb-2">LEGO Classic Medium Creative Brick Box 10696</h5>
                        <div class="product-price mb-3">
                            <span class="text-decoration-line-through text-muted me-2">799.000đ</span>
                            <span class="fw-bold text-danger">679.000đ</span>
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
            <div class="row g4 gy-4 mt-4">
                <div class="card product-card h-100 border-0 position-relative">
                    <div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-15%</div>
                    <div class="product-image position-relative">
                        <img src="img/product-lego.jpg" alt="LEGO Classic" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">LEGO</div>
                        <h5 class="card-title product-name h6 mb-2">LEGO Classic Medium Creative Brick Box 10696</h5>
                        <div class="product-price mb-3">
                            <span class="text-decoration-line-through text-muted me-2">799.000đ</span>
                            <span class="fw-bold text-danger">679.000đ</span>
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
            <div class="row g4 gy-4 mt-4">
                <div class="card product-card h-100 border-0 position-relative">
                    <div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-15%</div>
                    <div class="product-image position-relative">
                        <img src="img/product-lego.jpg" alt="LEGO Classic" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">LEGO</div>
                        <h5 class="card-title product-name h6 mb-2">LEGO Classic Medium Creative Brick Box 10696</h5>
                        <div class="product-price mb-3">
                            <span class="text-decoration-line-through text-muted me-2">799.000đ</span>
                            <span class="fw-bold text-danger">679.000đ</span>
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
            <div class="row g4 gy-4 mt-4">
                <div class="card product-card h-100 border-0 position-relative">
                    <div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-15%</div>
                    <div class="product-image position-relative">
                        <img src="img/product-lego.jpg" alt="LEGO Classic" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">LEGO</div>
                        <h5 class="card-title product-name h6 mb-2">LEGO Classic Medium Creative Brick Box 10696</h5>
                        <div class="product-price mb-3">
                            <span class="text-decoration-line-through text-muted me-2">799.000đ</span>
                            <span class="fw-bold text-danger">679.000đ</span>
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
            <div class="row g4 gy-4 mt-4">
                <div class="card product-card h-100 border-0 position-relative">
                    <div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-15%</div>
                    <div class="product-image position-relative">
                        <img src="img/product-lego.jpg" alt="LEGO Classic" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">LEGO</div>
                        <h5 class="card-title product-name h6 mb-2">LEGO Classic Medium Creative Brick Box 10696</h5>
                        <div class="product-price mb-3">
                            <span class="text-decoration-line-through text-muted me-2">799.000đ</span>
                            <span class="fw-bold text-danger">679.000đ</span>
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
        </div> -->
        
        <!-- Product 3 -->
        <!-- <div class="col-4 mb-4">
            <div class="row g4 gy-4 mt-4">
                <div class="card product-card h-100 border-0 position-relative">
                    <div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-15%</div>
                    <div class="product-image position-relative">
                        <img src="img/product-lego.jpg" alt="LEGO Classic" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">LEGO</div>
                        <h5 class="card-title product-name h6 mb-2">LEGO Classic Medium Creative Brick Box 10696</h5>
                        <div class="product-price mb-3">
                            <span class="text-decoration-line-through text-muted me-2">799.000đ</span>
                            <span class="fw-bold text-danger">679.000đ</span>
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
            <div class="row g4 gy-4 mt-4">
                <div class="card product-card h-100 border-0 position-relative">
                    <div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-15%</div>
                    <div class="product-image position-relative">
                        <img src="img/product-lego.jpg" alt="LEGO Classic" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">LEGO</div>
                        <h5 class="card-title product-name h6 mb-2">LEGO Classic Medium Creative Brick Box 10696</h5>
                        <div class="product-price mb-3">
                            <span class="text-decoration-line-through text-muted me-2">799.000đ</span>
                            <span class="fw-bold text-danger">679.000đ</span>
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
            <div class="row g4 gy-4 mt-4">
                <div class="card product-card h-100 border-0 position-relative">
                    <div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-15%</div>
                    <div class="product-image position-relative">
                        <img src="img/product-lego.jpg" alt="LEGO Classic" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">LEGO</div>
                        <h5 class="card-title product-name h6 mb-2">LEGO Classic Medium Creative Brick Box 10696</h5>
                        <div class="product-price mb-3">
                            <span class="text-decoration-line-through text-muted me-2">799.000đ</span>
                            <span class="fw-bold text-danger">679.000đ</span>
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
            <div class="row g4 gy-4 mt-4">
                <div class="card product-card h-100 border-0 position-relative">
                    <div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-15%</div>
                    <div class="product-image position-relative">
                        <img src="img/product-lego.jpg" alt="LEGO Classic" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">LEGO</div>
                        <h5 class="card-title product-name h6 mb-2">LEGO Classic Medium Creative Brick Box 10696</h5>
                        <div class="product-price mb-3">
                            <span class="text-decoration-line-through text-muted me-2">799.000đ</span>
                            <span class="fw-bold text-danger">679.000đ</span>
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
            <div class="row g4 gy-4 mt-4">
                <div class="card product-card h-100 border-0 position-relative">
                    <div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-15%</div>
                    <div class="product-image position-relative">
                        <img src="img/product-lego.jpg" alt="LEGO Classic" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">LEGO</div>
                        <h5 class="card-title product-name h6 mb-2">LEGO Classic Medium Creative Brick Box 10696</h5>
                        <div class="product-price mb-3">
                            <span class="text-decoration-line-through text-muted me-2">799.000đ</span>
                            <span class="fw-bold text-danger">679.000đ</span>
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
  </div>
