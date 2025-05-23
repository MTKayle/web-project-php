const input = document.getElementById('triggerInput');
const reviewForm = document.getElementById('reviewForm');
const cancelBtn = document.getElementById('cancelButton');
const submitBtn = document.getElementById('submitButton');
const imageInput = document.getElementById('imageInput');
const imagePreview = document.getElementById('imagePreview');

input.addEventListener('focus', () => {
    reviewForm.style.display = 'block';
    input.style.display = 'none';
});

cancelBtn.addEventListener('click', () => {
    reviewForm.style.display = 'none';
    input.style.display = 'block';
    input.value = '';
    imageInput.value = '';
    imagePreview.src = '';
    imagePreview.style.display = 'none';
});


function resetForm() {
    reviewForm.style.display = 'none';
    input.style.display = 'block';
    input.value = '';
    imageInput.value = '';
    imagePreview.src = '';
    imagePreview.style.display = 'none';
    document.getElementById('titleInput').value = '';
    document.getElementById('contentInput').value = '';
}

imageInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Tìm tất cả các nút bình luận
    const commentButtons = document.querySelectorAll('.comment-toggle');

    // Thêm sự kiện click cho từng nút
    commentButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Tìm phần bình luận gần nhất trong cùng bài đăng
            const commentSection = this.closest('.card-body').querySelector('.comment-section');

            // Hiển thị/ẩn phần bình luận
            if (commentSection.style.display === 'none') {
                commentSection.style.display = 'block';
                // Đổi màu nút khi được kích hoạt
                this.classList.add('active');
            } else {
                commentSection.style.display = 'none';
                // Bỏ màu khi không còn kích hoạt
                this.classList.remove('active');
            }
        });
    });
});


// Hàm này sẽ được gọi khi người dùng nhấn nút "Đăng bài viết"
$(document).ready(function () {
    // Đăng bài viết
    $('#postForm').submit(function (e) {
        e.preventDefault();
        
        const title = $('#titleInput').val().trim();
        const content = $('#contentInput').val().trim();
        
        if (!title || !content) {
            alert("Vui lòng nhập đầy đủ tiêu đề và nội dung.");
            return;
        }

        const formData = new FormData(this);
        
        $.ajax({
            url: `${baseUrl}/ajax/post.php`,
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                alert("Đăng bài thành công!");
                location.reload();
            },
            error: function () {
                alert("Có lỗi xảy ra. Vui lòng thử lại.");
            }
        });
    });

    // Hủy bài viết
    $('#cancelButton').on('click', function () {
            $('#titleInput').val('');
            $('#contentInput').val('');
    });
});

// Hàm này được gọi khi trang được tải
$(document).ready(function () {
    // tải  tất cả bài viết
    $.ajax({
        url: `${baseUrl}/ajax/post.php`,
        type: 'GET',
        data: { action: 'getPosts' }, 
        dataType: 'json',
        success: function (response) {
            // Xử lý dữ liệu bài viết ở đây
            $('#posts-container').html(''); // Xóa nội dung hiện tại
            response.posts.forEach(post => {
                const postHtml = renderPost(post);
                $('#posts-container').append(postHtml);
            });
            console.log(response);
            // Bạn có thể hiển thị bài viết trong một phần tử HTML nào đó
        },
        error: function () {
            alert("Có lỗi xảy ra khi tải bài viết.");
        }
    });
});

