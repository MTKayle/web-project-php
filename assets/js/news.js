function renderNewsList(newsArray) {
    const container = document.getElementById("newsList");
    container.innerHTML = ""; // Xóa nội dung cũ nếu có

    newsArray.forEach(news => {
        const html = `
            <div class="news-item">
                <div class="news-image">
                    <img src="${news.image}" alt="${news.title}">
                </div>
                <div class="news-content">
                    <h2 class="news-title">${news.title}</h2>
                    <div class="news-meta">
                        <span class="news-date">${news.createAt}</span>
                    </div>
                    <p class="news-excerpt">${news.description}</p>
                    <div class="news-more-container">
                        <button class="news-more" data-news-id="${news.articleID} id="detail"">Xem thêm</button>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    });
}

// Gọi hàm renderNewsList
$(document).ready(function() {
    //ajax call to fetch news data
    $.ajax({
        url: `${baseUrl}/ajax/news.php`,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Check if response is success
            console.log(response);
            if (response.success) {
                renderNewsList(response.response.articles);
                $('#pagination').html(renderPagination(response.response.totalPages));
            } else {
                console.error("Failed to fetch news data.");
            }
        },
        error: function() {
            console.error("Error fetching news data.");
        }
    });

    // Handle "Xem thêm" button click
    $(document).on('click', '.news-more', function() {
        const newsId = $(this).data('news-id');
        console.log("News ID:", newsId);
        window.location.href = `?page=news-detail&articleID=${newsId}`;
    });


    // Pagination
    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        const page = $(this).data('page');           
            $.ajax({
                url: `${baseUrl}/ajax/news.php`,
                type: 'GET',
                data:{page: page},
                dataType: 'json',
                success: function (response) {
                    if(response.success){   
                        const articles = response.response.articles;
                        renderNewsList(articles);
                        $('#pagination').html(renderPagination(response.response.totalPages, page));
                    }
                },
                error: function (error) {
                    console.error('Error fetching overview data:', error);
                }
            })
    });
});

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

