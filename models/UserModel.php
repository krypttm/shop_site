<?php
require 'DB.php';

class UserModel {
    private $name;
    private $email;
    private $pass;
    private $re_pass;

    private $_db = null;

    public function __construct() {
        $this->_db = DB::getInstence();
    }

    public function setData($name, $email, $pass, $re_pass) {
        $this->name = $name;
        $this->email = $email;
        $this->pass = $pass;
        $this->re_pass = $re_pass;
    }

    public function validForm() {
        if(strlen($this->name) < 3)
            return "Имя слишком короткое";
        else if(strlen($this->email) < 3)
            return "Email слишком короткий";
        else if(strlen($this->pass) < 3)
            return "Пароль не менее 3 символов";
        else if($this->pass != $this->re_pass)
            return "Пароли не совпадают";
        else
            return "Верно";
    }

    public function addUser() {
        $sql = 'INSERT INTO users(name, email, pass) VALUES(:name, :email, :pass)';
        $query = $this->_db->prepare($sql);

        $pass = password_hash($this->pass, PASSWORD_DEFAULT);
        $query->execute(['name' => $this->name, 'email' => $this->email, 'pass' => $pass]);

        $this->setAuth($this->email);
    }

    public function getUser() {
        $email = $_COOKIE['login'];
        $result = $this->_db->query("SELECT * FROM `users` WHERE `email` = '$email'");
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function logOut() {
        setcookie('login', $this->email, time() - 3600, '/');
        unset($_COOKIE['login']);
        header('Location: /user/auth');
    }

    public function auth($email, $pass) {
        $result = $this->_db->query("SELECT * FROM `users` WHERE `email` = '$email'");
        $user = $result->fetch(PDO::FETCH_ASSOC);

        if($user['email'] == '')
            return 'Пользователя с таким email не существует';
        else if(password_verify($pass, $user['pass']))
            $this->setAuth($email);
        else
            return 'Пароли не совпадают';
    }

    public function setAuth($email) {
        setcookie('login', $email, time() + 3600, '/');
        header('Location: /user/dashboard');
    }

    public function validPicture($image) {
        if(!$image['name'] == '')
            $this->addPicture($this->image);
        else if($image['name'] == '')
            return "Вы не указали файл для загрузки";
        else if($image['size'] > 512000)
            return "Размер фото слишком большой";
        else
            return "Верно";
    }

    public function addPicture() {
        $sql = 'INSERT INTO users(image) VALUES(image)';
        $query = $this->_db->prepare($sql);
        $query->execute(['image' => $this->$image['name']]);
    }

}