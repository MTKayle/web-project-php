<!-- Main container -->
    <div class="container mt-4">
        <div class="row g-4">
            <!-- Left sidebar -->
            <div class="col-lg-2 col-md-3 sidebar-menu">
                <a href="#" class="logo"><img src="../view/resources/logo.png" alt="logo" width="150"></a>
                <div class="sidebar-menu mt-4">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active d-flex align-items-center" href="#" id="forum">
                                <i class="fas fa-newspaper me-2"></i> Bài viết mới
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#" id="savedPost">
                                <i class="fas fa-bookmark me-2"></i> Đã lưu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#" id="myPost">
                            <i class="fa-solid fa-circle-user me-2"></i> Bài viết của tôi
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
                        <form id="postForm" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="titleInput" class="form-label">Tiêu đề</label>
                                <input type="text" name="title" class="form-control" id="titleInput" placeholder="Nhập tiêu đề bài viết">
                            </div>

                            <div class="mb-3">
                                <label for="contentInput" class="form-label">Nội dung</label>
                                <textarea class="form-control" name="content" id="contentInput" rows="4" placeholder="Chia sẻ trải nghiệm của bạn..."></textarea>
                            </div>

                            <div class="mb-3 d-none">
                                <label for="imageInput" class="form-label">Gắn ảnh</label>
                                <input type="file" class="form-control" id="imageInput" accept="image/*">
                                <img id="imagePreview" alt="Ảnh xem trước">
                            </div>

                            <button type="submit" class="btn" id="submitButton">Đăng bài</button>
                            <button type="button" class="btn btn-danger ms-2" id="cancelButton">Hủy</button>
                        </form>
                    </div>
                </div>

                <!-- Filter tabs -->
                <!-- <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Phổ biến</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mới nhất</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Đang theo dõi</a>
                    </li>
                </ul> -->

                <!-- Posts -->
                <div id="posts-container">
                   <!-- render posts here -->
                </div>
            </div>
        </div>
    </div>


