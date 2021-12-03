<?php
    //website pass (DDWPqa36pqi$Mr&OICx
    /*class Db {
        public function getDb(){
            try
            {
                $bdd = new PDO('mysql:host=localhost;dbname=id17499796_guineelivraison;charset=utf8','id17499796_glivraison', '|OsL@c4|O~}7?2TC');
            }
            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }
            return $bdd;
        }
    }*/

    //local db info 
    class Db {
        public function getDb(){
            try
            {
                $bdd = new PDO('mysql:host=localhost;dbname=guineelivraison;charset=utf8', 'root', '');
            }
            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }
            return $bdd;
        }
    }
?>