<?php
session_start();
$response = array();

if (isset($_SESSION['username'])) {
    $response['status'] = 'active';
} else {
    $response['status'] = 'inactive';
}

header('Content-Type: application/json');
echo json_encode($response);
?>