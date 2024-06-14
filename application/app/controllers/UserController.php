<?php
require_once 'app/models/User.php';

class UserController {
    private function verifyField($text, $lenght) {
        if (strlen($text) == 0 || strlen($text) > $lenght) {
            return false;
        }
        return true;
    }

    private function cleanField($text) {
        $text = trim($text);
        $text = htmlspecialchars($text);
        return $text;
    }

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
                if ($this->verifyField($_POST['username'], 50) && $this->verifyField($_POST['pwd'], 50) && $this->verifyField($_POST['mail'], 50)) {
                    $username = $this->cleanField($_POST['username']);
                    $pwd = $this->cleanField($_POST['pwd']);
                    $mail = $this->cleanField($_POST['mail']);
                    if (filter_var($mail, FILTER_VALIDATE_EMAIL) && !empty($username) && !empty($pwd)) {
                        if (User::add($username, $mail, $pwd)) {
                            $mess = "Le compte a bien été créé, connectez-vous et validez votre inscription.";
                            require 'app/views/user/index.php';
                            exit;
                        }
                    }
                }
            }
            $mess = "L'inscription a échoué. Un champ n'est pas valide.";
        } 
        require 'app/views/user/add.php';
    }

    public function myMailIsValide() {
        if (isset($_SESSION['valide']) && $_SESSION['valide'] == '0' ) {
            header("Location: index.php?controller=user&action=verify");
            exit; 
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->verifyField($_POST['username'], 50) && $this->verifyField($_POST['pwd'], 50))
            {
                $username = $this->cleanField($_POST['username']);
                $pwd = $this->cleanField($_POST['pwd']);
                $mess = User::login($username, $pwd);
                require 'app/views/user/index.php';
                exit;
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
        self::myMailIsValide();
        $id = $_SESSION['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['username'])
                && isset($_POST['mail'])
                && isset($_POST['pwd'])
                && isset($_POST['oldpwd'])) {
                $username = $this->cleanField($_POST['username']);
                $mail = $this->cleanField($_POST['mail']);
                $pwd = $this->cleanField($_POST['pwd']);
                $oldpwd = $this->cleanField($_POST['oldpwd']);
                $mess = User::setting($id, $username, $mail, $pwd, $oldpwd);
            }
            if (isset($_POST['notification'])) {
                User::notification($_POST['notification'], $_SESSION['id']);
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
                $code = $this->cleanField($_GET['code']);
                $user = User::getByUuid($code);
            }            
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['mail']) && !empty($_POST['mail']) && $this->verifyField($_POST['mail'], 50)) {
                $mail = $this->cleanField($_POST['mail']);
                $mess['mail'] = User::mailForPassword($mail);
            }
            if (isset($_POST['username']) && !empty($_POST['username'] && $this->verifyField($_POST['username'], 50))
                && isset($_POST['pwd']) && !empty($_POST['pwd']) && $this->verifyField($_POST['pwd'], 50)) {
                $username = $this->cleanField($_POST['username']);
                $pwd = $this->cleanField($_POST['pwd']);
                $mess = User::resetPassword($username, $pwd);
            }
        }
        require 'app/views/user/forget.php';
    }
    

}
?>
