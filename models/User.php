<?php
class User{
    public $userID;
    public $email;
    public $password;
    public $name;
    public $roleID;
    public $cartID;

    public function __construct($userID, $email, $password, $name, $cartID, $roleID)
    {
        $this->userID = $userID;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->roleID = $roleID;
        $this->cartID = $cartID;
    }
}
?>