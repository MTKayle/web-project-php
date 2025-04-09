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
submitBtn.addEventListener('click', (e) => {
    e.preventDefault(); // chặn gửi form thật

    // Hiện thông báo (có thể dùng alert hoặc toast tuỳ bạn)
    alert("🎉 Bài viết đã được đăng thành công!");

    // Reset form và hiển thị lại input
    resetForm();
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