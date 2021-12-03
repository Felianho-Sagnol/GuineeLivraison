<?php 
    require_once("../models/panier.php");

    $panier = new Panier();

    if(isset($_GET['product_id']) AND intval($_GET['product_id']) > 0){
        $panier->addInPanier($_GET['product_id']);
    }

    if(isset($_GET['deleteId']) AND intval($_GET['deleteId']) > 0){
        unset($_SESSION['panier'][$_GET['deleteId']]);
    }

    if(isset($_GET['modifiableId']) AND isset($_GET['quantity']) AND intval($_GET['quantity']) > 0){
        $_SESSION['panier'][$_GET['modifiableId']] = $_GET['quantity'];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="totalPrice">(<?=($panier->totalPrice() == 0) ? "0" : $panier->totalPrice()." Fg"; ?>)</div>
    <div id="count"><?=$panier->countPanier() ?></div>
</body>
</html>

    
    