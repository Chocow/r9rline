<?php
    require ROOT.'core/Controller.php';
    class Contact extends Controller {
        public function index($id=null){
            $variable['contact']=array("titre"=>"Le contacte du site", "description"=>"Le texte de l'accueil");
            $this->set($variable);
            $this->render("index");
            }

       // public function __construct(){
       // echo 'Je suis l\'accueil';
       // }
    }
?>