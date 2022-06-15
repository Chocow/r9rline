<?php
require ROOT.'core/Controller.php';
class Connexion extends Controller {
  public function index($id=null){
      $variable['connexion']=array("titre"=>"La connexion du site", "description"=>"Le texte de l'accueil");
      $this->set($variable);
      $this->render("index");
      }
    }


?>