function renderPost(post) {
    const avatar = post.userImage || 'sale_banner.jpg';
    const authorName = post.userName || 'Người dùng ẩn danh';
    const createdAt = formatTimeAgo(post.createdAt);
    const title = post.title;
    const content = post.content;

    return `
        <div class="card-body" data-post-id="${post.postID}">
            <div class="d-flex align-items-center mb-3">
                <div class="author-avatar me-3">
                    <img src="${avatar}" class="w-100 h-100" alt="avatar">
                </div>
                <div>
                    <div class="fw-bold">${authorName}</div>
                    <small class="text-muted">${createdAt}</small>
                </div>
                <button class="btn btn-sm follow-btn btn-action ms-auto">
                    <i class="fas fa-user-plus me-1"></i> Follow
                </button>
            </div>

            <h5 class="post-title">${title}</h5>

            <p class="card-text text-muted">
                ${content.replace(/\n/g, '<br>')}
            </p>

            <div class="d-flex mt-3">
                <button class="reaction-btn comment-toggle" data-post-id="${post.postID}">
                    <i class="fas fa-comment me-1"></i> Bình luận
                </button>
                <button class="reaction-btn save-post-btn" data-post-id="${post.postID}">
                    <i class="fas fa-bookmark me-1"></i> ${post.isSaved ? 'Đã lưu' : 'Lưu'}
                </button>

            </div>

            <!-- Phần bình luận -->
            <div class="comment-section mt-3" id="comments-${post.postID}" style="display: none;">
                <div class="comment-list"></div>
                <div class="d-flex mb-3">
                    <div class="comment-avatar me-2">
                        <img src="/api/placeholder/36/36" class="w-100 h-100" alt="your avatar">
                    </div>
                    <div class="flex-grow-1">
                        <div class="input-group">
                            <input type="text" class="form-control comment-input" placeholder="Viết bình luận...">
                            <button class="btn btn-sm btn-primary post-comment-btn" data-post-id="${post.postID}">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}


// Hàm này sẽ định dạng thời gian thành "X phút trước", "X giờ trước", "X ngày trước" hoặc ngày cụ thể
function formatTimeAgo(timestamp) {
    const postDate = new Date(timestamp);
    const now = Date.now();
    const diffSeconds = Math.floor((now - postDate.getTime()) / 1000);
    
    if (diffSeconds < 60) return `${diffSeconds} giây trước`;
    if (diffSeconds < 3600) return `${Math.floor(diffSeconds / 60)} phút trước`;
    if (diffSeconds < 86400) return `${Math.floor(diffSeconds / 3600)} giờ trước`;
    if (diffSeconds < 604800) return `${Math.floor(diffSeconds / 86400)} ngày trước`;
    
    return postDate.toLocaleDateString();
}


// Hàm này sẽ được gọi khi người dùng nhấn nút "Bình luận"
$(document).on('click', '.comment-toggle', function () {
    const postId = $(this).data('post-id');
    const $commentSection = $(`#comments-${postId}`);

    // Hiển thị hoặc ẩn phần bình luận
    $commentSection.toggle();

    // Nếu lần đầu mở, tải bình luận từ server
    if ($commentSection.is(':visible') && !$commentSection.data('loaded')) {
        $.ajax({
            url: `${baseUrl}/ajax/post.php`,
            type: 'GET',
            data: { postID: postId , action: 'getComments' },
            dataType: 'json',
            success: function (comments) {
                const $commentList = $commentSection.find('.comment-list');
                $commentList.empty(); // Xóa bình luận cũ

                comments.comments.forEach(comment => {
                    // Tạo phần tử bình luận
                    // Nếu chưa cập nhật tên người dùng, sử dụng tên mặc định
                    const userName = comment.customerName || 'Người dùng ẩn danh';
                    $commentList.append(`
                        <div class="d-flex mb-3">
                            <div class="comment-avatar me-2">
                                <img src="${comment.avatar || '/api/placeholder/36/36'}" class="w-100 h-100" alt="commenter avatar">
                            </div>
                            <div class="comment-bubble">
                                <div class="fw-bold">${userName}</div>
                                <div class="text-muted small">${comment.content}</div>
                                <div class="d-flex mt-1">
                                    <small class="text-muted me-3">${formatTimeAgo(comment.createAt)}</small>
                                </div>
                            </div>
                        </div>
                    `);
                });

                $commentSection.data('loaded', true); // Đánh dấu đã tải bình luận
            },
            error: function () {
                alert("Không thể tải bình luận. Vui lòng thử lại.");
            }
        });
    }
});

