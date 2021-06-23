<?php
session_start();
require_once('../models/Database.php');
require_once('../models/UserModel.php');
$model = new UserModel();

if (isset($_POST['action']) && ($_POST['action'] === 'createMessage')) {
    if (!empty($_POST['contenu'])) {
        $userId = htmlspecialchars($_POST['userId']);
        $contenu = htmlspecialchars($_POST['contenu']);
        $idMessage = $model->addMessage($contenu, $idUser);
        echo json_encode($idMessage, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } 
}


if (isset($_POST['action']) && $_POST['action'] === 'displayMessage') {
    $messages = $model->selectMessages($_POST['choice']);
    if (!empty($messages)) {
        echo json_encode($messages, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}