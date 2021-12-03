<?php
    session_start();
    header("Content-Type: application/json; charset=utf-8");
    require_once('../panier.php');
    require_once('../plats.php');

    $panier = new Panier();
    $plat = new Plat();

    if(isset($_GET['loadPriceAndCount'])){
        $result = [
            'price' => $panier->totalPrice(),
            'count' => $panier->countPanier(),
        ];
        echo  json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    if(isset($_POST['product_id']) AND $_POST['product_id'] > 0){
        $panier->addInPanier(intval($_POST['product_id']));
        $result = [
            'success' => "Le produit a été ajouté avec succès au panier",
        ];
        echo  json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    if(isset($_POST['search'])){
        $_SESSION['searchList'] = $plat->search(htmlspecialchars($_POST['search']));
        $result = [
            "status" => true,
        ];
        echo  json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    if(isset($_POST['searchRestaurant'])){
        $_SESSION['searchRestaurant'] = $plat->search(htmlspecialchars($_POST['searchRestaurant']));
        $result = [
            "status" => true,
        ];
        echo  json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    if(isset($_POST['add'])){
        $panier->addInPanier(intval($_POST['add']));
        $result = [
            "status" => true,
        ];
        echo  json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    if(isset($_POST['minus'])){
        $panier->deleteInPanier(intval($_POST['minus']));
        $result = [
            "status" => true,
        ];
        echo  json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    if(isset($_POST['command'])){
        
        if(!isset($_SESSION['user'])){
            $result = [
                "status" => false,
            ];
        }else{
            $panier->addCommand(intval($_POST['command']));
            $result = [
                "status" => true,
            ];
        }
        
        echo  json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    if(isset($_POST['commandIdForValidation'])){
        $panier->validateCommande(intval($_POST['commandIdForValidation']));
        $result = [
            "status" => true,
        ];
        
        echo  json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    if(isset($_POST['unvalidateCommandId'])){
        $panier->unvalidateCommande(intval($_POST['unvalidateCommandId']));
        $result = [
            "status" => true,
        ];
        
        echo  json_encode($result,JSON_UNESCAPED_UNICODE);
    }

?>