<?php
session_start();
require_once('../models/Database.php');
require_once('../models/UserModel.php');
$model = new UserModel();


/*CREATION TACHE*/
if (isset($_POST['action']) && ($_POST['action'] === 'createTask')) {
    if (!empty($_POST['titleTask'])) {
        $model = new UserModel();
        $idUser = (int)$_POST['idUser'];
        $titleTask = htmlspecialchars($_POST['titleTask']);
        $idTask = $model->insertTask($userId, $titleTask);
        echo json_encode($idTask, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

/*
if (isset($_POST['action']) && $_POST['action'] === 'addTask') {


    // (int)$idUser = htmlspecialchars($_POST['idUser']);
     $idUser = (int)$_POST['idUser'];
     $titleTask = htmlspecialchars($_POST['titleTask']);
     $data = $model->sendNewMessage($idUser, $titleTask);
     echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
   
 }
 */

/*AFFICHAGE TACHE*/
if (isset($_POST['action']) && ($_POST['action'] === 'displayTask')) {
    $model = new UserModel();
    $idTask = htmlspecialchars($_POST['idTask']);
    $dataTask = $model->selectTask($idTask);
    echo json_encode($dataTask, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}


/*AJOUTER DESCRIPTION*/
if (isset($_POST['action']) && ($_POST['action'] === 'addDescription')) {
    $model = new UserModel();
    $idTask = htmlspecialchars($_POST['idTask']);
    $description = htmlspecialchars($_POST['description']);
    $dataTask = $model->addDescription($description, $idTask);
    echo json_encode($dataTask, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

/*UPDATE TITRE*/
if (isset($_POST['action']) && ($_POST['action'] === 'updateTitle')) {
    $model = new UserModel();
    $idTask = htmlspecialchars($_POST['idTask']);
    $newTitle = htmlspecialchars($_POST['newTitle']);
    $dataTask = $model->updateTitle($newTitle, $idTask);
    echo json_encode($dataTask, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

/*MARQUER COMME TERMINEE*/
if (isset($_POST['action']) && ($_POST['action'] === 'finish')) {
    $model = new UserModel();
    $idTask = htmlspecialchars($_POST['idTask']);
    $endTask = $model->endTask($idTask);
    echo json_encode($endTask, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

/*MARQUER COMME ARCHIVER*/
if (isset($_POST['action']) && ($_POST['action'] === 'archive')) {
    $model = new UserModel();
    $idTask = htmlspecialchars($_POST['idTask']);
    $dates = $model->archiveTask($idTask);
    echo json_encode($dates, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

