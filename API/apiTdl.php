<?php
session_start();
require_once('../models/Database.php');
require_once('../models/UserModel.php');
$model = new UserModel();

// AFFICHER TACHE

if (isset($_POST['action']) && $_POST['action'] === 'selectTdl') {
    $tdls = $model->selectTdl($_SESSION['user']['id']);
    if ($tdls) {
        echo json_encode($tdls, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode('none', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}


    


// NOUVELLE TACHE

  if(isset($_POST["texte_tache"])) {

   
    $req_tache = $this->pdo->prepare("INSERT INTO tasks (name, finish, date_creation) VALUES(?, 0, NOW())");
    $req_tache->execute([$_POST["texte_tache"]]);
  
    $id_tache = $this->pdo->lastInsertId();
  
    $req_jonction = $this->pdo->prepare("INSERT INTO jonction (task_id, user_id) VALUES(LAST_INSERT_ID(), ?)");
    $req_jonction->execute([$_POST["user_id"]]);
  
    echo $id_tache;
  
  }

//


if(isset($_POST["id_tache"])) {

    $id_tache = $_POST["id_tache"];
    $req = $this->pdo->prepare("UPDATE tasks SET name = ? WHERE id = ?");
    $req->execute([$_POST["name"], $id_tache]);
    echo $id_tache;
  }

  //SUPPRIMER TÂCHE

  if(isset($_POST["id_tache"])) {

 
    $req_tache = $this->pdo->prepare("DELETE FROM tasks WHERE id = ?");
    $req_tache->execute([$_POST["id_tache"]]);
  
    $req_jonction = $this->pdo->prepare("DELETE FROM jonction WHERE task_id = ?");
    $req_jonction->execute([$_POST["id_tache"]]);
  
  }

//

  if(isset($_POST["id_tache"])) {

  
    $id_tache = $_POST["id_tache"];
    $req = $this->pdo->prepare("UPDATE tasks SET finish = 1, date_finish = NOW() WHERE id = ?");
    $req->execute([$id_tache]);
  }