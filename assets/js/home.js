document.addEventListener('DOMContentLoaded', function() {
    // Initialize all carousels with Bootstrap
    const carousels = document.querySelectorAll('.carousel');
    carousels.forEach(carouselEl => {
        const carousel = new bootstrap.Carousel(carouselEl, {
            interval: 5000,
            pause: 'hover'
        });
    });
});

$(document).ready(function() {
    $.ajax({
        url: `${baseUrl}/ajax/dashboard.php`,
        type: 'GET',
        data: {action: 'getTop5Product'},
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                console.log("dashboard");
                //nhấn nút "Bài viết của tôi" để làm mới danh sách
                renderProductList(response.response);
            }
        },
        error: function () {
            alert("Có lỗi xảy ra khi xóa bài viết.");
        }
    
    });
});

$(document).ready(function() {
    $.ajax({
        url: `${baseUrl}/ajax/dashboard.php`,
        type: 'GET',
        data: {action: 'getProductNew'},
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                console.log("dashboard");
                //nhấn nút "Bài viết của tôi" để làm mới danh sách
                renderProductListNew(response.response);
            }
        },
        error: function () {
            alert("Có lỗi xảy ra khi xóa bài viết.");
        }
    
    });
});

$(document).ready(function() {
    $.ajax({
        url: `${baseUrl}/ajax/news.php`,
        type: 'POST',
        data: {action: 'get3LatestNews'},
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                console.log("news");
                //nhấn nút "Bài viết của tôi" để làm mới danh sách
                renderBlogList(response.response);  
                
            }
        },
        error: function () {
            alert("Có lỗi xảy ra khi xóa bài viết.");
        }
    
    });
});

$(document).on('click', '.read-more', function() {
    const newsId = $(this).data('news-id');
    console.log("News ID:", newsId);
    window.location.href = `?page=news-detail&articleID=${newsId}`;
});

//ham dinh dang ngay thang
function formatDateToVietnamese(dateString) {
    const date = new Date(dateString);
    return date.toLocaleString('vi-VN', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
    }).replace(',', '');
}

function renderBlogList(blogs) {
    const container = document.getElementById("blogList");
    container.innerHTML = ""; // Xóa nội dung cũ nếu có

    blogs.slice(0, 3).forEach(blog => {
        const html = `
            <div class="blog-card">
                <div class="blog-image">
                    <img src="${blog.image}" alt="${blog.title}">
                </div>
                <div class="blog-content">
                    <div class="blog-date">${formatDateToVietnamese(blog.createAt)}</div>
                    <h3 class="blog-title">${blog.title}</h3>
                    <p class="blog-excerpt">${blog.description}</p>
                    <button data-news-id="${blog.articleID}" class="btn btn-outline-primary btn-sm mt-2 read-more">
    Đọc tiếp <i class="fa fa-angle-right"></i>
</button>

                </div>
            </div>
        `;
        container.insertAdjacentHTML("beforeend", html);
    });
}


function renderProductList(products) {
    const container = document.getElementById("productSell");
    container.innerHTML = ""; // Xóa nội dung cũ nếu có

    const maxProducts = Math.min(products.length, 4); // Giới hạn tối đa 4 sản phẩm

    for (let i = 0; i < maxProducts; i++) {
        const product = products[i];

        const discountHTML = product.discount
            ? `<div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-${product.discount}%</div>`
            : (product.isNew
                ? `<div class="position-absolute badge bg-success text-white m-2 px-2 py-1">Mới</div>`
                : "");

        const priceHTML = product.oldPrice
            ? `<span class="text-decoration-line-through text-muted me-2">${formatCurrency(product.price + 100000)}</span>
               <span class="fw-bold text-danger">${formatCurrency(product.price)}</span>`
            : `<span class="fw-bold">${formatCurrency(product.price)}</span>`;

        const html = `
            <div class="col">
                <div class="card product-card h-100 border-0 position-relative">
                    ${discountHTML}
                    <div class="product-image position-relative">
                        <img src="${product.image}" alt="${product.productName}" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">${product.brandName}</div>
                        <h5 class="card-title product-name h6 mb-2">${product.productName}</h5>
                        <div class="product-price mb-3">
                            ${priceHTML}
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
        `;

        container.insertAdjacentHTML("beforeend", html);
    }
}

function renderProductListNew(products) {
    const container = document.getElementById("productNew");
    container.innerHTML = ""; // Xóa nội dung cũ nếu có

    const maxProducts = Math.min(products.length, 4); // Giới hạn tối đa 4 sản phẩm

    for (let i = 0; i < maxProducts; i++) {
        const product = products[i];

        const discountHTML = product.discount
            ? `<div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-${product.discount}%</div>`
            : (product.isNew
                ? `<div class="position-absolute badge bg-success text-white m-2 px-2 py-1">Mới</div>`
                : "");

        const priceHTML = product.oldPrice
            ? `<span class="text-decoration-line-through text-muted me-2">${formatCurrency(product.price + 100000)}</span>
               <span class="fw-bold text-danger">${formatCurrency(product.price)}</span>`
            : `<span class="fw-bold">${formatCurrency(product.price)}</span>`;

        const html = `
            <div class="col">
                <div class="card product-card h-100 border-0 position-relative">
                    ${discountHTML}
                    <div class="product-image position-relative">
                        <img src="${product.image}" alt="${product.productName}" class="card-img-top">
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small fw-bold mb-1">${product.brandName}</div>
                        <h5 class="card-title product-name h6 mb-2">${product.productName}</h5>
                        <div class="product-price mb-3">
                            ${priceHTML}
                        </div>
                        <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
        `;

        container.insertAdjacentHTML("beforeend", html);
    }
}


function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', {
      style: 'currency',
      currency: 'VND',
      minimumFractionDigits: 0,
      maximumFractionDigits: 0
    }).format(amount);
  }
