$(document).ready(function() {
// Get elements
const filterToggle = document.getElementById('filterToggle');
const filterSection = document.getElementById('filterSection');
const closeFilter = document.getElementById('closeFilter');
const filterBackdrop = document.getElementById('filterBackdrop');
const urlParams = new URLSearchParams(window.location.search);

const selectedAges = urlParams.get('tuoi'); // dạng: "1,3,5"
if (selectedAges) {
  const selectedAgeArray = selectedAges.split(',');
  selectedAgeArray.forEach(value => {
    $(`.age-checkbox[value="${value}"]`).prop('checked', true);
  });
}

// Show filter on mobile when toggle button is clicked
filterToggle.addEventListener('click', function() {
  filterSection.classList.add('show');
  filterBackdrop.classList.add('show');
  document.body.style.overflow = 'hidden'; // Prevent scrolling when filter is open
});

// Hide filter when close button is clicked
closeFilter.addEventListener('click', function() {
  filterSection.classList.remove('show');
  filterBackdrop.classList.remove('show');
  document.body.style.overflow = ''; // Restore scrolling
});

// Hide filter when backdrop is clicked
filterBackdrop.addEventListener('click', function() {
  filterSection.classList.remove('show');
  filterBackdrop.classList.remove('show');
  document.body.style.overflow = ''; // Restore scrolling
});

// Close filter on window resize if screen becomes larger
window.addEventListener('resize', function() {
  if (window.innerWidth >= 768) {
    filterSection.classList.remove('show');
    filterBackdrop.classList.remove('show');
    document.body.style.overflow = '';
  }
});



function getSelectedValues(className) {
  return $('.' + className + ':checked').map(function () {
      return this.value;
  }).get(); // trả về array
}

function getFilters(selectedCategory = null) {
  console.log("Lấy filter");
  const ages = getSelectedValues('age-checkbox');
  const prices = getSelectedValues('price-checkbox');
  const brands = getSelectedValues('brand-checkbox');
  // const category = document.getElementById('category').value; // Lấy giá trị của select category
  // const search = document.getElementById('searchInput').value.trim();   

  const params = new URLSearchParams(window.location.search);

  if (ages.length > 0) {
    params.set('tuoi', ages.join(','));
  } else {
      params.delete('tuoi');
  }
  

  if (brands.length > 0) {
      params.set('thuonghieu', brands.join(','));
  } else {
      params.delete('thuonghieu');
  }

  if (prices.length > 0) {
      params.set('gia', prices.join(','));
  } else {
      params.delete('gia');
  }

  // if (search !== '') {
  //   params.set('q', search);
  // } else {
  //   params.delete('q');
  // }

  // if (category !== '') {
  //   params.set('danhmuc', category);
  // }

  if (selectedCategory) {
    params.set('danhmuc', selectedCategory);
    params.set('page', 'product');
  }


  const newUrl = `${window.location.pathname}?${params.toString()}`;
  console.log(newUrl);
  history.pushState(null, '', newUrl);
  fetchProducts(params.toString());
}




function fetchProducts(queryString) {
  console.log("Lấy sản phẩm");
  console.log(`${baseUrl}/ajax/product.php?${queryString}`);
  const params = new URLSearchParams(queryString);
  const page = params.get('pageNum') || 1; // Lấy trang hiện tại từ query string, mặc định là 1
  $.ajax({
      url: `${baseUrl}/ajax/product.php?${queryString}`,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        if(response.success){
          console.log(response);
          renderProducts(response.products); // tự định nghĩa hàm này để hiển thị HTML
          $('#pagination').html(renderPagination(response.products[0].description, page));
        }else{
          $('#product-container').html(`
          <div class="d-flex justify-content-center align-items-center" style="min-height: 300px;">
            <h5 class="text-muted">Không có sản phẩm nào phù hợp</h5>
          </div>
          `);
        }
      },
      error: function(xhr, status, error) {
          console.error('Lỗi AJAX:', error);
      }
  });
}

function renderProducts(products) {


  let html = '<div class="row">'; // Chỉ cần tạo 1 hàng chứa nhiều cột

  products.forEach(product => {
    const price = product.price;
    const originalPrice = product.original_price || price;
    const discountPercent = Math.round((1 - price / originalPrice) * 100);

    html += `
    <div class="col-md-4 mb-4">
    <div class="card h-100 border-0 product-card d-flex flex-column product-card-radius" data-id="${product.productID}">
      <div class="position-absolute badge bg-danger text-white m-2 px-2 py-1">-${discountPercent}%</div>
      
      <div class="product-image">
        <img src="${product.image}" alt="${product.productName}" class="card-img-top">
      </div>
      <div class="card-body d-flex flex-column">
        <div class="text-muted small fw-bold mb-1">${product.brandName || 'Không rõ hãng'}</div>
  
        <!-- Giới hạn tên sản phẩm 2 dòng -->
        <h5 class="card-title product-name h6 mb-2 line-clamp-2">${product.productName}</h5>
  
        <div class="product-price mb-3">
          <span class="text-decoration-line-through text-muted me-2">${formatCurrency(originalPrice)}</span>
          <span class="fw-bold text-danger">${formatCurrency(price)}</span>
        </div>
        
  
        <!-- Đẩy nút xuống cuối card -->
        <div class="mt-auto">
          <a href="#" class="btn btn-primary w-100 btn-add-to-cart" data-productid="${product.productID}">Thêm vào giỏ</a>
        </div>
      </div>
    </div>
  </div>    `;
  });

  html += '</div>'; // Kết thúc row

  $('#product-container').html(html);
}




// Gọi hàm để hiển thị sản phẩm khi trang tải


  // if (urlParams.get('page') === 'product') {
  //   renderProducts(products);
  // }


  if(urlParams.get('page') === 'product') {
    fetchProducts(urlParams.toString());
  }

  $('.age-checkbox, .brand-checkbox, .price-checkbox').on('change', function() {
    console.log("Checkbox changed");
    getFilters();
  });

  $(document).ready(function () {
    $('.category-item').on('click', function () {
      const selectedCategory = $(this).data('category');
      getFilters(selectedCategory); // Gọi lại hàm có truyền category
    });
  });

// xem chi tiết sản phẩm
$(document).on('click', '.product-card', function () {
  const productId = $(this).data('id');
  window.location.href = "?page=product_detail&productID=" + productId;
});

function formatCurrency(amount) {
  return new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0
  }).format(amount);
}

