function renderProduct(product) {
    const container = document.getElementById("productContent");
    container.innerHTML = `
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="text-center mb-3">
                    <img id="mainProductImage" src="${product.image}" class="img-fluid product-image border rounded shadow" style="width: 100%; max-width: 400px;">
                </div>
                <div class="d-flex justify-content-center flex-wrap">
                    <img src="${product.image}" class="thumbnail border rounded me-2 shadow-sm active" data-src="${product.image}" onclick="changeImage(this)" style="width: 80px; height: 80px; object-fit: cover;">
                    ${product.galleryImages.map((img, index) => `
                        <img src="${img}" class="thumbnail border rounded me-2 shadow-sm" data-src="${img}" onclick="changeImage(this)" style="width: 80px; height: 80px; object-fit: cover;">
                    `).join('')}
                </div>
            </div>
            <div class="col-lg-6">
                <h1 class="h2 fw-bold">${product.productName}</h1>
                <div class="d-flex align-items-center mb-3">
                    <span class="text-muted me-2">Thương hiệu:</span>
                    <a href="#" class="text-decoration-none fw-medium">${product.brandName}</a>
                </div>
                <div class="price mb-4">${(product.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} đ</div>
                <div class="mb-4">
                    <div class="mb-2">
                        <i class="bi bi-check-circle-fill feature-icon"></i>
                        <span class="ms-2">Hàng chính hãng</span>
                    </div>
                    <div class="mb-2">
                        <i class="bi bi-check-circle-fill feature-icon"></i>
                        <span class="ms-2">Giao hàng hỏa tốc 4 tiếng</span>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="d-flex align-items-center">
                        <button class="btn py-2 px-4" id="add-to-cart" data-productid="${product.productID}">
                            <i class="bi bi-cart-plus me-2"></i>Thêm Vào Giỏ Hàng
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc">Mô tả</button>
            </li>   
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="spec-tab" data-bs-toggle="tab" data-bs-target="#spec">Thông số kỹ thuật</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="guide-tab" data-bs-toggle="tab" data-bs-target="#guide">Hướng dẫn</button>
            </li>
        </ul>
        <div class="tab-content p-4 border border-top-0 rounded-bottom">
            <div class="tab-pane fade show active" id="desc">
                <h4 class="fw-bold mt-3">Đặc điểm nổi bật</h4>
                <div id="product-description" class="mt-3">${product.description}</div>
            </div>
            <div class="tab-pane fade" id="spec">
                <table class="table table-striped mt-3">
                    <tr><td class="fw-medium">Thương hiệu</td><td>${product.brandName}</td></tr>
                    <tr><td class="fw-medium">Độ tuổi phù hợp</td><td>3 tuổi trở lên</td></tr>
                    <tr><td class="fw-medium">Chất liệu</td><td>Nhựa ABS cao cấp</td></tr>
                    <tr><td class="fw-medium">Kích thước sản phẩm</td><td>20 x 10 x 15 cm</td></tr>
                    <tr><td class="fw-medium">Xuất xứ</td><td>Chính hãng</td></tr>
                </table>
            </div>
            <div class="tab-pane fade" id="guide">
                <h5 class="mt-3 fw-bold">Hướng dẫn sử dụng</h5>
                <ol>
                    <li>Tháo sản phẩm khỏi bao bì cẩn thận</li>
                    <li>Hướng dẫn bé cách biến hình từ robot sang khủng long và ngược lại</li>
                    <li>Khuyến khích bé sáng tạo các câu chuyện</li>
                    <li>Vệ sinh bằng khăn mềm, tránh ngâm nước</li>
                </ol>
                <div class="alert alert-warning mt-3">
                    <strong>Lưu ý:</strong>
                    <ul>
                        <li>Không để trẻ dưới 3 tuổi chơi</li>
                        <li>Bảo quản nơi khô ráo</li>
                        <li>Không để sản phẩm gần nguồn nhiệt</li>
                    </ul>
                </div>
            </div>
        </div>
    `;
}

