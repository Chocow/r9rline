<?php
    require ROOT.'core/Controller.php';
    class Mdp_oublier extends Controller {
        public function index($id=null){
            $variable['mdp_oublier']=array("titre"=>"mot de passe oublier", "description"=>"Le texte de l'accueil");
            $this->set($variable);
            $this->render("index");
            }

       // public function __construct(){
       // echo 'Je suis l\'accueil';
       // }
    }
?>