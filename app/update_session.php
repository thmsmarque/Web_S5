<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['isRegistered'])) {
        $_SESSION['isRegistered'] = $_POST['isRegistered'] === 'true' ? true : false;
        echo json_encode(['status' => 'success', 'isRegistered' => $_SESSION['isRegistered']]);
        exit;
    }
}

echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
exit;
?>
