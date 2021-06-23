<?php
session_start();
require_once('../models/Database.php');
require_once('../models/UserModel.php');
$model = new UserModel();

/*
if (isset($_POST['action']) && $_POST['action'] === 'showConversation') {
    $messages = $model->selectMessagesConversation();
    if (!empty($categories)) {
        echo json_encode($messages, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode("none", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
    
}
*/
if (isset($_POST['action']) && ($_POST['action'] === 'createMessage')) {
    if (!empty($_POST['contenu'])) {
        $userId = htmlspecialchars($_POST['userId']);
        $contenu = htmlspecialchars($_POST['contenu']);
        $idMessage = $model->addMessage($userId, $contenu);
        echo json_encode($idMessage, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode("none", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
    
}


if (isset($_POST['action']) && ($_POST['action'] === 'displayMessage')) {
    $idMessage = htmlspecialchars($_POST['idMessage']);
    $dataTask = $model->selectMessage($idMessage);
    echo json_encode($dataTask, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} else {
    echo json_encode("none", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
