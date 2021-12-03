<?php 
    session_start();
    $title = "Panier";
    $panier = 'ok';
    /*if(!isset($_SESSION["user"])){
        header("location: connexion.php");
    }*/

    require_once("../models/panier.php");
    require_once("../models/restaurant.php");

        $panier = new Panier();
        $restaurant = new Restaurant();

        if(isset($_SESSION['allRestaurants'])){
            unset($_SESSION['allRestaurants']);
            $_SESSION['allRestaurants'] = $panier->getProductsInPanier();
        }else{
            $_SESSION['allRestaurants'] = $panier->getProductsInPanier();
        }

        

    require_once("../includes/header.php");
    ?>

        <section class="page-container container">
            <div class="wrap-breadcrumb parallax-breadcrumb">
                <div class="container"></div>
            </div>
            <!-- ======= Quick view JS ========= -->
            
            <div id="account-register" class="container">
                <ul class="breadcrumb">
                    <li><a href="../../../index.php"><i class="fa fa-home"></i></a></li>
                    <li><a href="panier.php">Panier</a></li>
                </ul>
                <div class="row">
                    <aside id="column-left" class="col-sm-12 hidden-xs">
                        <div class="box">
                            <div class="box-heading">Mon Panier</div>
                            <div class="list-group">
                                <a href="commandes.php" class="list-group-item">Mes commandes </a> 
                            </div>
                        </div>
                    </aside>
                    <div id="" class="col-sm-12">
                        <?php
                            if(count($_SESSION['allRestaurants']) != 0){
                                $restos = $_SESSION['allRestaurants'];
                                ?>
                                    <h4>Voici vos produit ajoutés par restaurant,passer les commandes pour recevoire chez vous.</h4>
                                    <hr>
                                    <?php
                                        for($i = 0; $i < count($restos) ; $i++) {
                                            $resto = $restos[$i];
                                            ?>
                                                <div class="row panierRestaurantRow">
                                                    <h4 class='col-md-12 col-sm-12 col-sm-12'>
                                                        Restaurant : <span><?=$restaurant->getRestaurantById($resto['restaurantId'])['name'] ?></span>
                                                    </h4>
                                                    <?php
                                                        for($j = 0; $j < count($resto['plats']);$j++) {
                                                            $platItem = $resto['plats'][$j];
                                                            $plat = $platItem['plat'];
                                                            ?>
                                                                <div class="col-md-12 col-sm-12 col-xs-12 panierImageItem">
                                                                    <div class="col-sm-6 item">
                                                                        <img style="width:100%;height:250px" src="../../image/platImages/<?=$plat["photo"] ?>" title="<?=$plat["name"] ?>" alt="<?=$plat["name"] ?>">
                                                                    </div>
                                                                    <div class="col-sm-6 item">
                                                                        <h3><?=$plat["name"] ?></h3>
                                                                        <p><?=$plat["description"] ?></p>
                                                                        <h5><?=$plat["price"]." Fg/unité" ?></h5>
                                                                        <h5>Quantité : <?=$platItem["quantity"] ?></h5>
                                                                        <span id='<?=$plat["id"] ?>' style="font-size:20px;font-weight:bold;" class="btn btn-primary minus">-</span><span>   Quantité : <?=$platItem["quantity"] ?>   </span><span id='<?=$plat["id"] ?>' style="font-size:20px;font-weight:bold;" class="btn btn-primary add">+</span>
                                                                        <h5>Prix : <?=$platItem["totalPrice"]." Fg" ?></h5>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                        }
                                                    ?>
                                                    
                                                </div>
                                                <h4>Prix total au restaurant <?=$restaurant->getRestaurantById($resto['restaurantId'])['name'] ?> : <?=$resto["restaurantTotalPrice"]." Fg" ?></h4>
                                                <h6>Sise à : <?=$restaurant->getRestaurantById($resto['restaurantId'])['ville'];?>(<?=$restaurant->getRestaurantById($resto['restaurantId'])['quartier'];?>)</h6>
                                                <a id='<?=$i; ?>' class="btn btn-primary command" href="#">Passer la commande</a>
                                                <hr>
                                            <?php
                                        }
                                    ?>
                                    
                                <?php
                            }else{
                                ?>
                                    <h1>Votre Panier est vide.</h1>
                                    <hr>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            
        </section>

    <?php
    require_once("../includes/footer.php");
?>