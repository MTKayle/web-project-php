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
                    <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between mb-2">
                        <span>Siêu anh hùng</span>
                        <span class="text-muted">(908)</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                        <span>Phương tiện giao thông</span>
                        <span class="text-muted">(0)</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                        <span>Kẹo đồ chơi</span>
                        <span class="text-muted">(10)</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                        <span>Đồ chơi lắp ghép</span>
                        <span class="text-muted">(851)</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                        <span>Đồ chơi sáng tạo</span>
                        <span class="text-muted">(467)</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                        <span>Đồ thời trang</span>
                        <span class="text-muted">(339)</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                        <span>Thế giới động vật</span>
                        <span class="text-muted">(313)</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                        <span>Búp bê</span>
                        <span class="text-muted">(593)</span>
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
                            <input class="form-check-input" type="checkbox" id="brand1">
                            <label class="form-check-label" for="brand1">MINIFORCE</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="brand2">
                            <label class="form-check-label" for="brand2">ROBOCAR POLI</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="brand3">
                            <label class="form-check-label" for="brand3">TRANSFORMERS</label>
                        </div>
                    </div>

                    <!-- Price Section -->
                    <h5 class="text-danger mb-3">Giá (₫)</h5>
                    <div class="mb-4">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="price1">
                            <label class="form-check-label" for="price1">
                                Dưới 200.000₫
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="price2">
                            <label class="form-check-label" for="price2">
                                200.000₫ - 500.000₫
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="price3">
                            <label class="form-check-label" for="price3">
                                Trên 500.000₫
                            </label>
                        </div>
                    </div>

                    <!-- Gender Section -->
                    <h5 class="text-danger mb-3">Giới Tính</h5>
                    <div class="mb-4">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="gender1">
                            <label class="form-check-label" for="gender1">Nam</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gender2">
                            <label class="form-check-label" for="gender2">Nữ</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        <div class = "col-md-9" id="product-container">
            <!-- JS sẽ render nội dung vào đây -->

        </div>
       
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
