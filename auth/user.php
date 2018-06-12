<?php

namespace Auth;
use Polinaframework\Core\DB\DB;
use Polinaframework\Core\Tables\UserTable;

class User {
    public  $login = false;
    private $username;
    private $password;

    public function newUser($username, $password) {
        $this->username = $username;
        $this->password = $password;
        $this->checkUser();
    }

    private function checkUser() {
        $query = "select * from " . UserTable::getTableName() . " where username='$this->username'";
        $result = DB::getInstance()->query($query);
        if ($result->getCount() > 0) {
            $user = $result->fetch();
            if ($user['password'] === md5($this->password)) {
                $this->setSession();
                $this->setCookie();
                $this->login = true;
            } else {
                echo "Incorrect password <br>";
            }
        } else {
            echo "Incorrect login <br>";
        }
    }

    private  function getSession() {
        return $_SESSION['login'];
    }

    private function setSession() {
        $_SESSION['login'] = $this->username;
    }

    private  function getCookie() {
        return $_COOKIE['login'];
    }

    private function setCookie() {
        setcookie('login', $this->username, time()+60*60*24);
    }

    public function login() {
        if (isset($_SESSION['login'])) {
            $user = $this->getSession();
            setcookie('login', $user, time()+60*60*24);
            $this->login = true;
        } elseif (isset($_COOKIE['login'])) {
            $user = $this->getCookie();
            setcookie('login', $user, time()+60*60*24);
            $_SESSION['login'] = $user;
            $this->login = true;
        }
    }

    public function logout() {
        unset($_SESSION['login']);
        setcookie('login', '', time()-60);
        $this->login = false;
    }
}