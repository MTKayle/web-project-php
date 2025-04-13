<div class="container">
        <!-- Main Title -->
        <h1 class="main-title">Tài Khoản Của Bạn</h1>
        
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 mb-4">
                <div class="sidebar">
                    <div class="sidebar-title">
                        Tài Khoản Của Bạn
                    </div>
                    <ul class="sidebar-menu">
                        <li class="active"><a href="#">Tài khoản</a></li>
                        <li><a href="#">Lịch sử mua hàng</a></li>
                        <li><a href="#">Điểm tích luỹ</a></li>
                        <li><a href="#" id="logout-button">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9">
                <div class="content-box">
                    <h2 class="section-title">Thông Tin Tài Khoản</h2>
                    
                    <form id="account-form">

                    <input type="hidden" id="userId" name="userId">

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <p class="info-label">Họ và tên</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="fullname" >
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <p class="info-label">Điện thoại</p>
                            </div>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" id="phone" >
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <p class="info-label">Email</p>
                            </div>
                            <div class="col-md-9">
                                <input type="email" class="form-control" id="email"  disabled>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <p class="info-label">Địa chỉ</p>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" id="address" rows="3"></textarea>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <p class="info-label">Avatar</p>
                            </div>
                            <div class="col-md-9">
                                <div class="d-flex align-items-center">
                                    <img src id="avatar-preview" class="rounded-circle me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                    <div>
                                        <input type="file" id="avatar-input" accept="image/*" style="display: none;">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" id="avatar-button">Chọn ảnh</button>
                                        <p class="text-muted mt-2 mb-0" style="font-size: 12px;">Định dạng: .JPEG, .PNG, tối đa 5MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p id="error-message-updateinfo" class="text-danger text-center mt-3" ></p>
                        <p id="success-message-updateinfo" class="text-success text-center mt-3"></p>
                        
                        <div class="save-section">
                            <button type="submit" class="btn-save btn" id="save-button">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
                
        
    
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thành công</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Cập nhật thông tin tài khoản thành công!</p>
                    <pre id="form-data-display" class="bg-light p-3 mt-3" style="font-size: 13px;"></pre>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>