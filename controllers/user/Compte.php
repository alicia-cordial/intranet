<?php


class Compte
{
    function __construct()
    {
        $title = "Compte";
        $css = "compte.css";
        $js = ['module.js', 'compte.js', 'todo.js'];
        ob_start();
        $this->selectMain();
        $main = ob_get_clean();

        $render = new View($title, $css, $main, $js);
    }

    public function selectMain()
    {
//        Si pas connecté
        if (!isset($_SESSION['user'])) {
            require_once('views/user/connexion.php');
        } else {
             if ($_SESSION['user']['status'] === '0') {
                require_once('views/user/userIndex.php');
            } else if ($_SESSION['user']['status'] === '1') {
                require_once('views/admin/adminIndex.php');
            }
        }
     
    }


}