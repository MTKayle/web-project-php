// filepath: c:\xampp\htdocs\web-project-php\admin\assets_admin\js_admin\products.js



function initializeProducts(currentPage, search) {
    var deleteModal = document.getElementById('deleteModal');
    var confirmDeleteBtn = document.getElementById('confirmDelete');
    var alertContainer = document.getElementById('alertContainer');
    var productId;

    // Gắn sự kiện khôi phục scroll ngay khi modal đóng (bất kể người dùng nhấn gì)
    deleteModal.addEventListener('hidden.bs.modal', function () {
        console.log('Modal closed, restoring scroll');
        restoreScroll();
    });

    // Hàm hiển thị và tự động đóng thông báo sau 2 giây
    function showAlert(message, type) {
        console.log('Showing alert:', { message, type });
        alertContainer.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        var alertElement = alertContainer.querySelector('.alert');
        if (alertElement) {
            try {
                if (typeof bootstrap !== 'undefined' && bootstrap.Alert) {
                    var bsAlert = bootstrap.Alert.getOrCreateInstance(alertElement);
                    console.log('Bootstrap Alert instance created:', bsAlert);
                    setTimeout(() => {
                        console.log('Closing alert after 2s');
                        bsAlert.close();
                    }, 2000);
                } else {
                    console.warn('Bootstrap Alert not available, using fallback');
                    setTimeout(() => {
                        alertElement.classList.remove('show');
                        alertElement.classList.add('fade');
                        setTimeout(() => {
                            alertElement.remove();
                        }, 150);
                    }, 2000);
                }
            } catch (error) {
                console.error('Error initializing alert:', error);
                setTimeout(() => {
                    alertElement.classList.remove('show');
                    alertElement.classList.add('fade');
                    setTimeout(() => {
                        alertElement.remove();
                    }, 150);
                }, 2000);
            }
        } else {
            console.error('Alert element not found');
        }
    }

    // Hàm khôi phục trạng thái cuộn
    function restoreScroll() {
        console.log('Restoring scroll state');
        document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
            console.log('Removing backdrop:', backdrop);
            backdrop.remove();
        });
        document.body.classList.remove('modal-open');
        document.body.style.overflow = 'auto';
        document.body.style.paddingRight = '';
    }

    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        productId = button.getAttribute('data-product-id');
        var productName = button.closest('tr').querySelector('td:nth-child(2)').textContent;
        deleteModal.querySelector('.modal-body').textContent = 'Bạn có chắc chắn muốn xóa sản phẩm "' + productName + '" không?';
    });

    confirmDeleteBtn.addEventListener('click', function () {
        confirmDeleteBtn.disabled = true;
        confirmDeleteBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Đang xóa...';

        fetch('../public/ajax/delete_product.php?id=' + productId, {
            method: 'GET'
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                console.log('Delete response:', data);
                var modalInstance = bootstrap.Modal.getInstance(deleteModal);
                if (modalInstance) {
                    modalInstance.hide();
                } else {
                    console.error('Modal instance not found');
                }

                showAlert(data.message, data.success ? 'success' : 'danger');

                if (data.success) {
                    var refreshUrl = '/web-project-php/admin/index.php?page=products&p=' + currentPage + (search ? '&search=' + encodeURIComponent(search) : '');
                    console.log('Refreshing table with URL:', refreshUrl);

                    var tableBody = document.querySelector('#productsTable tbody');
                    var pagination = document.querySelector('.pagination');
                    if (tableBody && pagination) {
                        tableBody.style.transition = 'opacity 0.3s';
                        pagination.style.transition = 'opacity 0.3s';
                        tableBody.style.opacity = '0';
                        pagination.style.opacity = '0';
                    }

                    fetch(refreshUrl)
                        .then(response => {
                            console.log('Refresh response status:', response.status);
                            if (!response.ok) {
                                throw new Error('Failed to refresh table: ' + response.status);
                            }
                            return response.text();
                        })
                        .then(html => {
                            console.log('Received HTML length:', html.length);
                            var parser = new DOMParser();
                            var doc = parser.parseFromString(html, 'text/html');

                            var newTableBody = doc.querySelector('#productsTable tbody');
                            var currentTableBody = document.querySelector('#productsTable tbody');
                            if (newTableBody && currentTableBody) {
                                currentTableBody.innerHTML = newTableBody.innerHTML;
                                currentTableBody.style.opacity = '1';
                                console.log('Table body updated successfully');
                            } else {
                                console.error('Table body not found - newTableBody:', !!newTableBody, 'currentTableBody:', !!currentTableBody);
                                throw new Error('Failed to update table body');
                            }

                            var newPagination = doc.querySelector('.pagination');
                            var currentPagination = document.querySelector('.pagination');
                            if (newPagination && currentPagination) {
                                currentPagination.innerHTML = newPagination.innerHTML;
                                currentPagination.style.opacity = '1';
                                console.log('Pagination updated successfully');
                            } else {
                                console.error('Pagination not found - newPagination:', !!newPagination, 'currentPagination:', !!currentPagination);
                                throw new Error('Failed to update pagination');
                            }

                            document.querySelectorAll('.delete-product').forEach(button => {
                                button.addEventListener('click', function () {
                                    productId = this.getAttribute('data-product-id');
                                    var modal = new bootstrap.Modal(deleteModal);
                                    modal.show();
                                });
                            });
                        })
                        .catch(error => {
                            console.error('Error refreshing table:', error);
                            showAlert('Failed to refresh product list: ' + error.message, 'danger');
                            if (tableBody && pagination) {
                                tableBody.style.opacity = '1';
                                pagination.style.opacity = '1';
                            }
                        });
                }
            })
            .catch(error => {
                console.error('Error during delete:', error);
                var modalInstance = bootstrap.Modal.getInstance(deleteModal);
                if (modalInstance) {
                    modalInstance.hide();
                }

                showAlert('Error deactivating product: ' + error.message, 'danger');
            })
            .finally(() => {
                confirmDeleteBtn.disabled = false;
                confirmDeleteBtn.innerHTML = 'Có';
            });
    });
}

