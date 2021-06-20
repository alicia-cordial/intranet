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
        $idTask = $pdo->insertTask($userId, $titleTask);
        echo json_encode($idTask);
    }
}

/*AFFICHAGE TACHE*/
if (isset($_POST['action']) && ($_POST['action'] === 'displayTask')) {
    $idTask = htmlspecialchars($_POST['idTask']);
    $dataTask = $pdo->selectTask($idTask);
    echo json_encode($dataTask);
}

/*AJOUTER DESCRIPTION*/
if (isset($_POST['action']) && ($_POST['action'] === 'addDescription')) {
    $idTask = htmlspecialchars($_POST['idTask']);
    $description = htmlspecialchars($_POST['description']);
    $dataTask = $pdo->addDescription($description, $idTask);
    echo json_encode($dataTask);
}

/*UPDATE TITRE*/
if (isset($_POST['action']) && ($_POST['action'] === 'updateTitle')) {
    $idTask = htmlspecialchars($_POST['idTask']);
    $newTitle = htmlspecialchars($_POST['newTitle']);
    $dataTask = $pdo->updateTitle($newTitle, $idTask);
    echo json_encode($dataTask);
}

/*MARQUER COMME TERMINEE*/
if (isset($_POST['action']) && ($_POST['action'] === 'finish')) {
    $idTask = htmlspecialchars($_POST['idTask']);
    $endTask = $pdo->endTask($idTask);
    echo json_encode($endTask);
}

/*MARQUER COMME ARCHIVER*/
if (isset($_POST['action']) && ($_POST['action'] === 'archive')) {
    $idTask = htmlspecialchars($_POST['idTask']);
    $dates = $pdo->archiveTask($idTask);
    echo json_encode($dates);
}
