<div class="container my-5">
        <!-- Tiến trình thanh toán -->
        <div class="progress-container mb-4">
            <div class="row">
                <div class="col-4 progress-step step-completed">
                    <div class="progress-line"></div>
                    <div class="step-icon">
                        <i class="bi bi-cart"></i>
                    </div>
                    <div class="step-label">Giỏ hàng</div>
                </div>
                <div class="col-4 progress-step step-active">
                    <div class="progress-line"></div>
                    <div class="step-icon">
                        <i class="bi bi-credit-card"></i>
                    </div>
                    <div class="step-label">Thanh toán</div>
                </div>
                <div class="col-4 progress-step">
                    <div class="progress-line"></div>
                    <div class="step-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <div class="step-label">Hoàn tất</div>
                </div>
            </div>
        </div>

        <h2 class="text-center mb-4">Thanh Toán</h2>

        <div class="row">
            <!-- Form thông tin thanh toán -->
            <div class="col-lg-8">
                <!-- Thông tin liên hệ -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Thông tin liên hệ</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="lastName" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" id="fullnamepayment" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="emailpayment" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phonepayment" required>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Địa chỉ giao hàng -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Địa chỉ giao hàng</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="addresspayment" required>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Ghi chú (tùy chọn)</label>
                                <textarea class="form-control" id="note" rows="3" placeholder="Thông tin bổ sung cho đơn hàng..."></textarea>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Phương thức thanh toán -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Phương thức thanh toán</h5>
                    </div>
                    <div class="card-body">
                        <div class="payment-option selected mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="cod" checked>
                                <label class="form-check-label d-flex align-items-center" for="cod">
                                    <i class="bi bi-cash-coin me-2 fs-4"></i>
                                    <div>
                                        <div class="fw-bold">Thanh toán khi nhận hàng (COD)</div>
                                        <div class="text-muted small">Quý khách sẽ thanh toán khi nhận được hàng</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="payment-option mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="banking">
                                <label class="form-check-label d-flex align-items-center" for="banking">
                                    <i class="bi bi-bank me-2 fs-4"></i>
                                    <div>
                                        <div class="fw-bold">Chuyển khoản ngân hàng</div>
                                        <div class="text-muted small">Thanh toán qua tài khoản ngân hàng</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="payment-option mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="vnpay">
                                <label class="form-check-label d-flex align-items-center" for="vnpay">
                                    <i class="bi bi-credit-card me-2 fs-4"></i>
                                    <div>
                                        <div class="fw-bold">Thanh toán qua VNPay</div>
                                        <div class="text-muted small">Thanh toán an toàn với VNPay</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="payment-option">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="momo">
                                <label class="form-check-label d-flex align-items-center" for="momo">
                                    <i class="bi bi-wallet2 me-2 fs-4"></i>
                                    <div>
                                        <div class="fw-bold">Ví Momo</div>
                                        <div class="text-muted small">Thanh toán qua ví điện tử Momo</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tổng đơn hàng -->
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Tổng đơn hàng</h5>
                    </div>
                    <div class="card-body">
                        
                        <!-- Danh sách sản phẩm -->
                        <div class="cart-items mb-3">
                            <!-- Sản phẩm 1 -->
                            <!-- <div class="d-flex align-items-center py-2 border-bottom">
                                <img src="/api/placeholder/60/60" alt="Đồ chơi 1" class="cart-item-img rounded me-3">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Đồ chơi 1</h6>
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <span class="text-danger fw-bold">250.000₫</span>
                                        <span class="badge bg-light text-dark">x1</span>
                                    </div>
                                </div>
                            </div> -->

                            <!-- Sản phẩm 2 -->
                            <!-- <div class="d-flex align-items-center py-2 border-bottom">
                                <img src="/api/placeholder/60/60" alt="Đồ chơi 2" class="cart-item-img rounded me-3">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Đồ chơi 2</h6>
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <span class="text-danger fw-bold">450.000₫</span>
                                        <span class="badge bg-light text-dark">x1</span>
                                    </div>
                                </div>
                            </div> -->

                            <!-- Sản phẩm 3 -->
                            <!-- <div class="d-flex align-items-center py-2 border-bottom">
                                <img src="/api/placeholder/60/60" alt="Đồ chơi 3" class="cart-item-img rounded me-3">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Đồ chơi 3</h6>
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <span class="text-danger fw-bold">850.000₫</span>
                                        <span class="badge bg-light text-dark">x1</span>
                                    </div>
                                </div>
                            </div>-->
                            <div id="listProduct">
                            <!-- render list product here -->

                            </div>
                        </div> 

                        <!-- Mã giảm giá -->
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Mã giảm giá">
                                <button class="btn" type="button">Áp dụng</button>
                            </div>
                        </div>

                        <!-- Tổng tiền -->
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính:</span>
                            <span class="fw-bold" id="tempAmount"></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí vận chuyển:</span>
                            <span class="fw-bold" id="">30.000₫</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Tổng cộng:</span>
                            <span class="fw-bold text-danger fs-5" id="totalAmountOrder"></span>
                        </div>

                        <!-- Nút đặt hàng -->
                        <button type="submit" class="btn w-100 py-2 mb-3">Đặt hàng</button>
                        <a href="?page=cart" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-left me-2"></i>Quay lại giỏ hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>