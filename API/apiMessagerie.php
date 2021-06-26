<?php
session_start();
require_once('../models/Database.php');
require_once('../models/UserModel.php');
$model = new UserModel();
/*
if (isset($_POST['action']) && ($_POST['action'] === 'createMessage')) {
    if (!empty($_POST['contenu'])) {
        $userId = htmlspecialchars($_POST['userId']);
        $contenu = htmlspecialchars($_POST['contenu']);
        $idMessage = $model->sendNewMessage($idUser, $messageContent);
        echo json_encode($idMessage, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } 
}
*/

if (isset($_POST['action']) && $_POST['action'] === 'displayMessage') {
    $idMessage = $model->selectMessage($_POST['idMessage']);
    $dataMessage = $model->selectMessage($idMessage);
        echo json_encode($dataMessage, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  
}

if (isset($_POST['action']) && $_POST['action'] === 'sendNewMessage') {
    $message = $model->sendNewMessage($_SESSION['user']['id'], htmlspecialchars($_POST['contenu']));
    echo json_encode($message, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
