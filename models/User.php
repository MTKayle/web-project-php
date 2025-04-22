<?php
class User{
    public $userID;
    public $email;
    public $password;
    public $name;

    public $cartID;

    public function __construct($userID, $email, $password, $name, $cartID)
    {
        $this->userID = $userID;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->cartID = $cartID;
    }
}
?>