<?php
require_once('Database.php');
//require_once('../../views/user/messagerie.php');




/**
 * Connexion simple à la base de données via PDO !
 */
$pdo = new PDO('mysql:host=localhost;dbname=intranet;charset=utf8', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
/**
 * On doit analyser la demande faite via l'URL (GET) afin de déterminer si on souhaite récupérer les messages ou en écrire un
 */
$task = "list";

if(array_key_exists("task", $_GET)){
  $task = $_GET['task'];
}

if($task == "write"){
  postMessage();
} else {
  getMessages();
}




/**
 * Si on veut récupérer, il faut envoyer du JSON
 */
function getMessages(){
    global $pdo;

  // 1. On requête la base de données pour sortir les 20 derniers messages
  $resultats = $pdo->prepare("SELECT * FROM `message` INNER JOIN utilisateur ON utilisateur.id = message.id_utilisateur ORDER BY `date` DESC LIMIT 20");
  // 2. On traite les résultats
  $resultats->execute();
  $messages = $resultats->fetchAll(PDO::FETCH_ASSOC);
  // 3. On affiche les données sous forme de JSON
  echo json_encode($messages);

//var_dump($messages);


}
/**
 * Si on veut écrire au contraire, il faut analyser les paramètres envoyés en POST et les sauver dans la base de données
 */
function postMessage(){
    global $pdo;
    echo'test';
  // 1. Analyser les paramètres passés en POST (author, content)
  
  if(!array_key_exists('author', $_POST) || !array_key_exists('contenu', $_POST)){

    echo json_encode(["status" => "error", "message" => "One field or many have not been sent"]);
    return;

  }

  // 2. Créer une requête qui permettra d'insérer ces données
 

  $author = htmlspecialchars($_SESSION['user']['id']);
  $contenu = htmlspecialchars($_POST['contenu']);

  var_dump($author);
  //var_dump($contenu);
  var_dump($_SESSION['user']['id']);

  $req = $pdo->prepare("SELECT * FROM utilisateur WHERE id = '$author' ");
  $req->execute();

  var_dump($req);

    $idUser = $pdo->lastInsertId();
      $query = $pdo->prepare("INSERT INTO `message` SET id_utilisateur = :'$idUser', contenu = :contenu, `date` = NOW()");
      $query->execute(
        [
          $idUser => $author,
          "contenu" => $contenu  
        ]
      );

    var_dump($idUser);

       




  // 3. Donner un statut de succes ou d'erreur au format JSON
  echo json_encode(["status" => "success"]);
}
/**
 * Voilà c'est tout en gros.
 */
//SELECT id_utilisateur, date, contenu, identifiant FROM message INNER JOIN utilisateur ON message.id_utilisateur = utilisateur.id