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
        $request = $this->pdo->prepare("INSERT INTO utilisateur (identifiant, mail,  mdp) VALUES (?, ?, ?)");
        $insert = $request->execute([$login, $email, $hashedpassword]);
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


  



    /********MESSAGERIE***********/

 




    public function selectMessages($choice)
    {
       
        $request = $this->pdo->prepare("SELECT * FROM `message` INNER JOIN utilisateur ON utilisateur.id = message.id_utilisateur ORDER BY date ASC");
            $request->execute([$choice]);
        
        $messages = $request->fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    }


    public function sendNewMessage($idUser, $contenu)
    {
        $request = $this->pdo->prepare("INSERT INTO `message` (id_utilisateur, contenu) VALUES (?, ?)");
        $request->execute([$idUser, $contenu]);
        $idMessage = $this->pdo->lastInsertId();
        $request2 = $this->pdo->prepare("SELECT *  FROM `message` INNER JOIN utilisateur ON utilisateur.id = message.id_utilisateur WHERE message.id = ? ");
        $request2->execute([$idMessage]);
        $message = $request2->fetch(PDO::FETCH_ASSOC);
        return $message;
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
        $request = $this->pdo->prepare("UPDATE todolist SET `description` = ? WHERE id = ?");
        $request->execute([$description, $idTask]);
        return $description;
    }

    public function updateTitle($newTitle, $idTask)
    {
        $request = $this->pdo->prepare("UPDATE todolist SET titre = ? WHERE id = ?");
        $request->execute([$newTitle, $idTask]);
        return $newTitle;
    }
}
//////
//$model = new UserModel();

//var_dump($model->insertUser('lolo', 'lol@gl', 'lolo'));