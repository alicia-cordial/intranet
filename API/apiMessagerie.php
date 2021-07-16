<?php

require_once('../models/Database.php');
require_once('../models/UserModel.php');
$model = new UserModel();

session_start();

if (isset($_POST['action']) && $_POST['action'] === 'sendNewMessage') {


   // (int)$idUser = htmlspecialchars($_POST['idUser']);
    $idUser = (int)$_POST['idUser'];
    $contenu = htmlspecialchars($_POST['contenu']);

   // var_dump($idUser);
    //var_dump($contenu);

    $message = $model->sendNewMessage($idUser, $contenu);
  

    echo json_encode($message, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  
}



if (isset($_POST['action']) && $_POST['action'] === 'displayMessages') {
    $messages = $model->selectMessages($_POST['choice']);
    if (!empty($messages)) {
        echo json_encode($messages, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

