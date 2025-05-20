<div class="d-flex">
        <div class="main-content flex-grow-1">
            <header class="bg-white border-bottom p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="search-bar">
                        <form method="GET" action="../index.php">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                                <input type="text" name="search" class="form-control bg-light border-start-0" placeholder="Search products..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                                <input type="hidden" name="page" value="products">
                                <input type="hidden" name="p" value="<?= htmlspecialchars($currentPage, ENT_QUOTES, 'UTF-8') ?>">
                            </div>
                        </form>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <button class="btn btn-light position-relative" title="Notifications">
                            <i class="bi bi-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                        </button>
                        <div class="dropdown">
                            <button class="btn d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg" class="avatar" alt="Admin">
                                <div class="d-none d-md-block text-start">
                                    <div class="fw-bold">Alex Johnson</div>
                                    <div class="small text-muted">Admin</div>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <div id="alertContainer"></div>

            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Products</h2>
                    <!-- Nút Add New Product -->
                    <button id="addProductBtn" class="btn btn-primary mb-3">Add New Product</button>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="productsTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($products) && !empty($products)): ?>
                                        <?php foreach ($products as $product): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($product->productID, ENT_QUOTES, 'UTF-8') ?></td>
                                                <td><?= htmlspecialchars($product->productName, ENT_QUOTES, 'UTF-8') ?></td>
                                                <td><?= htmlspecialchars($product->title, ENT_QUOTES, 'UTF-8') ?></td>
                                                <td><?= htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8') ?></td>
                                                <td>$<?= number_format(htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'), 2) ?></td>
                                                <td><?= htmlspecialchars($product->stockQuantity, ENT_QUOTES, 'UTF-8') ?></td>
                                                <td>
                                                    <?php if (!empty($product->image)): ?>
                                                        <img src="<?= htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8') ?>" alt="Product Image" class="product-img">
                                                    <?php else: ?>
                                                        <span>No image</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="edit_product.php?id=<?= htmlspecialchars($product->productID, ENT_QUOTES, 'UTF-8') ?>" class="btn btn-sm btn-light me-2" title="Edit"><i class="bi bi-pencil"></i></a>
                                                    <button class="btn btn-sm btn-light delete-product" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-product-id="<?= htmlspecialchars($product->productID, ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-trash"></i></button>
                                                    <button class="btn btn-sm btn-light" title="Tải bộ sưu tập" data-product-id="<?= htmlspecialchars($product->productID, ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-eye"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No products found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-end">
                                <?php
                                $totalPages = ceil($totalProducts / $perPage);
                                $prevClass = $currentPage <= 1 ? 'disabled' : '';
                                echo '<li class="page-item ' . $prevClass . '">';
                                echo '<a class="page-link" href="../admin/index.php?page=products&p=' . ($currentPage - 1) . '">Previous</a>';
                                echo '</li>';

                                for ($i = 1; $i <= $totalPages; $i++) {
                                    $activeClass = $i == $currentPage ? 'active' : '';
                                    echo '<li class="page-item ' . $activeClass . '">';
                                    echo '<a class="page-link" href="../admin/index.php?page=products&p=' . $i . '">' . $i . '</a>';
                                    echo '</li>';
                                }

                                $nextClass = $currentPage >= $totalPages ? 'disabled' : '';
                                echo '<li class="page-item ' . $nextClass . '">';
                                echo '<a class="page-link" href="../admin/index.php?page=products&p=' . ($currentPage + 1) . '">Next</a>';
                                echo '</li>';
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa sản phẩm này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Có</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Thêm Sản Phẩm -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="addProductForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductLabel">Add New Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Product Name</label>
                            <input type="text" name="productName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control" step="0.01" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label>Stock Quantity</label>
                            <input type="number" name="stockQuantity" class="form-control" min="1" step="1" required>
                        </div>
                        <!-- Brand -->
                        <div class="mb-3">
                            <label>Brand</label>
                            <select name="brandID" class="form-control" id="brandSelect" required></select>
                        </div>
                        <div class="mb-3">
                            <label>Category</label>
                            <select name="categoryID" class="form-control" id="categorySelect" required></select>
                        </div>
                        <div class="mb-3">
                            <label>Age From</label>
                            <input type="number" name="ageFrom" class="form-control" min="1" step="1" required>
                        </div>
                        <div class="mb-3">
                            <label>Age To</label>
                            <input type="number" name="ageTo" class="form-control" min="1" step="1" required>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*" id="inputProductImg" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add Product</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js_admin/product.js"></script>
    <script>
        // Truyền biến từ PHP sang JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            var currentPage = <?= json_encode(htmlspecialchars($currentPage, ENT_QUOTES, 'UTF-8')) ?>;
            var search = <?= json_encode(isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '') ?>;
            initializeProducts(currentPage, search);
        });
    </script>

    <script>
        document.getElementById('addProductBtn').addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('addProductModal'));
            modal.show();
        });

        document.getElementById('addProductForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const inputProductImg = document.getElementById('inputProductImg');

            if (inputProductImg.files.length > 0) {
                formData.append('image', inputProductImg.files[0]);
            }

            fetch('/web-project-php/api.php?controller=adminProduct&action=add', {
                method: 'POST',
                body: formData
            })
            .then(res => {
                if (!res.ok) {
                    throw new Error('Phản hồi từ server không thành công');
                }
                return res.json();
            })
            .then(data => {
                if (data.success) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addProductModal'));
                    if (modal) {
                        modal.hide();
                        alert('Thêm sản phẩm thành công');
                        location.reload();
                    } else {
                        console.error('Không tìm thấy instance của modal');
                    }
                } else {
                    alert('Lỗi: ' + (data.message || 'Không thể thêm sản phẩm'));
                }
            })
            .catch(error => {
                console.error('Lỗi trong quá trình fetch:', error);
                alert('Đã xảy ra lỗi khi thêm sản phẩm');
            });
        });
    </script>

    <!-- PHP để load danh sách brand và category -->
    <?php
    // Bạn cần thay thế các service sau bằng class thật nếu có
    require_once __DIR__ . '/../../service/AdminBrandService.php';
    require_once __DIR__ . '/../../service/AdminCategoryService.php';

    $brandService = new AdminBrandService();
    $brands = $brandService->getAllActiveBrands();

    $categoryService = new AdminCategoryService();
    $categories = $categoryService->getAllActiveCategories();
    ?>



    <script>
        const brandSelect = document.getElementById('brandSelect');
        const categorySelect = document.getElementById('categorySelect');

        <?php foreach ($brands as $brand): ?>
            brandSelect.innerHTML += `<option value="<?= $brand['brandID'] ?>"><?= $brand['brandName'] ?></option>`;
        <?php endforeach; ?>

        <?php foreach ($categories as $category): ?>
            categorySelect.innerHTML += `<option value="<?= $category['categoryID'] ?>"><?= $category['categoryName'] ?></option>`;
        <?php endforeach; ?>
    </script>