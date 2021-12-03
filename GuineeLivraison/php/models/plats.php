<?php 
    require_once("db.php");
    require_once("restaurant.php");

    
    class Plat{
        private $_db;
        private $_restaurant;

        public function __construct(){
            $this->_db = (new Db())->getDb();
            $this->_restaurant = new Restaurant();
        }

        public function createPlat(){
            $errors_number = 0;
			if(!empty($_POST['create_plat'])){
				if(empty($_POST["name"])){
					$_SESSION["error_name"] = "Veillez remplire ce champ";
					$errors_number += 1;
				}
                if(empty($_POST["price"]) || $_POST["price"] < 0){
					$_SESSION["error_price"] = "Le prix  doit être un entier superieur ou égale à un 1.";
					$errors_number += 1;
				}
                if(empty($_POST["description"])){
					$_POST["description"] = null;
				}
				if($errors_number == 0){
                    $article_name_in_the_db = $this->add_picture();
					if($article_name_in_the_db != "error"){
                        $req = $this->_db->prepare('INSERT INTO plats(name,price,description,photo,restaurantId,createdAt) 
                        VALUES(?,?,?,?,?,NOW())');
                        $req->execute(array(
                            $_POST["name"],$_POST["price"],$_POST["description"],
                            $article_name_in_the_db,$_SESSION['currentRestaurant']["id"]
                        ));
                        $req->closeCursor();
                        $_SESSION["success_creation"] = "Le plat (".$_POST["name"].") a été crée avec succès.";
                        unset($_POST);
                    }
				}
			}
        }

        public function updatePlat(){
            $errors_number = 0;
			if(!empty($_POST['update'])){
				if(empty($_POST["name"])){
					$_SESSION["error_name"] = "Ce champ n'était pas bien remplit";
					$errors_number += 1;
				}
                if(empty($_POST["price"]) || $_POST["price"] < 0){
					$_SESSION["error_price"] = "Le prix  devrait être un entier superieur ou égale à un 1.";
					$errors_number += 1;
				}
                if(empty($_POST["description"])){
					$_POST["description"] = null;
				}
				if($errors_number == 0){
                    if(isset($_FILES['photo']) AND !empty($_FILES['photo']['name'])){
                        $article_name_in_the_db = $this->add_picture();
                    }else{
                        $article_name_in_the_db = $_SESSION['currentPlat']['photo'];
                    }
                    
					if($article_name_in_the_db != "error"){
                        $req = $this->_db->prepare('UPDATE plats SET name = ?, price = ?, description = ?, photo = ? WHERE id = ?');
                        $req->execute(array(
                            $_POST["name"],$_POST["price"],$_POST["description"],
                            $article_name_in_the_db,$_SESSION['currentPlat']["id"]
                        ));
                        $req->closeCursor();
                        $_SESSION["success_apdated"] = "Votre modification à bien été enregistré";
                        unset($_POST);
                        if(isset($_SESSION['currentPlat'])) unset($_SESSION['currentPlat']);
                        $_SESSION['currentPlat'] = $this->getPlatById($_SESSION['currentPlatId']);
                    }
				}
			}
        }

        public function getAllPlatsByRestaurantId($id){
            $req = $this->_db->prepare('SELECT id,name,price,description,photo,restaurantId,DATE_FORMAT(createdAt, \'%d-%m-%Y\') AS createdAt FROM plats WHERE restaurantId = ?');
            $req->execute(array($id));

            return $req->fetchAll();
        }

        
        public function add_picture(){
            if(isset($_FILES['photo']) AND !empty($_FILES['photo']['name'])){
                $tailMax = 2097152;
                $extention = array('jpg','jpeg','gif','png');
                if($_FILES['photo']['size'] <= $tailMax){
                    $file_upload_extension =strtolower(substr(strrchr($_FILES['photo']['name'],'.'), 1));
                    if(in_array($file_upload_extension, $extention)){
                        $article_name_in_the_folder_and_in_db = date("Y-m-h-i-s").'.'.$file_upload_extension;
                        $chemin = '../../image/platImages/'.$article_name_in_the_folder_and_in_db;
                        $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
                        if($resultat){
                            return $article_name_in_the_folder_and_in_db;
                        }else{
                            $_SESSION['error_photo'] = "Il y a eu une erreur lors de l'importation de la photo";
                            return "error";
                        }
                    }else{
                        $_SESSION['error_photo'] = "La photo de l'article doit être au format jpep ,jpg ,gif ou png";
                        return "error";
                    }
                }else{
                    $_SESSION['error_photo'] ='La taille de la photo doit être au maximun = 2Mo';
                    return "error";
                }
            }else{
                $_SESSION['error_photo'] = "veillez choisir la photo de l'article!";
                return "error";
            }
        }


        public function getAllPlats(){
            $plats = [];
            $req = $this->_db->prepare('SELECT id,name,price,description,photo,restaurantId,DATE_FORMAT(createdAt, \'%d-%m-%Y\') AS createdAt FROM plats');
            $req->execute(array());
            while ($result = $req->fetch()){
                $plats[] = $result;
            }
            return $plats;
            
        }

        

        public function getPlatById($id){
            $req = $this->_db->prepare('SELECT id,name,price,description,photo,restaurantId,DATE_FORMAT(createdAt, \'%d-%m-%Y\') AS createdAt FROM plats WHERE id = ?');
            $req->execute(array($id));
            
            return $req->fetch();
        }

        public function getPlatDescriptionSubString($description) {
            $subString = $description;
            if(strlen($description) >= 70){
                $subString = substr($subString,0,70).".....";
            }
            return $subString;
        }

        public function platPagination(){
            $numberByPage = 10;
            $totalPlats = count($this->getAllPlatsByRestaurantId($_SESSION['currentRestaurant']['id']));
            $totalPages = intval(ceil($totalPlats / $numberByPage));
            if(isset($_GET["page"]) AND !empty($_GET["page"]) AND $_GET["page"] > 0 AND $_GET["page"] <= $totalPages){
                $pageCourante = intval($_GET["page"]);
            }else{
                $pageCourante = 1;
            }
            $start = ($pageCourante -1) * $numberByPage;
            $reponse = $this->_db->prepare('SELECT id,name,price,description,photo,restaurantId,DATE_FORMAT(createdAt, \'%d-%m-%Y\') AS createdAt FROM plats WHERE restaurantId = ? ORDER BY id ASC LIMIT '.$start.','.$numberByPage);
            $reponse->execute(array($_SESSION['currentRestaurant']['id']));
            if($reponse->rowCount() == 0){
                $plats = [];
            }else{
                $articles = [];
                while ($donnees = $reponse->fetch()){
                    $plats[] = $donnees;
                }
            }
            $reponse->closeCursor();
            $pagination["plats"] = $plats;
            $pagination["totalPage"] = $totalPages;
            $pagination["pageCourante"] = $pageCourante;
            return $pagination; 
        }

        public function getTwoPlatsForEveryRestaurants(){
            $result = [];
            $restaurants = $this->_restaurant->getAllRestaurants();
            foreach ($restaurants as $restaurant){
                $plats = $this->getAllPlatsByRestaurantId($restaurant['id']);
                if(count($plats) != 0){
                    for($i = 0; $i < count($plats); $i++){
                        if($i > 2) break;
                        $result[] = $plats[$i];
                    }
                }
            }

            return $result;
        }

        public function getRestaurantByIdForPlat($restaurantId) {
            return $this->_restaurant->getRestaurantById($restaurantId);
        }

        public function search($query){
            $plats = [];
            
            $sqlBase = "SELECT DISTINCT id,name,price,description,photo,restaurantId FROM plats";
            $queries = explode(' ', $query);
            $i = 0;
            foreach ($queries as $mot) {
                if($i == 0){
                    $sqlBase .= " WHERE ";
                }else{
                    $sqlBase .= " OR ";
                }
                
                if($mot != '') $sqlBase .= " description LIKE '%$mot%' OR name LIKE '%$mot%'";

                $i++;
            }

            $req = $this->_db->query($sqlBase);
            
            return $req->fetchAll();
        }
    }
    