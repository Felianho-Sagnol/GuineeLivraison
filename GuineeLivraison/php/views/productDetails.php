<?php 
    session_start();
    $title = "Details";
    $panier = 'ok';
    /*if(!isset($_SESSION["user"])){
        header("location: connexion.php");
    }*/

    require_once("../models/plats.php");
    require_once("../models/restaurant.php");

        $plat = new Plat();
        $restaurant = new Restaurant();

    if(isset($_GET['product_id']) AND $_GET['product_id'] > 0){
        $curentPlat = $plat->getPlatById($_GET['product_id']);
    }else{
        header('location: ../../../index.php');
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
                    <li><a href="panier.php">Détails</a></li>
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
                        <hr>
                        <?php
                            if(count($curentPlat) != 0){
                                ?>
                                    <div class="row panierRestaurantRow">
                                        <div class="col-md-12 panierImageItem">
                                            <div class="col-sm-6 item">
                                                <img style="width:100%;height:300px" src="../../image/platImages/<?=$curentPlat["photo"] ?>" title="<?=$curentPlat["name"] ?>" alt="<?=$curentPlat["name"] ?>">
                                            </div>
                                            <div class="col-sm-6 item">
                                                <h3><?=$curentPlat["name"] ?></h3>
                                                <p><?=$curentPlat["description"] ?></p>
                                                <h5><?=$curentPlat["price"]." Fg" ?></h5>
                                                <h5>Restaurant : <span><?=$restaurant->getRestaurantById($curentPlat['restaurantId'])['name'] ?></span></h5>
                                                <h6>Sise à : <?=$restaurant->getRestaurantById($curentPlat['restaurantId'])['ville'];?>(<?=$restaurant->getRestaurantById($curentPlat['restaurantId'])['quartier'];?>)</h6>
                                                <button type="button" class="btn btn-primary addProduct" id="<?=$curentPlat['id'];?>"><span><i class="panier fas fa-cart-plus"></i></span></button>
                                            </div>
                                        </div>
                                    </div>
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