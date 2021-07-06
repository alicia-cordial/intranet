<?php
session_start();
require_once('../models/Database.php');
require_once('../models/UserModel.php');
$model = new UserModel();



if (isset($_POST['action']) && $_POST['action'] === 'sendNewMessage') {
    $message = $model->sendNewMessage($_SESSION['user']['id'], htmlspecialchars($_POST['contenu']));
    if(!empty($message)){
    echo json_encode($message, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}



if (isset($_POST['action']) && $_POST['action'] === 'displayMessages') {
    $messages = $model->selectMessages($_POST['choice']);
    if (!empty($messages)) {
        echo json_encode($messages, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

