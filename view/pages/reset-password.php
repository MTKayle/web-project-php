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
                            <p class="">Tạo mật khẩu mới</p>
                        </div>

                        <form id="resetPasswordForm">
    <div class="mb-3">
        <label for="newPassword" class="form-label">Mật khẩu mới</label>
        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
    </div>

    <div class="mb-3">
        <label for="confirmPassword" class="form-label">Nhập lại mật khẩu</label>
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
    </div>

    <button type="submit" class="btn btn-primary w-100 py-2">Đặt lại mật khẩu</button>

    <p id="error-message-reset" class="text-danger text-center mt-3"></p>
    <p id="success-message-reset" class="text-success text-center mt-3"></p>
</form>

                    </div>
                </div>
            </div>
            </div>
    </div>