// Thêm class "active" khi ảnh được chọn
function changeImage(el) {
    const main = document.getElementById("mainProductImage");
    const thumbnails = document.querySelectorAll(".thumbnail");

    if (main && el.dataset.src) {
        main.src = el.dataset.src;
        thumbnails.forEach(thumb => thumb.classList.remove("active"));
        el.classList.add("active");
    }
}



function increaseQuantity() {
    const q = document.getElementById("quantity");
    if (q && q.value < 99) q.value++;
}

function decreaseQuantity() {
    const q = document.getElementById("quantity");
    if (q && q.value > 1) q.value--;
}

function addToCart() {
    const q = document.getElementById("quantity").value;
    alert(`Đã thêm ${q} sản phẩm vào giỏ hàng!`);
}



// const product = {
//     name: "Robot Biến Hình Cỡ Lớn Khủng Long Huyền Thoại Tino SUPERWINGS YW760237",
//     brand: "SUPERWINGS",
//     sku: "YW760237",
//     price: 389000,
//     mainImage: "images/main.webp",
//     thumbnails: ["images/04.webp", "images/01.webp", "images/02.webp", "images/03.webp"],
//     features: [
//         "Hàng chính hãng",
//         "Miễn phí giao hàng toàn quốc đơn trên 500k",
//         "Giao hàng hỏa tốc 4 tiếng"
//     ],
//     highlights: [
//         "Chất liệu cao cấp: Được làm từ nhựa ABS an toàn, bền bỉ, không độc hại",
//         "Kích thước lớn: Phù hợp cho bé chơi và trưng bày",
//         "Khả năng biến hình: Dễ dàng chuyển đổi từ robot sang hình dáng khủng long",
//         "Chi tiết sắc nét: Thiết kế tỉ mỉ, màu sắc tươi sáng",
//         "Phát triển kỹ năng: Giúp trẻ phát triển trí tưởng tượng"
//     ],
//     specs: {
//         "Thương hiệu": "SUPERWINGS",
//         "Mã sản phẩm": "YW760237",
//         "Độ tuổi phù hợp": "3 tuổi trở lên",
//         "Chất liệu": "Nhựa ABS cao cấp",
//         "Kích thước sản phẩm": "20 x 10 x 15 cm",
//         "Xuất xứ": "Chính hãng"
//     },
//     guide: [
//         "Tháo sản phẩm khỏi bao bì cẩn thận",
//         "Hướng dẫn bé cách biến hình từ robot sang khủng long và ngược lại",
//         "Khuyến khích bé sáng tạo các câu chuyện",
//         "Vệ sinh bằng khăn mềm, tránh ngâm nước"
//     ],
//     warnings: [
//         "Không để trẻ dưới 3 tuổi chơi",
//         "Bảo quản nơi khô ráo",
//         "Không để sản phẩm gần nguồn nhiệt"
//     ]
// };


$(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    console.log(urlParams.get("page"));
    if (urlParams.get("page") === "product_detail") {
        const productId = urlParams.get("productID");
        if(!productId) {
            alert("Không tìm thấy sản phẩm! dsfhjs");
            //window.location.href = `${baseUrl}/`;
        }
        // Fetch product details from the server using AJAX
        $.ajax({
            url: `${baseUrl}/ajax/product_detail.php`,
            type: 'GET',
            dataType: 'json',
            data: { productID: productId },
            success: function(response) {
                if (response.success) {
                    renderProduct(response.product);
                } else {
                    alert("Không tìm thấy sản phẩm!");
                   // window.location.href = `${baseUrl}./`;
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi AJAX:', error);
                alert("Có lỗi xảy ra khi tải sản phẩm!");
            }
        });
    }
  });

  $(document).ready(function () {
    $(document).on('click', '#add-to-cart', function(e) {
        e.preventDefault();
        e.stopPropagation(); // Ngăn sự kiện nổi lên
    
        const productID = $(this).data('productid');
    
        $.ajax({
            url: `${baseUrl}/ajax/cart.php`,
            method: "POST",
            data: {
                action: "add",
                productID: productID
            },
            success: function (res) {
                if (res.error) {
                    toastr.error(res.message);
                    return;
                }
                alert("Thêm vào giỏ hàng thành công!");
            },
            error: function () {
                toastr.error("Lỗi khi thêm vào giỏ hàng!");
            }
        });
    });
});



