<?php
require_once('Database.php');

class UserModel extends Database
{
    public function userExists($email, $login)
    {
        $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE mail = ? OR identifiant = ?");
        $request->execute([$email, $login]);
        $userExists = $request->fetchAll(PDO::FETCH_ASSOC);
        return $userExists;
    }

    public function userIsAvailable($email, $login, $id)
    {
        $rows = $this->userExists($email, $login);
        if (!($rows)) {
            return true;
        } else {
            if (count($rows) === 1) {
                if ($rows[0]['id'] === $id) {
                    return true;
                }
            } else {
                return false;
            }
        }
    }

    public function selectUserData($id)
    {
        $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE id = ?");
        $request->execute([$id]);
        $userExists = $request->fetch(PDO::FETCH_ASSOC);
        return $userExists;
    }

    public function insertUser($login, $email, $hashedpassword)
    {
        $request = $this->pdo->prepare("INSERT INTO utilisateur (identifiant, mdp, mail) VALUES (:identifiant, :password, :email)");
        $insert = $request->execute(array(
            ':email' => $email,
            ':password' => $hashedpassword,
            ':identifiant' => $login
        ));
        return $insert;
    }
    public function updateUser($login, $email, $hashedpassword, $id)
    {
        $request = $this->pdo->prepare("UPDATE utilisateur SET identifiant = :identifiant, mdp = :password, mail = :email WHERE id = $id ");
        $update = $request->execute(array(
            ':email' => $email,
            ':password' => $hashedpassword,
            ':identifiant' => $login
        ));
        return $update;
    }


  
    public function addMessage($contenu, $id_utilisateur){
     
    
        $newMessage = $this->pdo->prepare("INSERT INTO `message`(contenu, id_utilisateur) VALUES (:contenu, :id_utilisateur)");
        $new = $newMessage->execute(array(
                'contenu' => $contenu,
                'id_utilisateur' => $id_utilisateur,
            ));

        return $new;
    }



    public function selectMessagesConversation()
    {
        $request = $this->pdo->prepare("SELECT `date`, identifiant, contenu FROM `message` INNER JOIN utilisateur ON utilisateur.id = message.id_utilisateur ORDER BY `date` ASC LIMIT 100");
        $request->execute();
        $messages = $request->fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    }


//ajouter tâche

    public function createNewTache($tacheName, $idUser)
    {
        $request = $this->pdo->prepare("INSERT INTO todolist (titre, id_utilisateur) VALUES (?, ?)");
        $request->execute([$tacheName, $idUser]);
        $idTache = $this->pdo->lastInsertId();

        $request2 = $this->pdo->prepare("INSERT INTO utilisateur_todolist (id_utilisateur, id_todolist) VALUES(LAST_INSERT_ID(), ?)");
        $request2->execute([$_SESSION["user"]['id']]);

        return ['id' => $idTache, 'id_utilisateur' => $idUser, 'titre' => $tacheName];
    }

//afficher tâches

public function showTache($id){
    $req = $this->pdo->prepare("SELECT * FROM todolist INNER JOIN utilisateur ON utilisateur.id = todolist.id_utilisateur WHERE utilisateur.id = $id ");
    $req->execute();
    $allTaches = $req->fetchAll(PDO::FETCH_ASSOC);

    return $allTaches;
}



//update tâche 


public function updateTache($idTache, $newName)
{
    $request = $this->pdo->prepare("UPDATE todolist SET titre = ? WHERE id = ?");
    $request->execute([$newName, $idTache]);
    return true;
}


// delete tache


public function deleteTache($id){
    $request = $this->pdo->prepare("DELETE todolist, utilisateur_todolist from todolist INNER JOIN utilisateur_todolist on todolist.id = utilisateur_todolist.id_todolist WHERE todolist.id = $id"); 
    $request->execute(['id']);
    return true;
}




}
//////
//$model = new UserModel();
//var_dump($model->addMessage('HELP', '1'));
//
//var_dump($model->sendNewMessage('4', '3', 'lala'));

//var_dump($model->selectMessagesConversation());

//////var_dump($model->selectMessagesConversation('2', '1'));
////$userExists = $model->userExists('may5', 'may5');
////var_dump($userExists);
////if($model->userIsAvailable('may@hotmail.fr', 'may', '1')) echo "no";
//var_dump($model->userIsAvailable('may@may2.fr', 'may3', '2'));
//var_dump($model->userIsAvailable('may@may.fr', 'may1', '2'));
//var_dump($model->insertArticleAModerer('lala', 'lala', '40', 'bon état', 'non', 'kakak', '1', '0'));