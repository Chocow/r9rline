<?php
    class model{
        
		protected $table;
        public $id;
        protected static $pdo;
        
        public static function connexion(){
            $bd="2022-r9r-line_";
            $login="2022-r9r-line";
            $mdp="123456";
            $pdo = new PDO("mysql:host=localhost;dbname=".$bd,$login,$mdp);
            $pdo->exec('SET NAMES utf8');
            return $pdo;
        }
        
        static function deconnexion(){
            $pdo=null;
        }

		public function readOne($pdo, $shield = null){
			if($shield == null){
				$shield="*";
			}
			$sql="SELECT $shield FROM $this->table where id=".$this->id;
			var_dump($sql);
			$requete = $pdo->prepare("sql");
			$requete->execute();
			$resultats=$requete->fetchAll(PDO::FETCH_OBJ);
			var_dump($resultats);
			return $resultats[0];
		}

		public static function selectVoyage($id) {
			$prepare = Model::connexion()->prepare('SELECT * FROM voyage WHERE IDVOYAGE IN (?');
			$prepare ->execute(array($id));
			$article = $prepare->fetchAll(PDO::FETCH_OBJ);
			return $article;
		}

		public static function selectVoyageID($id) {
			$prepare = Model::connexion()->prepare("SELECT IDVOYAGE FROM voyage WHERE IDVOYAGE=?");
			$prepare ->execute(array($id));
			$article = $prepare->fetch(PDO::FETCH_OBJ);
			return $article;
		}

		function confirmBuyButton() {
			$ids = array_keys($_SESSION['panier']);
			if($ids != '') {
				foreach($ids as $id) {
				$prepare = Model::connexion()->prepare("SELECT STOCKVOYAGE FROM voyage WHERE IDVOYAGE = ?");
				$prepare->execute(array($id));
				$stockVoyage = $prepare->fetch(PDO::FETCH_OBJ);
				$stock = $stockVoyage->STOCKVOYAGE - 1;
				$prepare = Model::connexion()->prepare("UPDATE voyage SET STOCKVOYAGE = $stock WHERE IDVOYAGE = $id");
				$prepare->execute();

				$totalPrix = Model::totalPrix();
				$prepare = Model::connexion()->prepare('INSERT INTO commande (IDCOMMANDE, IDCLIENT, PRIXCOMMANDE) VALUES (?, ?, ?)');
				$prepare ->execute(array("1", "1", $totalPrix));
				}
			}
		}

		static function totalPrix() {
			$total = 0;
			$ids = array_keys($_SESSION['panier']);
			$prepare = Model::connexion()->prepare("SELECT IDVOYAGE, PrixVoyage FROM voyage WHERE IDVOYAGE IN (".implode(',',$ids).')');
			$prepare->execute();
			$articles = $prepare->fetchAll(PDO::FETCH_OBJ);
			foreach($articles as $article) {
				$total += $article->PrixVoyage;
			}
			return $total;
		}
		 static function numArticles() {
			if(array_sum($_SESSION['panier']) == 0)
			 { echo'';
			}else{
				 echo array_sum($_SESSION['panier']). ' articles';
				}
		}

		public function update($pdo,$data){
			$sql="UPDATE $this->table SET ";
			foreach($data as $k=>$v){
				if($k != "id"){
					$sql.="$k=$v,";
				}
			}
			$sql =substr($sql,0,-1);
			$sql .=" WHERE id=".(int)$this->id;
			var_dump($sql);
			$requete = $pdo->prepare($sql);
			$requete->execute();
		}

		public function insertContact($prenom, $nom, $email, $message) {
			$sql= Model::connexion()->prepare('INSERT INTO message (PRENOMMESSAGE, NOMMESSAGE, EMAILMESSAGE, LIBMESSAGE) VALUES (?, ?, ?, ?)');
			$sql->execute(array($prenom, $nom, $email, $message));
			
			

		}

		public function profilUpdate($mdp) {
			$prepare = Model::connexion()->prepare("UPDATE Users SET mdp=? WHERE email=?");
			$prepare ->execute(array($mdp, $_SESSION['email_oublier']));
		}

		public function users($email, $password2) {
			$prepare = Model::connexion()->prepare("SELECT * FROM users WHERE email=? AND mdp=?");
			$prepare ->execute(array($email, $password2));
			if($prepare != null && $prepare -> fetch()){
				$_SESSION['loggedin'] = true;
				$_SESSION['email'] = $email;    
				$_SESSION['password2'] = $password2;    
				header('Location: http://195.221.60.26:11019/2022-r9r-line/profil');
			}else{
				echo "Email ou mot de passe incorrect";
			}
		}

		public function createUsers() {
			$prepare = Model::connexion()->prepare("INSERT INTO users (email, mdp) VALUES (?, ?)");
			$prepare ->execute(array($_POST['email'], $_POST['password']));
		}

		public function articleResearch($pays) {
			$articles_research = Model::connexion()->prepare('SELECT PAYSVOYAGE FROM voyage WHERE PAYSVOYAGE LIKE "%'.$pays.'%" ORDER BY IDVOYAGE DESC');
			$articles_research->execute();
			$donnees_research = $articles_research->fetch(PDO::FETCH_OBJ);
			return $donnees_research;
		}
		public function insert($pdo,$data){
			$sql="INSERT INTO $this->table (";
			foreach($data as $k=>$v){
				if($k != "id"){
				$sql.="$k,";
				}
			}
			$sql =substr($sql,0,-1);
			$sql .=") VALUES(";
			foreach($data as $k=>$v){
				if($k != "id"){
				$sql.=$v.',';
				}
			}
			$sql =substr($sql,0,-1);
			$sql .=")";
			var_dump($sql);
			$requete = $pdo->prepare($sql);
			$requete->execute();
		}
	

		public function delete($pdo){
			$sql="DELETE FROM $this->table where id=$this->id";
			$requete = $pdo->prepare($sql);
			$requete->execute();
		}

		public function find($pdo, $data=array()){
			$condition="1=1";
			$champs="*";
			$limit="";
			$order="";
			$inner="";
			if(isset($data['condition'])) {$condition=$data['condition'];}
			if(isset($data['champs'])) {$champs=$data['champs'];}
			if(isset($data['limit'])) {$limit="LIMIT ".$data['limit'];}
			if(isset($data['order'])) {$order="ORDER BY ".$data['order'];}
			if(isset($data['join'])) {$join=$data['join'];}
			$sql="SELECT $champs FROM $this->table $join WHERE $condition$order $limit";
			var_dump($sql);
			$requete = $pdo->prepare($sql);
			$requete->execute();
			$resultats=$requete->fetchAll(PDO::FETCH_OBJ);
			return $resultats;
		}
		public static function load($name){
			require(ROOT.'model/'.ucfirst($name).'.php');
			$monObjet= ucfirst($name);
			return new $monObjet();
		}
	}
?>