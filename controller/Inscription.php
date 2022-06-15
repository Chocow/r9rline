<?php
    require ROOT.'core/Controller.php';
    class Inscription extends Controller {
        public function index($id=null){
            $variable['inscription']=array("titre"=>"L'inscription du site", "description"=>"Le texte de l'accueil");
            $this->set($variable);
            $this->render("index");
            }

       // public function __construct(){
       // echo 'Je suis l\'accueil';
       // }
    }
?>