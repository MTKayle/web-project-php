function renderProduct(product) {
    const container = document.getElementById("productContent");
    container.innerHTML = `
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="text-center mb-3">
                    <img id="mainProductImage" src="${product.mainImage}" class="img-fluid product-image border rounded">
                </div>
                <div class="d-flex justify-content-center">
                    ${product.thumbnails.map((img, index) => `
                        <img src="${img}" class="thumbnail border rounded me-2" data-src="${img}" onclick="changeImage(this)">
                    `).join('')}
                </div>
            </div>
            <div class="col-lg-6">
                <h1 class="h2 fw-bold">${product.name}</h1>
                <div class="d-flex align-items-center mb-3">
                    <span class="text-muted me-2">Thương hiệu:</span>
                    <a href="#" class="text-decoration-none fw-medium">${product.brand}</a>
                    <span class="ms-3 text-muted">SKU: ${product.sku}</span>
                </div>
                <div class="price mb-4">${product.price.toLocaleString('vi-VN')} đ</div>
                <div class="mb-4">
                    ${product.features.map(f => `
                        <div class="mb-2">
                            <i class="bi bi-check-circle-fill feature-icon"></i>
                            <span class="ms-2">${f}</span>
                        </div>
                    `).join('')}
                </div>
                <div class="mb-4">
                    <label for="quantity" class="form-label fw-medium mb-2">Số lượng</label>
                    <div class="d-flex align-items-center">
                        <div class="input-group me-3" style="width: 150px;">
                            <button class="btn " type="button" onclick="decreaseQuantity()">-</button>
                            <input type="number" class="form-control text-center" id="quantity" value="1" min="1" max="99">
                            <button class="btn " type="button" onclick="increaseQuantity()">+</button>
                        </div>
                        <button class="btn py-2 px-4" onclick="addToCart()">
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
                <ul>
                    ${product.highlights.map(h => `<li>${h}</li>`).join('')}
                </ul>
            </div>
            <div class="tab-pane fade" id="spec">
                <table class="table table-striped mt-3">
                    ${Object.entries(product.specs).map(([k,v]) => `
                        <tr><td class="fw-medium">${k}</td><td>${v}</td></tr>
                    `).join('')}
                </table>
            </div>
            <div class="tab-pane fade" id="guide">
                <h5 class="mt-3 fw-bold">Hướng dẫn sử dụng</h5>
                <ol>${product.guide.map(g => `<li>${g}</li>`).join('')}</ol>
                <div class="alert alert-warning mt-3">
                    <strong>Lưu ý:</strong>
                    <ul>${product.warnings.map(w => `<li>${w}</li>`).join('')}</ul>
                </div>
            </div>
        </div>
    `;
}

function changeImage(el) {
    const main = document.getElementById("mainProductImage");
    if (main && el.dataset.src) main.src = el.dataset.src;
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

document.addEventListener("DOMContentLoaded", () => {
    renderProduct(product);
});

const product = {
    name: "Robot Biến Hình Cỡ Lớn Khủng Long Huyền Thoại Tino SUPERWINGS YW760237",
    brand: "SUPERWINGS",
    sku: "YW760237",
    price: 389000,
    mainImage: "images/main.webp",
    thumbnails: ["images/04.webp", "images/01.webp", "images/02.webp", "images/03.webp"],
    features: [
        "Hàng chính hãng",
        "Miễn phí giao hàng toàn quốc đơn trên 500k",
        "Giao hàng hỏa tốc 4 tiếng"
    ],
    highlights: [
        "Chất liệu cao cấp: Được làm từ nhựa ABS an toàn, bền bỉ, không độc hại",
        "Kích thước lớn: Phù hợp cho bé chơi và trưng bày",
        "Khả năng biến hình: Dễ dàng chuyển đổi từ robot sang hình dáng khủng long",
        "Chi tiết sắc nét: Thiết kế tỉ mỉ, màu sắc tươi sáng",
        "Phát triển kỹ năng: Giúp trẻ phát triển trí tưởng tượng"
    ],
    specs: {
        "Thương hiệu": "SUPERWINGS",
        "Mã sản phẩm": "YW760237",
        "Độ tuổi phù hợp": "3 tuổi trở lên",
        "Chất liệu": "Nhựa ABS cao cấp",
        "Kích thước sản phẩm": "20 x 10 x 15 cm",
        "Xuất xứ": "Chính hãng"
    },
    guide: [
        "Tháo sản phẩm khỏi bao bì cẩn thận",
        "Hướng dẫn bé cách biến hình từ robot sang khủng long và ngược lại",
        "Khuyến khích bé sáng tạo các câu chuyện",
        "Vệ sinh bằng khăn mềm, tránh ngâm nước"
    ],
    warnings: [
        "Không để trẻ dưới 3 tuổi chơi",
        "Bảo quản nơi khô ráo",
        "Không để sản phẩm gần nguồn nhiệt"
    ]
};