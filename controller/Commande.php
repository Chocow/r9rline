<?php
require ROOT.'core/Controller.php';
class Commande extends Controller {
  public function index($id=null){
      $variable['commande']=array("titre"=>"Commande user", "description"=>"La commande de l'utilisateur");
      $this->set($variable);
      $this->render("index");
      }
    }


?>