<?php 
    require_once("db.php");
    require_once("plats.php");

    class Panier{
        private $_db;
        private $_plat;

        public function __construct(){
            $this->_db = (new Db())->getDb();
            
            if(!isset($_SESSION)){
                session_start();
            }
            if(!isset($_SESSION["panier"])){
                //un panier est un tableau associatif de clé l'id d'un produit et de valeur sa quanté commandée
                $_SESSION["panier"] = [];
            }
            $this->_plat = new Plat();
        }

        /**
         * Function de creation d'un panier
         * @return void
         */
        public function addInPanier($id){
            if(isset($_SESSION["panier"][$id])){
                $_SESSION["panier"][$id]++;
            }else{
                $_SESSION["panier"][$id] = 1;
            }
        }

        /**
         * function de suppression d'un panier
         *
         * @param [type] $id
         * @return void
         */
        public function deleteInPanier($id){
            if($_SESSION["panier"][$id] > 1){
                $_SESSION["panier"][$id] -= 1;
            }
            else{
                unset($_SESSION["panier"][$id]);
            }
        }

        public function deleteFromPanier($id){
            if($_SESSION["panier"][$id]){
                unset($_SESSION["panier"][$id]);
            }
        }

        public function totalPrice(){
            $total = 0;
            /**
             * articleInpanier contient tous les produits de la base données qui sont ajoutés au panier
            *on appel pour chaque produit du panier la methode getArticle(id) de l'article pour remplir 
            * le tableau articleInPanier.
             */
            $platsInPanier = [];
            foreach($_SESSION["panier"] as $key => $value){
                $platsInPanier[] = $this->_plat->getPlatById($key);
            }
            foreach($platsInPanier as $article){
                /**
                 * la variable article represente maintenant une ligne de la table artcle on
                 * on recupere donc son prix 
                 */
                $total +=  $article["price"] * $_SESSION["panier"][$article["id"]];
            }
            return $total;
        }

        public function countPanier(){
            return count($_SESSION["panier"]);
        }

        public function getPlatPriceInPanier($plat,$quatity){
            $price = 0;
            $price = $plat['price'] * $quatity;

            return $price;
        }

        public function getProductsInPanier(){
            $platsInPanier = [];
            $allRestaurants = [];
            $restaurantsId = [];

            /**
             * 1 prendre tous les plats dans le paniers
             * 2 recuperer tous les restaurants des produits dans le panier
             * 3 repartir les plats par restaurants
             * 4 calculer les frais pour chaque restaurants
             */

            //1
            foreach($_SESSION["panier"] as $key => $value){
                $plat = $this->_plat->getPlatById($key);
                
                $platItem = [
                    'plat' => $plat,
                    'quantity' => $value,
                    'totalPrice' => $this->getPlatPriceInPanier($plat,$value),
                ];

                $platsInPanier[] = $platItem;
            }

            //2
            foreach($platsInPanier as $plat){
                $restaurantId = $plat['plat']['restaurantId'];
                if(!in_array($restaurantId, $restaurantsId)) $restaurantsId[] = $restaurantId;
            }

            //3
            foreach($restaurantsId as $restaurantId){
                $plats = [];
                foreach($platsInPanier as $plat){
                    if($restaurantId == $plat['plat']['restaurantId']){
                        $plats[] = $plat;
                    }
                }

                if(!empty($plats)){
                    $restoItem['restaurantId'] = $restaurantId;
                    $restoItem['restaurantTotalPrice'] = $this->getPriceForAllPlatsInRestaurant($plats);
                    $restoItem['plats'] = $plats;
                    $allRestaurants[] = $restoItem;
                }
            }

            /**
             * la variable restaurants est un array donc
             * chaque element est un restaurant contenant le prix de tous les plats de ce restaurant,
             * les informations sur tous les plats de ce restaurant 
             * et enfin l'id du restaurant 
             * 
             */

            return $allRestaurants;
        }

        public function getPriceForAllPlatsInRestaurant($plats){
            $total = 0;
            foreach($plats as $plat){
                $total += $plat['totalPrice'];
            }

            return $total;
        }

        public function addCommand($commandId){
            $command = $_SESSION['allRestaurants'][intval($commandId)];

            $totatPrice = $command['restaurantTotalPrice'];
            $restaurantId = $command['restaurantId'];
            $ownerId = $_SESSION['user']['id'];
            $platsIdAndQuantities = "";

            $plats = $command['plats'];

            for($i = 0; $i < count($plats);$i++) {
                $platItem = $plats[$i];
                if($i == count($plats) -1){
                    $platsIdAndQuantities .= $platItem['plat']['id']."-".$platItem['quantity'];
                }else{
                    $platsIdAndQuantities .= $platItem['plat']['id']."-".$platItem['quantity']."?";
                }
            }

            $req = $this->_db->prepare('INSERT INTO commandes(ownerId,platsIdAndQuantities,restaurantId,totapPrice,createdAt) 
            VALUES(?,?,?,?,NOW())');
            $req->execute(array(
                $ownerId,$platsIdAndQuantities,$restaurantId,$totatPrice
            ));
            $req->closeCursor();

            for($i = 0; $i < count($plats);$i++) {
                $platItem = $plats[$i];

                $this->deleteFromPanier($platItem['plat']['id']);
            }

            unset($_SESSION['allRestaurants'][intval($commandId)]);
        }

        public function getCommands($ownerId){
            $req = $this->_db->prepare('SELECT id,ownerId,platsIdAndQuantities,restaurantId,state,totapPrice,DATE_FORMAT(createdAt, \'%d/%m/%Y\') AS createdAt FROM commandes WHERE ownerId = ?');
            $req->execute(array($ownerId));

            return $req->fetchAll();
        }

        public function getCommandById($id){
            $req = $this->_db->prepare('SELECT id,ownerId,platsIdAndQuantities,restaurantId,state,totapPrice,DATE_FORMAT(createdAt, \'%d/%m/%Y\') AS createdAt FROM commandes WHERE id = ?');
            $req->execute(array($id));

            return $req->fetch();
        }

        public function getCommandsForAdmin(){
            $req = $this->_db->prepare('SELECT id,ownerId,platsIdAndQuantities,restaurantId,state,totapPrice,DATE_FORMAT(createdAt, \'%d/%m/%Y\') AS createdAt FROM commandes');
            $req->execute(array());

            return $req->fetchAll();
        }

        public function getCommandsForRestaurant($restaurantId){
            $req = $this->_db->prepare('SELECT id,ownerId,platsIdAndQuantities,restaurantId,state,totapPrice,DATE_FORMAT(createdAt, \'%d/%m/%Y\') AS createdAt FROM commandes WHERE restaurantId = ?');
            $req->execute(array($restaurantId));

            return $req->fetchAll();
        }

        public function validateCommande($id){
            $req = $this->_db->prepare('UPDATE commandes SET state= 1 WHERE id=?');
            $req->execute(array($id));
        }

        public function unvalidateCommande($id){
            $req = $this->_db->prepare('UPDATE commandes SET state= 0 WHERE id=?');
            $req->execute(array($id));
        }

        public function getPlatsInfoInCommand($str){
            $data = explode('?', strval($str));
            
            $plats = [];
            foreach ($data as $d){
                $info = explode('-', $d);
                $quantity = intval($info[1]);
                $plat = $this->_plat->getPlatById(intval($info[0]));
                $plat['quantity'] = $quantity;
                $plats[] = $plat;
            }

            return $plats;
        }
        
    }
    