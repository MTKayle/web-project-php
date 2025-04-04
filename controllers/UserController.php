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
        // if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        //     echo json_encode(["suscess" => false, "message" => "Email không hợp lệ"]);
        //     exit();
        // }
        try {
            $registerSuccess = $this->userService->registerUser($name, $email, $password);
            if ($registerSuccess) {
                echo json_encode(["success" => true, "message" => "Registration successful"]);
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

    public function login($email, $password, $remember){
        if(empty($email) || empty($password)){
            echo json_encode(["success" => false, "message" => "Tất cả các trường là bắt buộc"]);
            exit();
        }
        echo $remember;
        try {
            $user = $this->userService->login($email, $password);
            if ($user) {
                session_start();
                $_SESSION['userID'] = $user->userID;
                $_SESSION['userName'] = $user->name;
                $_SESSION['email'] = $user->email;

                if($remember){
                    setcookie('email', $user->email, time() + 3600 * 24 * 7);
                    setcookie('password', $user->password, time() + 3600 * 24 * 7);
                } else {
                    // Xóa cookies nếu không chọn "Nhớ mật khẩu"
                    setcookie('email', '', time() - 3600, '/');
                    setcookie('password', '', time() - 3600, '/');
                }

                $response = [
                    'success' => true,
                    'user' => [
                        'id' => $user->userID,
                        'name' => $user->name,
                        'email' => $user->email
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

    
}