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

    public function insertUser($status, $login, $email, $hashedpassword)
    {
        $request = $this->pdo->prepare("INSERT INTO utilisateur (identifiant, mdp, mail, status) VALUES (:identifiant, :password, :email, :status)");
        $insert = $request->execute(array(
            ':status' => $status,
            ':email' => $email,
            ':password' => $hashedpassword,
            ':identifiant' => $login
        ));
        return $insert;
    }
    public function updateUser($status, $login, $email, $hashedpassword, $id)
    {
        $request = $this->pdo->prepare("UPDATE utilisateur SET identifiant = :identifiant, mdp = :password, mail = :email, status = :status WHERE id = $id ");
        $update = $request->execute(array(
            ':status' => $status,
            ':email' => $email,
            ':password' => $hashedpassword,
            ':identifiant' => $login
        ));
        return $update;
    }




    public function selectContacts($id)
    {
        $request = $this->pdo->prepare("SELECT DISTINCT utilisateur.identifiant, utilisateur.id, utilisateur.status FROM utilisateur JOIN message INNER JOIN utilisateur_message on utilisateur_message.id_message = message.id WHERE (id_expediteur = $id AND id_destinataire = utilisateur.id) OR (id_destinataire = $id AND id_expediteur = utilisateur.id) AND droit = 0 AND utilisateur.id != $id");
        $request->execute();
        $contacts = $request->fetchAll(PDO::FETCH_ASSOC);
        return $contacts;
    }


    public function selectMessagesConversation($idDestinataire, $idUser)
    {
        $request = $this->pdo->prepare("SELECT * FROM message as m INNER JOIN utilisateur_message as um on id_message = m.id WHERE (id_expediteur = $idDestinataire AND id_destinataire = $idUser) OR (id_expediteur = $idUser AND id_destinataire = $idDestinataire)");
        $request->execute();
        $messages = $request->fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    }


    public function sendNewMessage($idDestinataire, $idUser, $messageContent)
    {
        $request = $this->pdo->prepare("INSERT into message (id_expediteur, contenu) VALUES (?, ?)");
        $request->execute([$idUser, $messageContent]);
        $idMessage = $this->pdo->lastInsertId();
        $request2 = $this->pdo->prepare("INSERT into utilisateur_message (id_destinataire, id_message) VALUES (?, ?)");
        $request2->execute([$idDestinataire, $idMessage]);
        $request3 = $this->pdo->prepare("SELECT * FROM message WHERE id = $idMessage");
        $request3->execute();
        $message = $request3->fetch(PDO::FETCH_ASSOC);
        return $message;
    }
}

//////
//$model = new UserModel();
////var_dump($model->selectContacts('4'));
//
////var_dump($model->sendNewMessage('4', '1', 'lala'));
////var_dump($model->selectMessagesConversation('4', '1'));
//////var_dump($model->selectMessagesConversation('2', '1'));
////$userExists = $model->userExists('may5', 'may5');
////var_dump($userExists);
////if($model->userIsAvailable('may@hotmail.fr', 'may', '1')) echo "no";
//var_dump($model->userIsAvailable('may@may2.fr', 'may3', '2'));
//var_dump($model->userIsAvailable('may@may.fr', 'may1', '2'));
//var_dump($model->insertArticleAModerer('lala', 'lala', '40', 'bon état', 'non', 'kakak', '1', '0'));