<?php 
    require_once("db.php");
    require_once("functions.php");


    class Restaurant {
        protected $_db;

        public function __construct(){
            $this->_db = (new Db())->getDb();
        }

        public function createRestaurant(){
            $errors_number = 0;
            if(!empty($_POST['create_restaurant'])){
                if(empty($_POST["name"])){
					$_SESSION["error_name"] = "Veuillez remplire che champ.";
					$errors_number += 1;
				}
                if(empty($_POST["phone"]) || !verif_phone($_POST["phone"])){
					$_SESSION["error_phone"] = "Donner le numéro de téléphone du propriétaire du restaurant.";
					$errors_number += 1;
				}
                if(empty($_POST["ville"])){
					$_SESSION["error_ville"] = "Veuillez remplire che champ.";
					$errors_number += 1;
				}
                if(empty($_POST["quartier"])){
					$_SESSION["error_quartier"] = "Veuillez remplire che champ.";
					$errors_number += 1;
				}
                if(empty($_POST["description"])){
					$_POST["description"] = null;
				}
                if(empty($_POST["precision"])){
					$_POST["precision"] = null;
				}
                if($errors_number == 0){
                    $ownerId = $this->restaurantOwnerExistWithThisPhone($_POST["phone"]);
                    if($ownerId != null){
                        if(!$this->exitThisRestaurantMoreThanTwo($ownerId)){
                            $req = $this->_db->prepare(
                                'INSERT INTO restaurants(name,ville,quartier,ownerId,precisionAproximative,description,createdAt) 
                                VALUES(?,?,?,?,?,?,NOW())'
                            );
                            $req->execute(array(
                                $_POST["name"],$_POST["ville"],$_POST["quartier"],$ownerId,$_POST["precision"],$_POST["description"]
                            ));
                            $_SESSION["succesAdd"] = "Le restaurant (".$_POST["name"].") a été ajouté avec succès.";
                            unset($_POST);
                        }else{
                            $_SESSION["error_phone"] = 'Il exite déjà deux restaurants (la limite) avec ce numéro de téléphone .';
                        }
                    }else{
                        $_SESSION["error_phone"] = "Aucun compte trouvé pour ce numéro .";
                    }
                }
            }
        }

        public function modifierRestaurant(){
            $errors_number = 0;
            if(!empty($_POST['restaurantModifier'])){
                if(empty($_POST["name"])){
					$_SESSION["error_name"] = "Ce champ n'étais pas remplit.";
					$errors_number += 1;
				}
                if(empty($_POST["ville"])){
					$_SESSION["error_ville"] = "Ce champ n'étais pas remplit.";
					$errors_number += 1;
				}
                if(empty($_POST["quartier"])){
					$_SESSION["error_quartier"] = "Ce champ n'étais pas remplit.";
					$errors_number += 1;
				}
                if(empty($_POST["description"])){
					$_POST["description"] = null;
				}
                if(empty($_POST["precision"])){
					$_POST["precision"] = null;
				}
                if($errors_number == 0){
                    $req = $this->_db->prepare(
                        'UPDATE restaurants SET name = ?, ville = ?, quartier = ?, precisionAproximative = ?,description = ? WHERE id = ?'
                    );
                    $req->execute(array(
                        $_POST["name"],$_POST["ville"],$_POST["quartier"],$_POST["precision"],$_POST["description"],$_SESSION['currentRestaurant']['id']
                    ));
                    $_SESSION["succesUpdate"] = "Vos modifications on été effectuées avec succès.";
                    unset($_POST);
                }
            }
        }

        public function exitThisRestaurantMoreThanTwo($ownerId){
            $req = $this->_db->prepare('SELECT id FROM restaurants WHERE ownerId= ?');
            $req->execute(array($ownerId));
            if($req->rowCount() >= 2){
                return true;
            }else{
                return false;
            }
        }

        public function getAllRestaurants(){
            $req = $this->_db->prepare('SELECT id,name,ville,quartier,ownerId,precisionAproximative,description,DATE_FORMAT(createdAt,\'%d/%m/%Y\') AS createdAt FROM restaurants');
            $req->execute(array());
            return $req->fetchAll();
        }

        public function getRestaurantById($id){
            $req = $this->_db->prepare('SELECT id,name,ville,quartier,ownerId,precisionAproximative,description,DATE_FORMAT(createdAt,\'%d/%m/%Y\') AS createdAt FROM restaurants WHERE id= ?');
            $req->execute(array($id));
            return $req->fetch();
        }

        public function deleteRestaurantById($id){
            $this->deleteRestaurantPlatsByRestaurantId($id);
            $req = $this->_db->prepare('DELETE FROM restaurants WHERE id = ?');
            $req->execute(array($id));
        }

        public function deleteRestaurantPlatsByRestaurantId($id){
            $req = $this->_db->prepare('DELETE FROM plats WHERE restaurantId = ?');
            $req->execute(array($id));
        }

        public function restaurantOwnerExistWithThisPhone($phone){
            $req = $this->_db->prepare('SELECT id FROM users WHERE phone = ?');
            $req->execute(array($phone));
            if($req->rowCount() == 1){
                return $req->fetch()['id'];
            }else{
                return null;
            }
        }

        public function search($query){
            $sqlBase = "SELECT id,name,ville,quartier,ownerId,precisionAproximative,description,DATE_FORMAT(createdAt,\'%d/%m/%Y\') AS createdAt FROM restaurants";
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