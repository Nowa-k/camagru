<?php
require_once 'app/models/User.php';

class UserController {
    public function index() {
        $users = User::getAll();
        require 'app/views/user/index.php';
    }

    public function view($id) {
        $user = User::getById($id);
        require 'app/views/user/view.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['username'])
                && isset($_POST['pwd'])
                && isset($_POST['mail']))
            {
                $username = $_POST['username'];
                $pwd = $_POST['pwd'];
                $mail = $_POST['mail'];
                User::add($username, $mail, $pwd);
                header('Location: index.php?controller=user&action=index');
            } else {
                // Send error
            }
        } else {
            require 'app/views/user/add.php';
        }
    }

    public function myMailIsValide() {
        if (isset($_SESSION['valide']) && $_SESSION['valide'] == '0' ) {
            header("Location: index.php?controller=user&action=verify");
            exit; 
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['username'])
                && isset($_POST['pwd']))
            {
                User::login($_POST['username'], $_POST['pwd']);
                header('Location: index.php?controller=user&action=index');
            }
        } else {
            require 'app/views/user/login.php';
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php');
    }

    public function setting() {
        if (!isset($_SESSION['id'])) {
            require 'app/views/user/index.php';
            return ;
        }
        // self::myMailIsValide();
        $id = $_SESSION['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['username'])
                && isset($_POST['mail'])
                && isset($_POST['pwd'])
                && isset($_POST['oldpwd'])) {
                $username = $_POST['username'];
                $mail = $_POST['mail'];
                $pwd = $_POST['pwd'];
                $oldpwd = $_POST['oldpwd'];
                $mess = User::setting($id, $username, $mail, $pwd, $oldpwd);
            } else {
                User::notification();
            }
        }
        $user = User::getById($id);
        require 'app/views/user/setting.php';
    }

    public function verify() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['code']) && !empty($_GET['code'])) {
                User::valideWithCode($_GET['code']);
            }
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                User::mailForValide($_SESSION['email'], $_SESSION['uuid']);
        }
        require 'app/views/user/verify.php';
    }

    public function forget() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['code']) && !empty($_GET['code'])) {
                $user = User::getByUuid($_GET['code']);
            }            
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['mail']) && !empty($_POST['mail'])) {
                $mess['mail'] = User::mailForPassword($_POST['mail']);
            }
            if (isset($_POST['username']) && !empty($_POST['username'])
                && isset($_POST['pwd']) && !empty($_POST['pwd'])) {
                $mess = User::resetPassword($_POST['username'], $_POST['pwd']);
            }
        }
        require 'app/views/user/forget.php';
    }
}
?>