// Hàm này sẽ được gọi khi người dùng nhấn nút "Đăng bình luận"
$(document).on('click', '.post-comment-btn', function () {
    const postId = $(this).data('post-id');
    const $input = $(this).closest('.input-group').find('.comment-input');
    const content = $input.val().trim();

    if (content === '') return;

    $.ajax({
        url: `${baseUrl}/ajax/post.php`,
        type: 'POST',
        data: { postID: postId, content: content, action: 'postComment' },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                const comment = response.response;
                const $commentList = $(`#comments-${postId} .comment-list`);
                
                $commentList.append(`
                    <div class="d-flex mb-3">
                        <div class="comment-avatar me-2">
                            <img src="${comment.avatar || '/api/placeholder/36/36'}" class="w-100 h-100" alt="commenter avatar">
                        </div>
                        <div class="comment-bubble">
                            <div class="fw-bold">${comment.customerName || 'Người dùng ẩn danh'}</div>
                            <div class="text-muted small">${comment.content}</div>
                            <div class="d-flex mt-1">
                                <small class="text-muted me-3">${formatTimeAgo(comment.createAt)}</small>
                            </div>
                        </div>
                    </div>
                `);
                $input.val('');
            }
        },
        error: function () {
            alert("Không thể gửi bình luận. Vui lòng thử lại.");
        }
    });
});

// Hàm này sẽ được gọi khi người dùng nhấn nút "Lưu bài viết"
$(document).on('click', '#savePost', function (e) {
    e.preventDefault();
    const postId = $(this).data('post-id');
    const $this = $(this);
    $.ajax({
        url: `${baseUrl}/ajax/post.php`,
        type: 'POST',
        data: { postID: postId, action: 'savePost' },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                $this.toggleClass('active');
                if ($this.hasClass('active')) {
                    $this.html('<i class="fas fa-bookmark me-1"></i> Đã lưu');
                } else {
                    $this.html('<i class="fas fa-bookmark me-1"></i> Lưu');
                }
            }
        },
        error: function () {
            alert("Không thể lưu bài viết. Vui lòng thử lại.");
        }
    });
});

// lưu bài viết và xóa bài viết, nút toggle
$(document).on('click', '.save-post-btn', function () {
    const $button = $(this);
    const postId = $button.data('post-id');
    const isSaved = $button.text().includes('Đã lưu');

    $.ajax({
        url: `${baseUrl}/ajax/post.php`,
        type: 'POST',
        data: {
            postID: postId,
            action: isSaved ? 'unsavePost' : 'savePost'
        },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                // Toggle button text and style
                if (isSaved) {
                    $button.html('<i class="fas fa-bookmark me-1"></i> Lưu');
                } else {
                    $button.html('<i class="fas fa-bookmark me-1"></i> Đã lưu');
                }
            } else {
                alert(response.message || "Không thể thay đổi trạng thái lưu.");
            }
        },
        error: function () {
            alert("Không thể thay đổi trạng thái lưu. Vui lòng thử lại.");
        }
    });
});


// Hàm này sẽ được gọi khi người dùng nhấn nút "Xem bài viết đã lưu"
$(document).on('click', '#savedPost', function (e) {
    e.preventDefault();
    const $this = $(this);
    
    // Bỏ active cho các nút khác (ví dụ các nút có class .nav-btn)
    $('.nav-link').not($this).removeClass('active');

    // Toggle active cho nút này
    $this.addClass('active');
    $.ajax({
        url: `${baseUrl}/ajax/post.php`,
        type: 'GET',
        data: {action: 'getSavedPosts' },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                // Xử lý dữ liệu bài viết đã lưu ở đây
                $('#posts-container').html(''); // Xóa nội dung hiện tại
                response.posts.forEach(post => {
                    const postHtml = renderSavedPost(post);
                    $('#posts-container').append(postHtml);
                });
            } else{
                $('#posts-container').html(''); // Xóa nội dung hiện tại
                $('#posts-container').html(`
                    <div class="no-saved-posts text-center py-5">
                        <h5>Bạn chưa lưu bài viết nào</h5>
                        <p class="justyfy-content-center">Hãy lưu bài viết yêu thích của bạn để xem lại sau.</p>
                    </div>
                `);
            }
        },
        error: function () {
            alert("Có lỗi xảy ra khi tải bài viết đã lưu.");
        }
    });
});


