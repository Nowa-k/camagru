<?php
require($_SERVER["DOCUMENT_ROOT"] . '/important.php');

$response = array();
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $uuid = $_SESSION['uuid'];
    $sql = "DELETE FROM assetfeed WHERE id='$id' AND idUsers='$uuid'";
    $response = array();
    if ($conn->query($sql)) {
        $response['status'] = 'succes';
    } else {
        $response['status'] = 'failed';
    }
} else {
    $response['status'] = 'failed';
}
header('Content-Type: application/json');
echo json_encode($response);
?>