<?php
    require ROOT.'core/Controller.php';
    class About extends Controller {
        public function index($id=null){
            $variable['about']=array("titre"=>"A propos du site", "description"=>"Le texte de l'accueil");
            $this->set($variable);
            $this->render("index");
            }

       // public function __construct(){
       // echo 'Je suis l\'accueil';
       // }
    }
?>