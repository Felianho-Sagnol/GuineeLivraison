<?php 
    session_start();
    $title = "Administration";

    require_once("../models/user.php");
        $user = new User();
    if(isset($_SESSION["user"])){
        $current_user = $user->getUserById($_SESSION["user"]['id']);
        if($current_user != null) $_SESSION["user"] = $current_user;
    }

    if(!isset($_SESSION["user"]) ){
        header("Location: ../views/connexion.php");
    }else{
        if($_SESSION["user"]["id"] != $_SESSION['currentRestaurant']['ownerId']){
            header("Location: ../views/restaurantContent.php");
        }
    }

    require_once("restaurantAdminHeader.php");
    ?>
        <div class="container ">
            <div class="adminIndex">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <h2 class="row text-center"><u>Administration de <?=$_SESSION['currentRestaurant']['name'];?></u></h2>
                        <div class="row">
                            <h4>Ici vous pouvez faire toutes les actions d'administration de votre restaurant</h4>
                        </div>
                        <div class="row">
                            <h4>En clicquant sur le bouton ACTIONS en haut, à gauche , toutes fonctionnalités disponibles 
                                s'afficheront pour vour permettre de mieux gerer le contenu de votre restaurant.
                            </h4>
                        </div>
                        <div class="row">
                            <h5>Pour voir le contenu du restaurant vous pouvez aller ici : <a class="viewsite" href="../views/restaurantContent.php?id=<?=$_SESSION['currentRestaurant']['id'];?>">voir le contenu.</a></h5>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    <?php 
    require_once("restaurantAdminFooter.php");
?>