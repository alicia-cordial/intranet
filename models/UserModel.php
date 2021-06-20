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


    /***************TODOLIST***************/

    public function insertTask($idUser, $titleTask)
    {
        $request = $this->pdo->prepare("INSERT INTO todolist (`id_utilisateur`, `titre`, `description`) VALUES (:idUser, :title, :description)");
        $insert = $request->execute(array(
            ':idUser' => $idUser,
            ':title' => $titleTask,
            ':description' => ''));
        $idTask = $this->pdo->lastInsertId();
        return $idTask;
    }

    public function selectTask($idTask)
    {
        $request = $this->pdo->prepare("SELECT * FROM todolist WHERE id = ?");
        $request->execute([$idTask]);
        $taskData = $request->fetch(PDO::FETCH_ASSOC);
        return $taskData;
    }


    public function selectTasks($idUser)
    {
        $request = $this->pdo->prepare("SELECT * FROM todolist WHERE id_utilisateur = ? AND status = 'todo' ");
        $request->execute([$idUser]);
        $tasksUserToDo = $request->fetchAll(PDO::FETCH_ASSOC);

        $request2 = $this->pdo->prepare("SELECT * FROM todolist WHERE id_utilisateur = ? AND status = 'done' ");
        $request2->execute([$idUser]);
        $tasksUserDone = $request2->fetchAll(PDO::FETCH_ASSOC);

        $request3 = $this->pdo->prepare("SELECT * FROM todolist WHERE id_utilisateur = ? AND status = 'archive' ");
        $request3->execute([$idUser]);
        $tasksUserArchive = $request3->fetchAll(PDO::FETCH_ASSOC);
        $tasksUser = array('toDo' => $tasksUserToDo, 'done' => $tasksUserDone, 'archive' => $tasksUserArchive);
        return $tasksUser;
    }

    public function endTask($idTask)
    {
        $request = $this->pdo->prepare("UPDATE todolist SET status = 'done', END = NOW() WHERE id = ?");
        $request->execute([$idTask]);
        return date('d-m-Y');
    }

    public function archiveTask($idTask)
    {
        $request = $this->pdo->prepare("UPDATE todolist SET status = 'archive' WHERE id = ?");
        $request->execute([$idTask]);
        $request2 =  $this->pdo->prepare("SELECT `start` FROM todolist WHERE id= ?");
        $date = $request->execute([$idTask]);
        return $date;
    }

    public function addDescription($description, $idTask)
    {
        $request = $this->pdo->prepare("UPDATE todolist SET description = ? WHERE id = ?");
        $request->execute([$description, $idTask]);
        return $description;
    }

    public function updateTitle($newTitle, $idTask)
    {
        $request = $this->pdo->prepare("UPDATE todolist SET title = ? WHERE id = ?");
        $request->execute([$newTitle, $idTask]);
        return $newTitle;
    }
}
//////
//$model = new UserModel();
//var_dump($model->insertTask('1', 'LALA'));
//echo '<pre>';
//var_dump($model->selectTasks('2'));
//echo '</pre>';
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