// ham này sẽ được gọi khi người dùng nhấn nút "Bài viết mới"
$(document).on('click', '#forum', function (e) {
    e.preventDefault();
    const $this = $(this);
    
    // Bỏ active cho các nút khác 
    $('.nav-link').not($this).removeClass('active');

    // Toggle active cho nút này
    $this.addClass('active');
     // tải  tất cả bài viết
     $.ajax({
        url: `${baseUrl}/ajax/post.php`,
        type: 'GET',
        data: { action: 'getPosts' }, 
        dataType: 'json',
        success: function (response) {
            // Xử lý dữ liệu bài viết ở đây
            $('#posts-container').html(''); // Xóa nội dung hiện tại
            response.posts.forEach(post => {
                const postHtml = renderPost(post);
                $('#posts-container').append(postHtml);
            });
            console.log(response);
            // Bạn có thể hiển thị bài viết trong một phần tử HTML nào đó
        },
        error: function () {
            alert("Có lỗi xảy ra khi tải bài viết.");
        }
    });
    
});


//hàm rebder bài viết đã lưu
function renderSavedPost(post) {
    const avatar = post.avatar || 'sale_banner.jpg';
    const authorName = post.customerName || 'Người dùng ẩn danh';
    const createdAt = formatTimeAgo(post.createAt);
    const title = post.title;
    const content = post.content;

    return `
        <div class="card-body" data-post-id="${post.postID}">
            <div class="d-flex align-items-center mb-3">
                <div class="author-avatar me-3">
                    <img src="${avatar}" class="w-100 h-100" alt="avatar">
                </div>
                <div>
                    <div class="fw-bold">${authorName}</div>
                    <small class="text-muted">${createdAt}</small>
                </div>
                <button class="btn btn-sm follow-btn btn-action ms-auto">
                    <i class="fas fa-user-plus me-1"></i> Follow
                </button>
            </div>

            <h5 class="post-title">${title}</h5>

            <p class="card-text text-muted">
                ${content.replace(/\n/g, '<br>')}
            </p>

            <div class="d-flex mt-3">
                <button class="reaction-btn comment-toggle" data-post-id="${post.postID}">
                    <i class="fas fa-comment me-1"></i> Bình luận
                </button>
                <button class="reaction-btn unsavePost" data-post-id="${post.postID}">
                    <i class="fas fa-bookmark me-1"></i> Đã lưu 
                </button>

            </div>

            <!-- Phần bình luận -->
            <div class="comment-section mt-3" id="comments-${post.postID}" style="display: none;">
                <div class="comment-list"></div>
                <div class="d-flex mb-3">
                    <div class="comment-avatar me-2">
                        <img src="/api/placeholder/36/36" class="w-100 h-100" alt="your avatar">
                    </div>
                    <div class="flex-grow-1">
                        <div class="input-group">
                            <input type="text" class="form-control comment-input" placeholder="Viết bình luận...">
                            <button class="btn btn-sm btn-primary post-comment-btn" data-post-id="${post.postID}">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// hàm này sẽ được gọi khi người dùng nhấn nút "Bỏ lưu bài viết"
$(document).on('click', '.unsavePost', function () {
    const $button = $(this);
    const postId = $button.data('post-id');
    const isSaved = $button.text().includes('Đã lưu');

    $.ajax({
        url: `${baseUrl}/ajax/post.php`,
        type: 'POST',
        data: {
            postID: postId,
            action: isSaved ? 'unsavePost' : 'savePost'
        },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                // tự động nhấn nút "Xem bài viết đã lưu" để làm mới danh sách
                $('#savedPost').trigger('click');
            }
        },
        error: function () {
            alert("Không thể thay đổi trạng thái lưu. Vui lòng thử lại.");
        }
    });
});

// hàm này sẽ được gọi khi người dùng nhấn nút "Bài viết của tôi"
$(document).on('click', '#myPost', function (e) {
    e.preventDefault();
    const $this = $(this);
    
    // Bỏ active cho các nút khác 
    $('.nav-link').not($this).removeClass('active');

    // Toggle active cho nút này
    $this.addClass('active');
     // tải  tất cả bài viết
     $.ajax({
        url: `${baseUrl}/ajax/post.php`,
        type: 'GET',
        data: { action: 'getMyPosts' }, 
        dataType: 'json',
        success: function (response) {
            if(response.success){
            // Xử lý dữ liệu bài viết ở đây
                $('#posts-container').html(''); // Xóa nội dung hiện tại
                response.posts.forEach(post => {
                    const postHtml = renderMyPost(post);
                    $('#posts-container').append(postHtml);
                });
            }else{
                $('#posts-container').html(''); // Xóa nội dung hiện tại
                $('#posts-container').html(`
                    <div class="no-saved-posts text-center py-5">
                        <h5>Bạn chưa đăng bài viết nào</h5>
                        <p class="justyfy-content-center">Hãy đăng bài viết để tương tác với chúng tôi</p>
                    </div>
                `);
            }
        },
        error: function () {
            alert("Có lỗi xảy ra khi tải bài viết.");
        }
    });
    
});


//hàm render bài viết của tôi
function renderMyPost(post) {
    const avatar = post.userImage || 'sale_banner.jpg';
    const authorName = post.userName || 'Người dùng ẩn danh';
    const createdAt = formatTimeAgo(post.createdAt);
    const title = post.title;
    const content = post.content;

    return `
        <div class="card-body" data-post-id="${post.postID}">
            <div class="d-flex align-items-center mb-3">
                <div class="author-avatar me-3">
                    <img src="${avatar}" class="w-100 h-100" alt="avatar">
                </div>
                <div>
                    <div class="fw-bold">${authorName}</div>
                    <small class="text-muted">${createdAt}</small>
                </div>
                <button class="btn btn-sm follow-btn btn-action ms-auto">
                    <i class="fas fa-user-plus me-1"></i> Follow
                </button>
            </div>

            <h5 class="post-title">${title}</h5>

            <p class="card-text text-muted">
                ${content.replace(/\n/g, '<br>')}
            </p>

            <div class="d-flex mt-3">
                <button class="reaction-btn comment-toggle" data-post-id="${post.postID}">
                    <i class="fas fa-comment me-1"></i> Bình luận
                </button>
                <button class="reaction-btn delete-post-btn" data-post-id="${post.postID}">
                    <i class="fa-solid fa-trash"></i> Xóa bài viết
                </button>

            </div>

            <!-- Phần bình luận -->
            <div class="comment-section mt-3" id="comments-${post.postID}" style="display: none;">
                <div class="comment-list"></div>
                <div class="d-flex mb-3">
                    <div class="comment-avatar me-2">
                        <img src="/api/placeholder/36/36" class="w-100 h-100" alt="your avatar">
                    </div>
                    <div class="flex-grow-1">
                        <div class="input-group">
                            <input type="text" class="form-control comment-input" placeholder="Viết bình luận...">
                            <button class="btn btn-sm btn-primary post-comment-btn" data-post-id="${post.postID}">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// hàm này sẽ được gọi khi người dùng nhấn nút "Xóa bài viết"
$(document).on('click', '.delete-post-btn', function () {
    const postId = $(this).data('post-id');
    if (confirm("Bạn có chắc chắn muốn xóa bài viết này không?")) {
        $.ajax({
            url: `${baseUrl}/ajax/post.php`,
            type: 'POST',
            data: { postID: postId, action: 'deletePost' },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    //nhấn nút "Bài viết của tôi" để làm mới danh sách
                    $('#myPost').trigger('click');
                } else {
                    alert(response.message || "Không thể xóa bài viết.");
                }
            },
            error: function () {
                alert("Có lỗi xảy ra khi xóa bài viết.");
            }
        });
    }
});












  



