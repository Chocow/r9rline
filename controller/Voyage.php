<?php
    require ROOT.'core/Controller.php';
    class Voyage extends Controller {
        public function index($id=null){
            $variable['voyage']=array("titre"=>"L'accueil du site", "description"=>"Le texte de l'accueil");
            $this->set($variable);
            $this->render("index");
            }
            
            
    }
?>