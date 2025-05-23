<div class="d-flex">
    <!-- Main Content -->
    <div class="main-content">
        

        <!-- News Content -->
        <div class="container mt-4">
            <button id="toggleNewPost" class="btn btn-primary mb-3">Tạo tin tức</button>
            
            <div id="newPostSection" class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Tạo tin tức</h3>
                    <form id="newsForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề tin tức</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="overview" class="form-label">Mô tả chung</label>
                            <textarea id="overview" name="overview" class="form-control" rows="4"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Ảnh tiêu đề</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Tin tức</label>
                            <textarea id="content" name="content" class="form-control" rows="8"></textarea>
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
  








