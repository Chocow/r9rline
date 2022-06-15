<?php
    require ROOT.'core/Controller.php';
    class Service extends Controller {
        public function index($id=null){
            $variable['services']=array("titre"=>"Le service du site", "description"=>"Le texte de l'accueil");
            $this->set($variable);
            $this->render("index");
            }

       // public function __construct(){
       // echo 'Je suis l\'accueil';
       // }
    }
?>