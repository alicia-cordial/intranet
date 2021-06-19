<?php
session_start();
require_once('../models/Database.php');
require_once('../models/UserModel.php');
$model = new UserModel();

/*if (isset($_POST['action']) && $_POST['action'] === 'selectTache') {

    $taches = $model->selectTaches($_POST['titre']);
    if (!empty($taches)) {
        echo json_encode($taches, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode("none", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}*/


if (isset($_POST['action']) && $_POST['action'] === 'showTache') {
    $tdls = $model->showTache($_SESSION['user']['id']);
    if (!empty($tdls)) {
        echo json_encode($tdls, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}


if (isset($_POST['action']) && $_POST['action'] === 'addNewTache') {
    $add = $model->createNewTache($_POST['titre'], $_SESSION['user']['id']);
    if ($add) {
        echo json_encode($add, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

}

if (isset($_POST['action']) && $_POST['action'] === 'deleteTache') {
    $suppr = $model->deleteTache($_POST['id']);
    if ($suppr) {
        echo json_encode('suppressed', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}


if (isset($_POST['action']) && $_POST['action'] === 'updateTache') {

    $newCat = $model->updateTache($_POST['idTache'], $_POST['newName']);
    if ($newTache) {
        echo json_encode("success", JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