//ham phan trang
function renderPagination(totalPages, currentPage = 1, maxVisiblePages = 7) {
  let html = '';

  // Nút "Trang đầu"
  if (currentPage > 1) {
      html += `<li class="page-item">
                  <a class="page-link" href="#" data-page="1">&laquo;</a>
               </li>`;
  }

  // Tính toán phạm vi trang hiển thị
  let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
  let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

  // Điều chỉnh nếu ở gần đầu hoặc cuối
  if (endPage - startPage + 1 < maxVisiblePages) {
      startPage = Math.max(1, endPage - maxVisiblePages + 1);
  }

  // Nút "..." trước
  if (startPage > 1) {
      html += `<li class="page-item">
                  <a class="page-link disabled" href="#">...</a>
               </li>`;
  }

  // Nút trang trong phạm vi
  for (let i = startPage; i <= endPage; i++) {
      html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                  <a class="page-link" href="#" data-page="${i}">${i}</a>
               </li>`;
  }

  // Nút "..." sau
  if (endPage < totalPages) {
      html += `<li class="page-item">
                  <a class="page-link disabled" href="#">...</a>
               </li>`;
  }

  // Nút "Trang cuối"
  if (currentPage < totalPages) {
      html += `<li class="page-item">
                  <a class="page-link" href="#" data-page="${totalPages}">&raquo;</a>
               </li>`;
  }

  return html;
}



  
  

  
  

});


// Pagination
$(document).on('click', '.page-link', function(e) {
  e.preventDefault();
  const page = $(this).data('page');           
  const params = new URLSearchParams(window.location.search);
  params.set('pageNum', page);
  const newUrl = `${window.location.pathname}?${params.toString()}`;
  fetchProducts(params.toString());
});

