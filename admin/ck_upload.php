<?php 
// Cấu hình thư mục upload
$upload_dir_map = [
    'img' => 'uploads/', 
];

// Cấu hình ảnh
$imgset = [
    'maxsize' => 5000, // KB
    'maxwidth' => 4096,
    'maxheight' => 3000,
    'minwidth' => 10,
    'minheight' => 10,
    'type' => ['bmp', 'gif', 'jpg', 'jpeg', 'png', 'webp'], 
];

// Tự động đổi tên file nếu trùng
define('RENAME_F', 1);

// Hàm tạo tên file không trùng
function setFName($p, $fn, $ex, $i){
    if(RENAME_F == 1 && file_exists($p . $fn . $ex)){
        return setFName($p, F_NAME . '_' . ($i + 1), $ex, $i + 1);
    } else {
        return $fn . $ex;
    }
}

$re = '';
$response = [];

if(isset($_FILES['upload']) && strlen($_FILES['upload']['name']) > 1){
    // Lấy tên file gốc (không có extension)
    define('F_NAME', preg_replace('/\.(.+?)$/i', '', basename($_FILES['upload']['name'])));
    
    // Lấy extension
    $sepext = explode('.', strtolower($_FILES['upload']['name']));
    $type = end($sepext);
    
    // Xác định thư mục upload
    $upload_dir = in_array($type, $imgset['type']) ? $upload_dir_map['img'] : '';
    $upload_dir = trim($upload_dir, '/') . '/';
    
    // Kiểm tra loại file
    if(in_array($type, $imgset['type'])){
        // Kiểm tra kích thước ảnh
        list($width, $height) = getimagesize($_FILES['upload']['tmp_name']);
        
        if($width > $imgset['maxwidth'] || $height > $imgset['maxheight']){
            $re .= " Kích thước ảnh quá lớn (tối đa: {$imgset['maxwidth']}x{$imgset['maxheight']}).";
        }
        if($width < $imgset['minwidth'] || $height < $imgset['minheight']){
            $re .= " Kích thước ảnh quá nhỏ (tối thiểu: {$imgset['minwidth']}x{$imgset['minheight']}).";
        }
        if($_FILES['upload']['size'] > $imgset['maxsize'] * 1000){
            $re .= " Dung lượng file vượt quá giới hạn ({$imgset['maxsize']}KB).";
        }
    } else {
        $re .= 'Định dạng file không được hỗ trợ. Chỉ chấp nhận: ' . implode(', ', $imgset['type']);
    }
    
    // Tạo thư mục nếu chưa tồn tại
    $server_upload_path = $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/' . $upload_dir;
    if (!file_exists($server_upload_path)) {
        mkdir($server_upload_path, 0777, true);
    }
    
    // Tạo tên file không trùng
    $f_name = setFName($server_upload_path, F_NAME, ".$type", 0);
    $uploadpath = $server_upload_path . $f_name;
    
    // Đường dẫn URL để trả về cho CKEditor
    $site = rtrim((isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']), '/') . '/';
    $url = $site . $upload_dir . $f_name;
    
    // Xử lý upload
    if($re == ''){
        if(move_uploaded_file($_FILES['upload']['tmp_name'], $uploadpath)){
            // Kiểm tra xem là CKEditor 4 hay 5
            if(isset($_GET['CKEditorFuncNum'])){
                // CKEditor 4 - trả về JavaScript callback
                $funcNum = $_GET['CKEditorFuncNum'];
                echo "<script type='text/javascript'>
                    window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', 'Upload thành công!');
                </script>";
                exit;
            } else {
                // CKEditor 5 - trả về JSON
                $response = [
                    "uploaded" => 1,
                    "fileName" => $f_name,
                    'url' => $url
                ];
            }
        } else {
            $error_message = 'Không thể upload file!';
            if(isset($_GET['CKEditorFuncNum'])){
                // CKEditor 4
                $funcNum = $_GET['CKEditorFuncNum'];
                echo "<script type='text/javascript'>
                    window.parent.CKEDITOR.tools.callFunction($funcNum, '', '$error_message');
                </script>";
                exit;
            } else {
                // CKEditor 5
                $response = [
                    'error' => [
                        'message' => $error_message
                    ]
                ];
            }
        }
    } else {
        // Có lỗi validation
        $error_message = 'Lỗi: ' . trim($re);
        if(isset($_GET['CKEditorFuncNum'])){
            // CKEditor 4
            $funcNum = $_GET['CKEditorFuncNum'];
            echo "<script type='text/javascript'>
                window.parent.CKEDITOR.tools.callFunction($funcNum, '', '$error_message');
            </script>";
            exit;
        } else {
            // CKEditor 5
            $response = [
                'error' => [
                    'message' => $error_message
                ]
            ];
        }
    }
} else {
    // Không có file upload
    $error_message = 'Không có file được chọn!';
    if(isset($_GET['CKEditorFuncNum'])){
        // CKEditor 4
        $funcNum = $_GET['CKEditorFuncNum'];
        echo "<script type='text/javascript'>
            window.parent.CKEDITOR.tools.callFunction($funcNum, '', '$error_message');
        </script>";
        exit;
    } else {
        // CKEditor 5
        $response = [
            'error' => [
                'message' => $error_message
            ]
        ];
    }
}

// Trả về JSON cho CKEditor 5
header('Content-Type: application/json');
echo json_encode($response);
?>