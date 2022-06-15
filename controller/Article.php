<?php
    require ROOT.'core/Controller.php';
        
    class Article extends Controller{
        private $articles; //Pour l'exemple
        
        public function index($id=null){
            $variable['articles']=array("titre"=>"Les articles du site", "description"=>"Le texte
            d'introduction des articles", "lesArticles"=>$this->articles);
            $this->set($variable);
            var_dump($this->vars);
            $this->render("index");
        }

        public function detail($id){
            foreach($this->articles as $larticle){
                if($larticle->id == $id) $article=$larticle;
            }

            $variable['article']=array("titre"=>"L'article du produit ".$article->id, "identifiant"=>$article->id, "Description"=> $article->titre);
            $this->set($variable);
            var_dump($this->vars);
            $this->render("detail");
        }
          
        public function __construct(){
            echo 'Je suis les articles';
            $son1=new Son(1, "Le bruit d'une casserole");
            $son2=new Son(2, "Le miaulement d'un chat");
            $this->articles=array($son1,$son2);
        }
    }

        class Son{
            public $id;
            public $titre;
            public function __construct($id, $titre){
                $this->id=$id;
                $this->titre=$titre;
            }
        }
?>