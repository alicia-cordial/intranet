<?php
require_once('Database.php');

class AdminModel extends Database
{
    public function showUsers($choice)
    {
        if (empty($choice)) {
            $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE droit = 0 and status != 'supprimé' ");
            $request->execute();
        } else {
            $request = $this->pdo->prepare("SELECT * FROM utilisateur WHERE status = ? AND droit = 0");
            $request->execute([$choice]);
        }
        $users = $request->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function deleteUser($id)
    {
        $request = $this->pdo->prepare("UPDATE utilisateur SET identifiant = 'utilisateur.ice supprimé', status ='supprimé', mail = '', mdp = '' WHERE id = ? ");
        $request2 = $this->pdo->prepare("DELETE article, utilisateur_article from article INNER JOIN utilisateur_article on id_article = article.id WHERE article.id_vendeur = ? and status ='disponible'");
        $request->execute([$id]);
        $request2->execute([$id]);
        return true;
    }


    public function showModeration($choice)
    {
        if (empty($choice)) {
            $request = $this->pdo->prepare("SELECT *, article.id as article_id FROM article INNER JOIN utilisateur on article.id_vendeur = utilisateur.id WHERE visible = 0 AND article.status = 'disponible'");
        } else {
            if ($choice == 'categorie_suggeree') {
                $request = $this->pdo->prepare("SELECT *, article.id as article_id FROM article INNER JOIN utilisateur on article.id_vendeur = utilisateur.id WHERE visible = 0 AND $choice is not null AND article.status = 'disponible'");
            } else {
                $request = $this->pdo->prepare("SELECT *, article.id as article_id FROM article INNER JOIN categorie on article.id_categorie = categorie.id INNER JOIN utilisateur on article.id_vendeur = utilisateur.id WHERE visible = 0 AND `signal` = 2 AND article.status = 'disponible'");
            }
        }
        $request->execute();
        $articles = $request->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }


}
//$model = new AdminModel();
//var_dump($model->acceptArticleNewCat('prout','43'));