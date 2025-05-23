<?php
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . "/../customerException/EmailAlreadyExistsException.php";
require_once __DIR__ . "/../customerException/InvalidPasswordException.php";
require_once __DIR__ . "/../customerException/EmailNotExistsException.php";
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/CartRepository.php';
require_once __DIR__ . '/../utils/MailHelper.php';
class UserService{
    private UserRepository $userRepository;
    private CartRepository $cartRepository;

    // constructor for UserService
    public function __construct($userRepository, $cartRepository)
    {
        $this->userRepository = $userRepository;
        $this->cartRepository = $cartRepository;
    }

    public function registerUser($name, $email, $password){
        $user = $this->userRepository->getUserByEmail($email);
        // check if email already exists
        if($user){
            throw new EmailAlreadyExistsException("Email đã tồn tại.");
        }
        // password must be at least 6 characters
        if (strlen($password) < 6) {
            throw new InvalidPasswordException("Mật khẩu phải có ít nhất 6 ký tự.");
        }
        // hash password
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        // register user from UserRepository
        return $this->userRepository->registerUser($name, $email, $passwordHash);
    }

    public function login($email, $password){
        $user = $this->userRepository->getUserByEmail($email);
        // check if email exists
        if(!$user){
            throw new EmailNotExistsException ("Email không tồn tại.");
        }
        // check if password is correct
        if(!password_verify($password, $user['password'])){
            throw new InvalidPasswordException("Mật khẩu không chính xác.");
        }

        $cartID = $this->cartRepository->getCartIDByCustomerID($user['userID']);

        $user = new User(
            $user['userID'],
            $user['email'],
            $user['password'],
            $user['userName'],
            $cartID,
            $user['userRoleID']
        );
        
        return $user;
    }

    public function logout(){
        session_start();
        // unset all session variables
        unset($_SESSION['userID']);
        unset($_SESSION['userName']);
        unset($_SESSION['email']);
        unset($_SESSION['cartID']);
        unset($_SESSION['role']);
        // destroy the session
        session_destroy();

        return true;
    }

    public function getUserByEmail($email){
        $user = $this->userRepository->getUserByEmail($email);

        if(!$user){
            throw new EmailNotExistsException ("Email không tồn tại.");
        }

        return new User(
            $user['userID'],
            $user['email'],
            $user['password'],
            $user['userName'],
            null,
            $user['userRoleID']
        );
    }

    public function sendOTP($email) {
        try {
            $user = $this->userRepository->getUserByEmail($email);
            
            // Check if email exists
            if (!$user) {
                throw new EmailNotExistsException("Email không tồn tại.");
            }
            
            // Generate OTP
            $otp = rand(100000, 999999);
            
            // Start session if not already started
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            // Clear old session data
            $sessionsToUnset = ['reset_otp', 'otp_expire', 'reset_email'];
            foreach ($sessionsToUnset as $sessionKey) {
                if (isset($_SESSION[$sessionKey])) {
                    unset($_SESSION[$sessionKey]);
                }
            }
            
            // Set new session data
            $_SESSION['reset_otp'] = $otp;
            $_SESSION['reset_email'] = $email;
            $_SESSION['otp_expire'] = time() + 300; // 5 minutes
            
            // Verify session data was set correctly
            error_log("OTP set in session: " . $_SESSION['reset_otp']);
            error_log("Email set in session: " . $_SESSION['reset_email']);
            
            // Prepare email content
            $subject = "Mã xác thực đặt lại mật khẩu Hoope";
            $body = "Mã OTP của bạn là: <b>$otp</b>. Mã này sẽ hết hạn sau 5 phút. <br> Vui lòng không chia sẻ mã này với bất kỳ ai.";
            
            // Check if MailHelper class exists
            if (!class_exists('MailHelper')) {
                throw new Exception("MailHelper class không tồn tại");
            }
            
            // Check if sendMail method exists
            if (!method_exists('MailHelper', 'sendMail')) {
                throw new Exception("MailHelper::sendMail method không tồn tại");
            }
            
            // Send email and get result
            $mailResult = MailHelper::sendMail($email, $subject, $body);
            
            // Log the result for debugging
            error_log("Mail send result: " . ($mailResult ? 'true' : 'false'));
            
            if (!$mailResult) {
                throw new Exception("Không thể gửi email OTP");
            }
            
            return [
                'success' => true,
                'message' => 'OTP đã được gửi thành công',
                'otp' => $otp // Remove this in production for security
            ];
            
        } catch (EmailNotExistsException $e) {
            error_log("Email not exists: " . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
            
        } catch (Exception $e) {
            error_log("SendOTP Error: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi gửi OTP: ' . $e->getMessage()
            ];
        }
    }
    // Sử dụng hàm
// $result = generateAndSendOTP($email);
// if (!$result['success']) {
//     echo "Lỗi: " . $result['message'];

    public function verifyOTP($inputOtp) {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (
            isset($_SESSION['reset_otp']) &&
            $_SESSION['reset_otp'] == $inputOtp &&
            time() <= $_SESSION['otp_expire']
        ) {
            return true;
        }
        return false;
    }

    public function resetPassword($newPassword) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['reset_email'])) return false;

        $email = $_SESSION['reset_email'];
        $hashed = password_hash($newPassword, PASSWORD_BCRYPT);
        $result = $this->userRepository->updatePassword($email, $hashed);

        unset($_SESSION['reset_email'], $_SESSION['reset_otp'], $_SESSION['otp_expire']);
        return $result;
    }

}
?>