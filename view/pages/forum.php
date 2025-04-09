<!-- Main container -->
    <div class="container mt-4">
        <div class="row g-4">
            <!-- Left sidebar -->
            <div class="col-lg-2 col-md-3">
                <a href="#" class="logo"><img src="../view/resources/logo.png" alt="logo" width="150"></a>
                <div class="sidebar-menu mt-4">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active d-flex align-items-center" href="#">
                                <i class="fas fa-newspaper me-2"></i> Bài viết mới
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="fas fa-bookmark me-2"></i> Đã lưu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="fas fa-star me-2"></i> Sản phẩm nổi bật
                            </a>
                        </li>
                    </ul>

                    <h6 class="mt-4 text-muted ps-3 mb-3">Danh mục</h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="fas fa-puzzle-piece me-2"></i> Đồ chơi sáng tạo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="fas fa-robot me-2"></i> Đồ chơi STEM
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="fas fa-lightbulb me-2"></i> Khoa học vui
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Main content area -->
            <div class="col-lg-7 col-md-9">
                <!-- Post input area -->
                <div class="mb-3">
                    <input type="text" class="form-control post-card" id="triggerInput" placeholder="Bạn đang nghĩ gì...">
                </div>

                <!-- Form đăng bài review -->
                <div class="card post-card" id="reviewForm">
                    <div class="card-body">
                        <h5 class="card-title">Viết bài review</h5>
                        <form>
                            <div class="mb-3">
                                <label for="titleInput" class="form-label">Tiêu đề</label>
                                <input type="text" class="form-control" id="titleInput" placeholder="Nhập tiêu đề bài viết">
                            </div>

                            <div class="mb-3">
                                <label for="contentInput" class="form-label">Nội dung</label>
                                <textarea class="form-control" id="contentInput" rows="4" placeholder="Chia sẻ trải nghiệm của bạn..."></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="imageInput" class="form-label">Gắn ảnh</label>
                                <input type="file" class="form-control" id="imageInput" accept="image/*">
                                <img id="imagePreview" alt="Ảnh xem trước">
                            </div>

                            <button type="submit" class="btn" id="submitButton" style="background-color: #f2ff4e;">Đăng bài</button>
                            <button type="button" class="btn btn-danger ms-2" id="cancelButton">Hủy</button>
                        </form>
                    </div>
                </div>

                <!-- Filter tabs -->
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Phổ biến</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mới nhất</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Đang theo dõi</a>
                    </li>
                </ul>

                <!-- Posts -->
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="author-avatar me-3">
                            <img src="/api/placeholder/48/48" class="w-100 h-100" alt="avatar">
                        </div>
                        <div>
                            <div class="fw-bold">Bui Gia Bao</div>
                            <small class="text-muted">1 giờ trước</small>
                        </div>
                        <button class="btn btn-sm follow-btn btn-action ms-auto">
                                <i class="fas fa-user-plus me-1"></i> Follow
                        </button>
                    </div>

                    <h5 class="post-title">Đất nặn sáng tạo. Thật hay đùa!</h5>

                    <div class="mb-2">
                        <span class="post-tag"><i class="fas fa-tag me-1"></i>Đồ chơi sáng tạo</span>
                        <span class="post-tag"><i class="fas fa-child me-1"></i>2-6 tuổi</span>
                    </div>

                    <p class="card-text text-muted">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Đất nặn là một trong những đồ chơi sáng tạo tuyệt vời nhất cho bé từ 2-6 tuổi. Nó không chỉ giúp trẻ phát triển khả năng vận động tinh, mà còn kích thích trí tưởng tượng và óc sáng tạo.
                    </p>



                    <p class="card-text text-muted">
                        Tuy nhiên, các bậc phụ huynh cần lưu ý chọn đất nặn an toàn, không chứa hóa chất độc hại và phù hợp với độ tuổi của trẻ. Hãy cùng con khám phá thế giới sáng tạo với đất nặn nhé!
                    </p>
                    <div class="post-image">
                        <img src="sale banner.jpg" class="w-100" alt="post image" style="border-radius: 5px;">
                    </div>

                    <div class="d-flex mt-3">
                        <button class="reaction-btn comment-toggle">
                            <i class="fas fa-comment me-1"></i> Bình luận
                        </button>
                        <button class="reaction-btn">
                            <i class="fas fa-bookmark me-1"></i> Lưu
                        </button>
                    </div>

                    <!-- Phần bình luận (mặc định ẩn) -->
                    <div class="comment-section mt-3" style="display: none;">
                        <!-- Khung nhập bình luận -->
                        <div class="d-flex mb-3">
                            <div class="comment-avatar me-2">
                                <img src="/api/placeholder/36/36" class="w-100 h-100" alt="your avatar">
                            </div>
                            <div class="flex-grow-1">
                                <div class="input-group">
                                    <input type="text" class="form-control comment-input" placeholder="Viết bình luận...">
                                    <button class="btn btn-sm" style="background-color: #92c83e; color: white;">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Danh sách bình luận -->
                        <div class="comment-list">
                            <!-- Bình luận đầu tiên -->
                            <div class="d-flex mb-3">
                                <div class="comment-avatar me-2">
                                    <img src="/api/placeholder/36/36" class="w-100 h-100" alt="commenter avatar">
                                </div>
                                <div class="comment-bubble">
                                    <div class="fw-bold">Nguyen Van A</div>
                                    <div class="text-muted small">Sản phẩm rất tốt cho bé nhà mình, mua lần thứ 2 rồi!</div>
                                    <div class="d-flex mt-1">
                                        <small class="text-muted me-3">30 phút trước</small>
                                        <small class="text-primary cursor-pointer">Trả lời</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Bình luận thứ hai -->
                            <div class="d-flex mb-3">
                                <div class="comment-avatar me-2">
                                    <img src="/api/placeholder/36/36" class="w-100 h-100" alt="commenter avatar">
                                </div>
                                <div class="comment-bubble">
                                    <div class="fw-bold">Tran Thi B</div>
                                    <div class="text-muted small">Bé nhà mình thích lắm, chơi cả ngày không chán!</div>
                                    <div class="d-flex mt-1">
                                        <small class="text-muted me-3">45 phút trước</small>
                                        <small class="text-primary cursor-pointer">Trả lời</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="author-avatar me-3">
                            <img src="/api/placeholder/48/48" class="w-100 h-100" alt="avatar">
                        </div>
                        <div>
                            <div class="fw-bold">Bui Gia Bao</div>
                            <small class="text-muted">1 giờ trước</small>
                        </div>
                        <button class="btn btn-sm follow-btn btn-action ms-auto">
                                <i class="fas fa-user-plus me-1"></i> Follow
                        </button>
                    </div>

                    <h5 class="post-title">Đất nặn sáng tạo. Thật hay đùa!</h5>

                    <div class="mb-2">
                        <span class="post-tag"><i class="fas fa-tag me-1"></i>Đồ chơi sáng tạo</span>
                        <span class="post-tag"><i class="fas fa-child me-1"></i>2-6 tuổi</span>
                    </div>

                    <p class="card-text text-muted">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Đất nặn là một trong những đồ chơi sáng tạo tuyệt vời nhất cho bé từ 2-6 tuổi. Nó không chỉ giúp trẻ phát triển khả năng vận động tinh, mà còn kích thích trí tưởng tượng và óc sáng tạo.
                    </p>



                    <p class="card-text text-muted">
                        Tuy nhiên, các bậc phụ huynh cần lưu ý chọn đất nặn an toàn, không chứa hóa chất độc hại và phù hợp với độ tuổi của trẻ. Hãy cùng con khám phá thế giới sáng tạo với đất nặn nhé!
                    </p>
                    <div class="post-image">
                        <img src="sale banner.jpg" class="w-100" alt="post image" style="border-radius: 5px;">
                    </div>

                    <div class="d-flex mt-3">
                        <button class="reaction-btn comment-toggle">
                            <i class="fas fa-comment me-1"></i> Bình luận
                        </button>
                        <button class="reaction-btn">
                            <i class="fas fa-bookmark me-1"></i> Lưu
                        </button>
                    </div>

                    <!-- Phần bình luận (mặc định ẩn) -->
                    <div class="comment-section mt-3" style="display: none;">
                        <!-- Khung nhập bình luận -->
                        <div class="d-flex mb-3">
                            <div class="comment-avatar me-2">
                                <img src="/api/placeholder/36/36" class="w-100 h-100" alt="your avatar">
                            </div>
                            <div class="flex-grow-1">
                                <div class="input-group">
                                    <input type="text" class="form-control comment-input" placeholder="Viết bình luận...">
                                    <button class="btn btn-sm" style="background-color: #92c83e; color: white;">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Danh sách bình luận -->
                        <div class="comment-list">
                            <!-- Bình luận đầu tiên -->
                            <div class="d-flex mb-3">
                                <div class="comment-avatar me-2">
                                    <img src="/api/placeholder/36/36" class="w-100 h-100" alt="commenter avatar">
                                </div>
                                <div class="comment-bubble">
                                    <div class="fw-bold">Nguyen Van A</div>
                                    <div class="text-muted small">Sản phẩm rất tốt cho bé nhà mình, mua lần thứ 2 rồi!</div>
                                    <div class="d-flex mt-1">
                                        <small class="text-muted me-3">30 phút trước</small>
                                        <small class="text-primary cursor-pointer">Trả lời</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Bình luận thứ hai -->
                            <div class="d-flex mb-3">
                                <div class="comment-avatar me-2">
                                    <img src="/api/placeholder/36/36" class="w-100 h-100" alt="commenter avatar">
                                </div>
                                <div class="comment-bubble">
                                    <div class="fw-bold">Tran Thi B</div>
                                    <div class="text-muted small">Bé nhà mình thích lắm, chơi cả ngày không chán!</div>
                                    <div class="d-flex mt-1">
                                        <small class="text-muted me-3">45 phút trước</small>
                                        <small class="text-primary cursor-pointer">Trả lời</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
