<?php
    require ROOT.'core/Controller.php';
    class Panier extends Controller {
        public function index($id=null){
            $variable['panier']=array("titre"=>"Le panier du site", "description"=>"Le texte de l'accueil");
            $this->set($variable);
            $this->render("index");
            }
        
    
    }

    
?>