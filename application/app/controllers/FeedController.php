<?php
require_once 'app/models/Feed.php';

class FeedController {
    public function index() {
        $feed = Feed::getAll();
        require 'app/views/feed/index.php';
    }

    public function view($id) {
        $feed = Feed::getById($id);
        require 'app/views/feed/view.php';
    }

    public function add() {
        if ($_SESSION['id']) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                Feed::add($_POST['overlayImage']);
            }
            $feed = Feed::getUserFeed($_SESSION['id']);
            require 'app/views/feed/add.php';
        } else {
            require 'app/views/user/login.php';
        }
    }

    public function del() {
        if ($_SESSION['id']) {
            Feed::del($_SESSION['id'], $_GET['id']);
        }
        self::index();
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['id']) {
            if ($_POST['canvasData'] && $_POST['overlay']) {
                Feed::create($_POST['canvasData'], $_POST['overlay']);
            }
        }
    }
}