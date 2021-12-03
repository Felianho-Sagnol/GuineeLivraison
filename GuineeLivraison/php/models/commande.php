<?php 
    require_once("db.php");
    require_once("panier.php");

    class Commande{
        private $_db;
        private $_panier;

        public function __construct(){
            $this->_db = (new Db())->getDb();
            $this->_panier = new Panier();;
        }

        public function addCommande(){
            if(isset($_GET['addCommande']) AND isset($_SESSION['panier'])){
                if(!empty($_SESSION['panier'])){
                    $id_quntities = '';
                    foreach($_SESSION['panier'] as $key => $value){
                        $id_quntities .= $key.'-'.$value.'?';
                    }
                    $totalPrice = $this->_panier->totalPrice();
                }
            }
        }
    }