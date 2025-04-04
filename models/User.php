<?php
class User{
    public $userID;
    public $email;
    public $password;
    public $name;

    public function __construct($userID, $email, $password, $name)
    {
        $this->userID = $userID;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
    }
}
?>