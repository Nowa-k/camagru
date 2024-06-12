<?php
require_once 'app/models/Feed.php';

class FeedController {
    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $resultsPerPage = 5;
        $totalFeeds = Feed::getTotalFeedCount();
        $totalPages = ceil($totalFeeds / $resultsPerPage);
        $firstResults = ($page - 1) * $resultsPerPage;
        $feeds = Feed::getAll($firstResults, $resultsPerPage);
        require 'app/views/feed/index.php';
    }

    public function view($id) {
        $feed = Feed::getById($id);
        require 'app/views/feed/view.php';
    }

    public function add() {
        if (isset($_SESSION['id'])) {
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
        if (isset($_SESSION['id'])) {
            Feed::del($_SESSION['id'], $_GET['id']);
        }
        self::index();
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['id']) {
            if (isset($_POST['canvasData']) && isset($_POST['overlay'])) {
                Feed::create($_POST['canvasData'], $_POST['overlay']);
            }
        }
    }

    public function comment() {
        if (isset($_SESSION['id'])) {
            if (isset($_POST['comment']) && isset($_GET['id'])) {
                Feed::comment($_GET['id'], $_POST['comment'], $_SESSION['id']);
            }
        }
        self::index();
    }

    public function like() {
        if (isset($_SESSION['id']) && isset($_GET['id'])) {
            Feed::like($_SESSION['id'], $_GET['id']);
        }
        self::index();
    }
}