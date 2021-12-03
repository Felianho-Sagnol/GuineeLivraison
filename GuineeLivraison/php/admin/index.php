<?php 
    session_start();
    $title = "Administration";

    require_once("../models/user.php");
        $user = new User();
    if(isset($_SESSION["user"])){
        $current_user = $user->getUser($_SESSION["user"]['id']);
        if($current_user != null) $_SESSION["user"] = $current_user;
    }

    if(!isset($_SESSION["user"]) ){
        header("Location: ../views/connexion.php?want_connect_has_admin=yes");
    }else{
        if($_SESSION["user"]["isAdmin"] != 1){
            header("Location: ../views/connexion.php?want_connect_has_admin=yes");
        }
    }


    require_once("adminheader.php");
    ?>
        <div class="container ">
            <div class="adminIndex">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <h1 class="row text-center"><u>Administration Guinée Livraison</u></h1>
                        <div class="row">
                            <h3>Ici vous pouvez faire toutes les actions d'administration de Guinée Livraison</h3>
                        </div>
                        <div class="row">
                            <h3>En clicquant sur le bouton ACTIONS en haut, à gauche , toutes fonctionnalités disponibles 
                                s'afficheront pour vour permettre de mieux gerer votre site.
                            </h3>
                        </div>
                        <div class="row">
                            <h4>Pour voire le contenu du site vous pouvez aller ici : <a class="viewsite" href="../../../index.php">Voir le site.</a></h4>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    <?php 
    require_once("adminfooter.php");
?>