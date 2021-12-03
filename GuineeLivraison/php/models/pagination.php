<?php 
    require_once("db.php");
    require_once("functions.php");
    require_once("user.php");

    $user = new User();

    class Paginator {
        protected $_db;

        public function __construct(){
            $this->_db = new Db();
        }

        
    }