//edit product
$(document).ready(function () {

    //lay thong tin user
$.ajax({
    url: `${baseUrl}/ajax/login.php`,
    type: 'GET',
    dataType: 'json',
    success: function (response) {
        if(response.success){
            const user = response.user;
            $('#adminName').text(user.name);
        }
    },
    error: function (error) {
        console.error('Error fetching user info:', error);
    }
});


    $('.editProduct').on('click', function () {
        console.log('Edit product button clicked');
        // lay thong tin san pham
        const productId = $(this).data('product-id');
        //ajax call to get product details
        $.ajax({
            url: `${baseUrl}/ajax/product.php`,
            type: 'POST',
            data: { productID: productId, action: 'get' },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    openEditProductModal(response.product);
                } else {
                    console.error('Failed to fetch product details:', response.message);
                }
            },
            error: function () {
                console.error('Error fetching product details');
            }
        });
    });

    document.getElementById('editProductForm').addEventListener('submit', function (e) {
        e.preventDefault();
    
        const formData = new FormData(this);
    
        formData.append('action', 'edit');
        const productId = document.getElementById('editProductId').value;
        formData.append('productID', productId);

        // Send the AJAX request
        $.ajax({
            url: `${baseUrl}/ajax/product.php`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    alert('Cập nhật sản phẩm thành công!', 'success');
                    // Refresh the product list or redirect as needed
                    window.location.reload();
                } else {
                    showAlert(response.message, 'danger');
                }
            },
            error: function () {
                console.error('Error updating product');
                showAlert('Lỗi hệ thống, thử lại sau!', 'danger');
            }
        });
    });

        
    
});

function openEditProductModal(product) {
    document.getElementById('editProductId').value = product.productID;
    document.getElementById('editProductName').value = product.productName;
    document.getElementById('editTitle').value = product.title;
    document.getElementById('editDescription').value = product.description;
    document.getElementById('editPrice').value = product.price;
    document.getElementById('editStockQuantity').value = product.stockQuantity;

    const modal = new bootstrap.Modal(document.getElementById('editProductModal'));
    modal.show();
}

function uploadImages(input) {
    const files = input.files;
    const productID = input.getAttribute('data-product-id');

    console.log("Selected files:", files);
    console.log("Product ID:", productID);

    if (!files.length) return;

    const formData = new FormData();
    formData.append("productID", productID);
    formData.append("action", "upload");

    for (let i = 0; i < files.length; i++) {
        formData.append("images[]", files[i]);
    }

    fetch(`${baseUrl}/ajax/product.php`, {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        alert("Tải ảnh thành công!");
        console.log(result); // Hoặc xử lý DOM nếu muốn hiển thị ảnh
    })
    .catch(error => {
        alert("Có lỗi khi tải ảnh!");
        console.error(error);
    });
}
