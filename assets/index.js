const baseUrl = 'http://localhost/web-project-php/public';

$('#searchForm').on('submit', function (e) {
    e.preventDefault();
  
    const search = $('#searchInput').val().trim();
    console.log("Tìm kiếm: ", search);
    console.log(search);
    const params = new URLSearchParams(); // Bắt đầu mới, xóa hết filter cũ

    params.set('page', 'product');
  
    if (search !== '') {
      params.set('q', search);
    }
  
    const newUrl = `${window.location.pathname}?${params.toString()}`;
    window.location.href = `${window.location.pathname}?${params.toString()}`;
    history.pushState(null, '', newUrl);
    fetchProducts(params.toString());
  });