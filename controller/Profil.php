<?php
require ROOT.'core/Controller.php';
class Profil extends Controller {
  public function index($id=null){
      $variable['profil']=array("titre"=>"Votre profil", "description"=>"Le texte de l'accueil");
      $this->set($variable);
      $this->render("index");
      }
    }


    ?>