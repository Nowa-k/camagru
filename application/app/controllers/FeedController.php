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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            var_dump($_POST);
            var_dump($_GET);
            // header('Location: index.php?controller=feed&action=index');
        } else {
            require 'app/views/feed/add.php';
        }
    }
}