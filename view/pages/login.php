<div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                <polyline points="10 17 15 12 10 7"></polyline>
                                <line x1="15" y1="12" x2="3" y2="12"></line>
                            </svg>
                            <h2 class="mt-3">Hoope chào bạn!</h2>
                            <p class="">Đăng nhập tài khoản của bạn</p>
                        </div>

                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name = "password">
                            </div>

                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <a href="#" class="text-decoration-none" id="forgotPassword">Quên mật khẩu mất rồi</a>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2">
                                Đăng nhập
                            </button>

                            <p id="error-message-login" class="text-danger text-center mt-3" ></p>
                            <p id="success-message-login" class="text-success text-center mt-3"></p>

                            <div class="text-center mt-4">
                                <p class="text-muted">
                                    Chưa có tài khoản? 
                                    <!-- <button id="new-account-button" class="text-decoration-none" type="button">Tạo tài khoản mới</button> -->
                                    <a href="?page=sign-up" class="text-decoration-none">Tạo tài khoản mới</a>
                                </p>
                            </div>
                        </form>

                        <form id="forgotPasswordForm" style="display: none;">
    <div class="mb-3">
        <label for="forgotEmail" class="form-label">Nhập email để nhận mã xác thực</label>
        <input type="email" class="form-control" id="forgotEmail" name="forgotEmail" required>
    </div>

    <button type="submit" id="sendOtpBtn" class="btn btn-warning w-100 py-2">Gửi mã OTP</button>

    <!-- Spinner loading (ẩn mặc định) -->
    <div id="loadingOtp" class="text-center py-2" style="display: none;">
        <div class="spinner-border text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="mt-2">Đang gửi mã OTP...</div>
    </div>

    <p id="error-message-otp" class="text-danger text-center mt-3"></p>
    <p id="success-message-otp" class="text-success text-center mt-3"></p>

    <div class="text-center mt-3">
        <a href="#" class="text-decoration-none" id="backToLogin">Quay lại đăng nhập</a>
    </div>
</form>

                    </div>
                </div>
            </div>
            </div>
    </div>