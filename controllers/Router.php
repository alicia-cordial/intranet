<?php

require_once('views/View.php');

class Router{

    //ATTRIBUTS
    private $_ctrl; //controller
    private $_view;

    public function routeReq(){
        try{
            //chargement automatique des classes
            spl_autoload_register(function($class){
                require_once('models/'.$class.'.php');
                
            });

            $url = '';


//LE CONTROLLER EST INCLUS SELON L'ACTION  DE L'USER
            if(isset($_GET['url'])){

                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL)); // SECURITÉ

                $controller = ucfirst(strtolower($url[0])); //1ère lettre majuscule le reste en minuscule
                $controllerClass = "Controller".$controller; 
                $controllerFile = "controllers/".$controllerClass.".php";


                if(file_exists($controllerFile)){ //si fichier existe

                    require_once($controllerFile);
                    $this->_ctrl = new $controllerClass($url);

                } else
                throw new Exception(('Page Introuvable'));

            } else{
                require_once('controllers/ControllerAccueil.php');
                $this->_ctrl = new ControllerAccueil($url);
            }
        }
        //GESTION DES ERREURS
        catch(Exception $e){
                $errorMsg = $e->getMessage();
                $this->_view = new View('Error');
                $this->_view->generate(array('errorMsg' => $errorMsg));
        }
    }
}