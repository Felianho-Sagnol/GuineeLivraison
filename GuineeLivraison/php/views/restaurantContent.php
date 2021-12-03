<?php 
    session_start();
    $title = "Contenu de restaurant";
    
    require_once("../models/restaurant.php");
    require_once("../models/user.php");
    require_once("../models/plats.php");

        $restaurant = new Restaurant();
        $user = new User();
        $plat = new Plat();



    if(isset($_GET['id']) AND $_GET['id'] >= 1){
        if(isset($_SESSION['currentRestaurantId'])) unset($_SESSION['currentRestaurantId']);
        $_SESSION['currentRestaurantId'] = intval($_GET['id']);
    }

    if(!isset($_SESSION['currentRestaurantId'])){
        header("location: ../../../index.php");
    }

    $currentRestaurant = $restaurant->getRestaurantById($_SESSION['currentRestaurantId']);

    if(isset($_SESSION['currentRestaurant'])) unset($_SESSION['currentRestaurant']);
    $_SESSION['currentRestaurant'] = $currentRestaurant;
    
    $restaurantName = $currentRestaurant['name'];
    $title = "Restaurant ".$restaurantName;


    $owner = $user->getUserById($currentRestaurant['ownerId']);

    if(isset($_GET['action'])){
        if(isset($_SESSION['action'])) unset($_SESSION['action']);
        $_SESSION['action'] = $_GET['action'];
    }else{
        $_SESSION['action'] = 'plats';
    }

    require_once("../includes/restaurantHeader.php");

    ?>  
        <?php
            if(isset($_SESSION['action']) AND $_SESSION['action']=='plats'){
                $plats = $plat->getAllPlatsByRestaurantId($_SESSION['currentRestaurant']['id']);
                ?>
                    <section class="page-container container " id="presentation">
                        <div id="account-register" class="container">
                            <div class="row">
                                <?php 
                                    if(count($plats) == 0) {
                                        ?>
                                            <h4>Aucun plat en liste pour ce restaurant pour l'instant.</h4>
                                            <hr>
                                        <?php
                                    }else{
                                        ?>
                                            <h4>Voici nos plats en liste , commandez et nous vous livrons chez vous.</h4>
                                            <hr>
                                            <div class="row">
                                                <?php
                                                    foreach ($plats as $platItem){
                                                        ?>
                                                            <div class="col-sm-6 col-xs-6 col-md-4 cardItem">
                                                                <div class="card" style="width: 100%;">
                                                                    <a href="productDetails.php?product_id=<?=$platItem["id"] ?>"><img style="width:100%;height:200px" class="card-img-top" src="../../image/platImages/<?=$platItem["photo"] ?>" title="<?=$platItem["name"] ?>" alt="<?=$platItem["name"] ?>"></a>
                                                                    <div class="card-body">
                                                                        <h4><a href="productDetails.php?product_id=<?=$platItem["id"] ?>"><?=$platItem["name"] ?>.</a></h4>
                                                                        <p class="card-text"><?=$plat->getPlatDescriptionSubString($platItem["description"]) ?>.</p>
                                                                        <h5>Sise à : <?=$plat->getRestaurantByIdForPlat($platItem["restaurantId"])['ville'];?>(<?=$plat->getRestaurantByIdForPlat($platItem["restaurantId"])['quartier'];?>)</h5>
                                                                        <p class="price">
                                                                            <?=$platItem["price"] ?> Fg.
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
            if(isset($_SESSION['action']) AND $_SESSION['action']=='presentation'){
                ?>
                    <section class="page-container container " id="presentation">
                        <div id="account-register" class="container">
                            <div class="row">
                                <div id="" class="col-md-3"></div>
                                <div id="" class="col-md-8">
                                    <h2 class='name'><u>Restaurant : <?=$restaurantName;?></u></h2>
                                    <p class='desc'>
                                        <span class='precision'>Ville de placement du restaurant  : </span> <br> <?=$currentRestaurant['ville'];?>.
                                    </p>
                                    <p class='desc'>
                                        <span class='precision'>Quartier dans la ville <?=$currentRestaurant['ville'];?> : </span> <br> <?=$currentRestaurant['quartier'];?>.
                                    </p>
                                    <p class='desc'>
                                        <span class='precision'>Précision sur le lieur : </span> <br> <?=($currentRestaurant['precisionAproximative']==null) ? 'Pas de précision sur la localisation de ce restaurant.':$currentRestaurant['precisionAproximative'];?>
                                    </p>
                                    <p class='desc'>
                                        <span class='precision'>Contacts : </span> <br> <?="Appelez nous pour plus d'informations sur le : ".$owner['phone'];?>.
                                    </p>
                                    <p class='desc'>
                                        <span class='precision'>Description du restaurant : </span> <br> <?=($currentRestaurant['description']==null) ? 'Pas de description pour ce restaurant.':$currentRestaurant['description'];?>.
                                    </p>
                                </div>
                                <div id="" class="col-md-1"></div>
                            </div>
                        </div>
                    </section>
                <?php
            }
        ?>
        
    <?php
    require_once("../includes/footer.php");
?>