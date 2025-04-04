<?php
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . "/../customerException/EmailAlreadyExistsException.php";
require_once __DIR__ . "/../customerException/InvalidPasswordException.php";
require_once __DIR__ . "/../customerException/EmailNotExistsException.php";
require_once __DIR__ . '/../models/User.php';
class UserService{
    private UserRepository $userRepository;

    // constructor for UserService
    public function __construct($userRepository)
    {
        $this->userRepository = $userRepository;
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
        if(!password_verify($password, $user->password)){
            throw new InvalidPasswordException("Mật khẩu không chính xác.");
        }
        
        return $user;
    }

    public function logout(){
        session_start();
        // unset all session variables
        unset($_SESSION['userID']);
        unset($_SESSION['userName']);
        unset($_SESSION['email']);
        // destroy the session
        session_destroy();

        return true;
    }

}
?>