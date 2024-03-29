<?php

session_start();
require_once('../models/Database.php');
require_once('../models/AdminModel.php');
$model = new AdminModel();


if (isset($_POST['action']) && $_POST['action'] === 'showUsers') {
    $users = $model->showUsers($_POST['choice']);
    if (!empty($users)) {
        echo json_encode($users, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'countTdl') {
    $tdls = $model->countTdl($_POST['tdl']);
    if (!empty($tdls)) {
        echo json_encode($tdls, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'deleteUser') {
    $suppr = $model->deleteUser($_POST['id']);
    if ($suppr) {
        echo json_encode('suppressed', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
