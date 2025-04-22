<main class="container my-5">
    <h2 class="text-center mb-4" id="title-cart">Giỏ hàng của bạn</h2>
    <!-- Cart Content -->
    <div class="row" id="cart-content">
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr style="background-color: #fff0d0; color: #524117;">
                                    <th class="py-3 ps-4">Sản phẩm</th>
                                    <th class="py-3 text-center">Giá</th>
                                    <th class="py-3 text-center">Số lượng</th>
                                    <th class="py-3 text-center">Tổng</th>
                                    <th class="py-3 text-center"><span class="visually-hidden">Xóa</span></th>
                                </tr>
                            </thead>

                            <tbody id="cart-body">
                                <!-- render cartItems here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white py-3">
                    <a href="./" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        </div>

        <!-- Cart Summary -->
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Tổng giỏ hàng</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span>Tạm tính</span>
                        <span class="fw-bold cart-subtotal">0đ</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Vận chuyển</span>
                        <span class="fw-bold cart-shipping">0đ</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold">Tổng cộng</span>
                        <span class="fw-bold text-danger fs-5 cart-total">0đ</span>
                    </div>
                    <!-- <button href="?page=pay" class="btn btn-pay w-100">Tiến hành thanh toán</button> -->
                    <a href="?page=pay">
                        <button class="btn btn-pay w-100">Tiến hành thanh toán</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Empty Cart (Hidden by default) -->
    <div class="text-center py-5 d-none" id="empty-cart">
        <i class="bi bi-cart-x display-1 text-muted mb-3"></i>
        <h3>Giỏ hàng của bạn đang trống</h3>
        <a href="./" class="btn btn-primary mt-4">Đi đến cửa hàng</a>
    </div>
</main>