<?php
require_once __DIR__ . '/../service/UserService.php';


class UserController{
    private UserService $userService;

    public function __construct($userService)
    {
        $this->userService = $userService;
    }

    public function register($email, $password, $name){
        if(empty($email) || empty($password) || empty($name)){
            echo json_encode(["suscess" => false, "message" => "Tất cả các trường là bắt buộc"]);
            exit();
        }
        
        if (preg_match('/\s/', $password)) {
            echo json_encode(["success" => false, "message" => "Mật khẩu không được chứa khoảng trắng"]);
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["success" => false, "message" => "Email không hợp lệ"]);
            exit();
        }
        try {
            $registerSuccess = $this->userService->registerUser($name, $email, $password);
            if (isset($registerSuccess)) {
                echo json_encode(["success" => true, "userID"=>$registerSuccess, "message" => "Registration successful"]);
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "Registration failed"]);
                exit();
            }
        } catch (UserException $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
        } finally {
            exit();
        }
    }

    public function login($email, $password){
        if(empty($email) || empty($password)){
            echo json_encode(["success" => false, "message" => "Tất cả các trường là bắt buộc"]);
            exit();
        }
        try {
            $user = $this->userService->login($email, $password);
            if ($user) {
                session_start();
                $_SESSION['userID'] = $user->userID;
                $_SESSION['userName'] = $user->name;
                $_SESSION['email'] = $user->email;
                $_SESSION['cartID'] = $user->cartID;
                $_SESSION['role'] = $user->roleID;

                $response = [
                    'success' => true,
                    'user' => [
                        'id' => $user->userID,
                        'name' => $user->name,
                        'email' => $user->email,
                        'cartID'=> $user->cartID,
                        'role' => $user->roleID
                    ]
                ];
                
                echo json_encode( $response );
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "Login failed"]);
                exit();
            }
        } catch (UserException $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
        } finally {
            exit();
        }
    }

    public function logout(){
        $logoutSuccess = $this->userService->logout();



        if (!$logoutSuccess) {
            echo json_encode(["success" => false, "message" => "Logout failed"]);
            exit();
        } else {
            echo json_encode( ["success"=> true,"message"=> ""] );
            exit();
        }
    }

    public function getUserByEmail($email){
        if(empty($email)){
            echo json_encode(["success" => false, "message" => "Tất cả các trường là bắt buộc"]);
            exit();
        }
        try {
            $user = $this->userService->getUserByEmail($email);
            if ($user) {
                echo json_encode(["success" => true, "user" => $user]);
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "User not found"]);
                exit();
            }
        } catch (UserException $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
        } finally {
            exit();
        }
    }

    public function sendOTP($email) {
        try {
            $result = $this->userService->sendOTP($email);
            echo json_encode($result); // Trả luôn mảng JSON đúng format
            exit();
        } catch (UserException $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
            exit();
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
            exit();
        }
    }
    

    public function verifyOTP($otp) {
        
        $verifySuccess = $this->userService->verifyOTP($otp);

        if($verifySuccess){
            echo json_encode(["success" => true, "message" => "Mã OTP hợp lệ"]);
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Mã OTP không hợp lệ hoặc đã hết hạn"]);
            exit();
        }
            
    }

    public function resetPassword($password) {
        if(empty($password)){
            echo json_encode(["success" => false, "message" => "Tất cả các trường là bắt buộc"]);
            exit();
        }
        try {
            $updateSuccess = $this->userService->resetPassword($password);
            if ($updateSuccess) {
                echo json_encode(["success" => true, "message" => "Cập nhật mật khẩu thành công"]);
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "Cập nhật mật khẩu thất bại"]);
                exit();
            }
        } catch (UserException $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
        } finally {
            exit();
        }
    }

    
}