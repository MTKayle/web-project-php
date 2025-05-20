$(document).ready(function() {
    // // Initialize CKEditor
    CKEDITOR.replace('content', {
        versionCheck: false,
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

    // Xử lý khi submit form
    $('#newsForm').on('submit', function(e) {
        e.preventDefault(); // Ngăn form submit mặc định

        // Lấy dữ liệu từ form
        const title = $('#title').val().trim();
        const content = CKEDITOR.instances.content.getData();
        console.log(content); // Kiểm tra nội dung CKEditor
        console.log(title); // Kiểm tra tiêu đề

        // Kiểm tra dữ liệu
        if (title === '') {
            alert('⚠️ Vui lòng nhập tiêu đề.');
            $('#title').focus();
            return;
        }

        if (content === '') {
            alert('⚠️ Vui lòng nhập nội dung.');
            return;
        }

        // Gửi AJAX nếu hợp lệ
        $.ajax({
            url: `${baseUrl}/ajax/news.php`,
            method: 'POST',
            data: {
                title: title,
                content: content,
                action: 'add'
            },
            success: function(response) {
                if (response.success) {
                    alert('✅ Đăng bài thành công!');
                    // Reset form and CKEditor
                    $('#newsForm')[0].reset();
                    CKEDITOR.instances.content.setData('');
                    // toggle new post section
                    newPostSection.style.display = 'none';
                    // Reload the page or update the news list
                    location.reload();
                }
                
            },
            error: function(xhr) {
                alert('❌ Có lỗi xảy ra: ' + xhr.responseText);
            }
        });
    });


    //tai tin tuc khi trang load
    $.ajax({
        url: `${baseUrl}/ajax/news.php`,
        type: 'GET',
        data:{page: 1},
        dataType: 'json',
        success: function (response) {
            if(response.success){   
                const articles = response.response.articles;
                renderArticles(articles, response.response.author);
                $('#pagination').html(renderPagination(response.response.totalPages, 1));
            }else{
                $('#pagination').html(''); // Xóa phân trang khi không có đơn hàng
            }
            
        },
        error: function (error) {
            console.error('Error fetching overview data:', error);
        }
    })

    let searchQuery = '';
    
    //khi nhan tim kiếm
    $('#btnSearch').on('click', function() {
        searchQuery = $('#searchArticle').val().trim();

        $.ajax({
            url: `${baseUrl}/ajax/news.php`,
            type: 'GET',
            data: { search: searchQuery, page: 1 },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const articles = response.response.articles;
                    if (articles.length === 0) {
                        console.log('Không tìm thấy bài viết nào.');
                        $('#articleTableBody').html(`
                            <td colspan="5" class="text-center mt-4">Không tìm thấy bài viết nào.</td>
                        `); 
                        $('#pagination').html('');
                    } else {
                        renderArticles(articles, response.response.author);
                        $('#pagination').html(renderPagination(response.response.totalPages, 1));
                    }
                }
            },
            error: function(error) {
                console.error('Error fetching search results:', error);
            }
        });
    });

    // Xử lý sự kiện phân trang
    // Pagination
    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        const page = $(this).data('page');           
            $.ajax({
                url: `${baseUrl}/ajax/news.php`,
                type: 'GET',
                data:{search: searchQuery, page: page},
                dataType: 'json',
                success: function (response) {
                    if(response.success){   
                        const articles = response.response.articles;
                        renderArticles(articles, response.response.author);
                        $('#pagination').html(renderPagination(response.response.totalPages, page));
                    }
                },
                error: function (error) {
                    console.error('Error fetching overview data:', error);
                }
            })
    });

    // Gắn sự kiện xóa
    // document.querySelectorAll(".delete-btn").forEach(btn => {
    //     btn.addEventListener("click", function () {
    //         const id = this.getAttribute("data-article-id");
    //         if (confirm(`Bạn có chắc muốn xóa bài viết #${id}?`)) {
    //             deleteArticle(id);
    //         }
    //     });
    // });
    // Xóa bài viết
    $(document).on('click', '.delete-btn', function() {
        const id = $(this).data('article-id');
        if (confirm(`Bạn có chắc muốn xóa bài viết #${id}?`)) {
            deleteArticle(id);
        }
    });
});

function renderArticles(data, author) {
    const tableBody = document.getElementById("articleTableBody");
    tableBody.innerHTML = ""; // Clear old content

    data.forEach(article => {
        const row = document.createElement("tr");

        row.innerHTML = `
            <td>#${article.articleID}</td>
            <td>${article.title}</td>
            <td>${formatDateToVietnamese(article.createAt)}</td>
            <td>${author}</td>
            <td>
                <button class="btn btn-sm btn-danger delete-btn" data-article-id="${article.articleID}" title="Xóa">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `;

        tableBody.appendChild(row);
    });
}

function deleteArticle(id) {
    $.ajax({
        url: `${baseUrl}/ajax/news.php`,
        type: 'POST',
        data: { action: 'delete', articleID: id },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('✅ Xóa bài viết thành công!');
                // Reload the page or update the news list
                location.reload();
            } else {
                alert('❌ Có lỗi xảy ra khi xóa bài viết.');
            }
        },
        error: function(xhr) {
            alert('❌ Có lỗi xảy ra: ' + xhr.responseText);
        }
    });
}

function formatDateToVietnamese(dateString) {
    const date = new Date(dateString);
    return date.toLocaleString('vi-VN', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
    }).replace(',', '');
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
