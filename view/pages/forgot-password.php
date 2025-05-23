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
                            <p class="">Nhập mã xác thực được gửi về email của bạn</p>
                        </div>

                        <form id="verifyCodeForm">
                            <div class="mb-3 text-center">
                                <label for="verifyCode" class="form-label">Nhập mã xác thực</label>
                                <div class="d-flex justify-content-center gap-2">
                                    <input type="text" maxlength="1" class="form-control text-center code-input" required>
                                    <input type="text" maxlength="1" class="form-control text-center code-input" required>
                                    <input type="text" maxlength="1" class="form-control text-center code-input" required>
                                    <input type="text" maxlength="1" class="form-control text-center code-input" required>
                                    <input type="text" maxlength="1" class="form-control text-center code-input" required>
                                    <input type="text" maxlength="1" class="form-control text-center code-input" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <button type="button" class="btn btn-link p-0 d-none" id="resendCodeBtn" disabled>Gửi lại mã</button>
                                <span id="countdownTimer" class="text-muted">05:00</span>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2">Xác nhận</button>
                            <p id="error-message-otp" class="text-danger text-center mt-3" ></p>
                        </form>
                    </div>
                </div>
            </div>
            </div>
    </div>