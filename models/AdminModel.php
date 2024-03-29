<?php
require_once('Database.php');

class AdminModel extends Database
{
    public function showUsers($choice)
    {
        if ($_SESSION['user']['status'] == '1') {
            $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE status = '0' ");
            $request->execute([$choice]);
        }
        $users = $request->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }


    public function countTdl($tdl)
    {
        if ($_SESSION['user']['status'] == '1') {
            $request = $this->pdo->prepare("SELECT COUNT(todolist.id) FROM todolist INNER JOIN utilisateur ON utilisateur.id = todolist.id_utilisateur WHERE  utilisateur.status ='0'");
            $request->execute([$tdl]);
        }
        $tdls = $request->fetchAll(PDO::FETCH_ASSOC);
        return $tdls;
    }


    public function deleteUser($id)
    {
        $request = $this->pdo->prepare("UPDATE utilisateur SET identifiant = 'utilisateur.ice supprimé', status ='supprimé', mail = '', mdp = '', zip = '0' WHERE id = ? ");
        $request2 = $this->pdo->prepare("DELETE article, utilisateur_article from article INNER JOIN utilisateur_article on id_article = article.id WHERE article.id_vendeur = ? and status ='disponible'");
        $request->execute([$id]);
        $request2->execute([$id]);
        return true;
    }


 
    

}
//$model = new AdminModel();
//var_dump($model->acceptArticleNewCat('prout','43'));