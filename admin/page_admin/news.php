<div class="d-flex">
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="bg-white border-bottom p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="search-bar">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control bg-light border-start-0" placeholder="Search orders...">
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-light position-relative">
                        <i class="bi bi-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                    </button>
                    <div class="dropdown">
                        <button class="btn d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                            <img src="../assets/avatar/admin.jpg" class="avatar" alt="Admin">
                            <div class="d-none d-md-block text-start">
                                <div class="fw-bold" id="adminName"></div>
                                <div class="small text-muted">Admin</div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- News Content -->
        <div class="container mt-4">
            <button id="toggleNewPost" class="btn btn-primary mb-3">Tạo tin tức</button>
            
            <div id="newPostSection" class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Tạo tin tức</h3>
                    <form id="newsForm">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tên bài tin tức</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Tin tức</label>
                            <textarea id="content" name="content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body row">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="card-title mb-0">Danh sách tin tức</h3>
                        <div class="input-group w-25">
                            <input type="text" id="searchArticle" class="form-control" placeholder="Tìm kiếm bài viết">
                            <button class="input-group-text" id="btnSearch">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã tin tức</th>
                                <th>Tên</th>
                                <th>Ngày đăng</th>
                                <th>Đăng bởi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="articleTableBody">
                            <!-- Render articles here -->
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <nav aria-label="Order Pagination" class="mt-4">
                        <ul class="pagination justify-content-center" id="pagination">
                            <!-- render pagination here -->
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Include CKEditor -->
<script src="../ckeditor/ckeditor.js"></script>
  

<!-- Initialize CKEditor
<script>
    // // Initialize CKEditor
    CKEDITOR.replace('content', {
        // Upload cho file thông thường
    filebrowserUploadUrl: '../admin/ck_upload.php',
    filebrowserUploadMethod: 'form',
    
    // Upload cho image (quan trọng!)
    filebrowserImageUploadUrl: '../admin/ck_upload.php',
    filebrowserImageUploadMethod: 'form',
    
    // Cấu hình thêm để hiện button Upload
    // filebrowserImageBrowseUrl: '../admin/ck_upload.php',
    
    // Kích hoạt plugin image
    extraPlugins: 'image',
    });

    
    // Toggle new post section
    const toggleButton = document.getElementById('toggleNewPost');
    const newPostSection = document.getElementById('newPostSection');
    toggleButton.addEventListener('click', () => {
        newPostSection.style.display = newPostSection.style.display === 'none' ? 'block' : 'none';
    });
</script> -->






