<?php
session_start();
require_once('../models/Database.php');
require_once('../models/UserModel.php');
$model = new UserModel();


/*CREATION TACHE*/
if (isset($_POST['action']) && ($_POST['action'] === 'createTask')) {
    if (!empty($_POST['titleTask'])) {
        $userId = htmlspecialchars($_POST['userId']);
        $titleTask = htmlspecialchars($_POST['titleTask']);
        $idTask = $model->insertTask($userId, $titleTask);
        echo json_encode($idTask, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

/*AFFICHAGE TACHE*/
if (isset($_POST['action']) && ($_POST['action'] === 'displayTask')) {
    $idTask = htmlspecialchars($_POST['idTask']);
    $dataTask = $model->selectTask($idTask);
    echo json_encode($dataTask, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

/*AJOUTER DESCRIPTION*/
if (isset($_POST['action']) && ($_POST['action'] === 'addDescription')) {
    $idTask = htmlspecialchars($_POST['idTask']);
    $description = htmlspecialchars($_POST['description']);
    $dataTask = $model->addDescription($description, $idTask);
    echo json_encode($dataTask, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

/*UPDATE TITRE*/
if (isset($_POST['action']) && ($_POST['action'] === 'updateTitle')) {
    $idTask = htmlspecialchars($_POST['idTask']);
    $newTitle = htmlspecialchars($_POST['newTitle']);
    $dataTask = $model->updateTitle($newTitle, $idTask);
    echo json_encode($dataTask, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

/*MARQUER COMME TERMINEE*/
if (isset($_POST['action']) && ($_POST['action'] === 'finish')) {
    $idTask = htmlspecialchars($_POST['idTask']);
    $endTask = $model->endTask($idTask);
    echo json_encode($endTask, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

/*MARQUER COMME ARCHIVER*/
if (isset($_POST['action']) && ($_POST['action'] === 'archive')) {
    $idTask = htmlspecialchars($_POST['idTask']);
    $dates = $model->archiveTask($idTask);
    echo json_encode($dates, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
