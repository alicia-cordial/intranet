<?php

class View{
    private $_file;
    private $_t; //TITLE


    public function __construct($action){
        $this->_file = 'views/view'.$action.'.php';
    }

    //GÉNÈRE ET AFFICHE VUE
    public function generate($data){

        //PARTIE SPÉCIFIQUE DE LA VUE
        $content = $this->generateFile($this->_file, $data);

        //TEMPLATE
        $view = $this->generateFile('views/template.php', array('t' => $this->_t, 'content' =>$content));


        echo $view;
    }


//GÉNÈRE 1 FICHIER VUE ET RENVOIE RÉSULTAT PRODUIT
    private function generateFile($file, $data){
    if(file_exists($file)){
        extract($data);

        ob_start();


//INCLUE FICHIER VUE
        require $file;

        return ob_get_clean();

         } else
            throw new Exception('Fichier '.$file.' introuvable');
    }



}