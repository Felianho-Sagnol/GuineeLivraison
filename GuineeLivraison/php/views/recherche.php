<?php 
    session_start();
    $title = "Recherche";

    require_once('../models/plats.php');
        $plat = new Plat();


    if(isset($_SESSION['searchList'])){
        $plats = $_SESSION['searchList'];

    }else{
        $plats = [];
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
                    <li><a href="Recherche.php">Recherche de plats</a></li>
                </ul>
            </div>
        </section>
        <?php
            if(isset($plats)){
                ?>
                    <section class="page-container container " id="presentation">
                        <div id="account-register" class="container">
                            <div class="row">
                                <?php 
                                    if(count($plats) == 0) {
                                        ?>
                                            <h3>Aucun resultat pour votre recherche</h3>
                                            <hr>
                                        <?php
                                    }else{
                                        ?>
                                            <h4>Voici le resultat de votre recherce , commandez et nous vous livrons chez vous.</h4>
                                            <hr>
                                            <div class="row">
                                                <?php
                                                    foreach ($plats as $platItem){
                                                        ?>
                                                            <div class="col-sm-6 col-xs-6 col-md-4 cardItem">
                                                                <div class="card" style="width: 100%;">
                                                                    <a href="productDetails.php?product_id=<?=$platItem["id"] ?>"><img style="width:100%;height:200px" class="card-img-top" src="../../image/platImages/<?=$platItem["photo"] ?>" title="<?=$platItem["name"] ?>" alt="<?=$platItem["name"] ?>"></a>
                                                                    <div class="card-body">
                                                                        <h4><a href="productDetails.php?product_id=<?=$platItem["id"] ?>"><?=$platItem["name"] ?></a></h4>
                                                                        <a  class='content' href="restaurantContent.php?id=<?=$plat->getRestaurantByIdForPlat($platItem["restaurantId"])['id'];?>"><h5 style="color:orange">Restaurant : <?=$plat->getRestaurantByIdForPlat($platItem["restaurantId"])['name'] ?></h5></a>
                                                                        <h6>Sise à : <?=$plat->getRestaurantByIdForPlat($platItem["restaurantId"])['ville'];?>(<?=$plat->getRestaurantByIdForPlat($platItem["restaurantId"])['quartier'];?>)</h6>
                                                                        <p class="card-text"><?=$plat->getPlatDescriptionSubString($platItem["description"]) ?></p>
                                                                        <p class="price">
                                                                            <?=$platItem["price"] ?> Fg
                                                                        </p>
                                                                        <button type="button" class="btn btn-primary addProduct" id="<?=$platItem['id'];?>"><span><i class="panier fas fa-cart-plus"></i></span></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        <?php
                                    }
                                ?>
                                
                            </div>
                        </div>
                    </section>
                <?php
            }
        ?>
        
    <?php

    require_once("../includes/footer.php");
?>