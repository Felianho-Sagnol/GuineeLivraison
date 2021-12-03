<?php
    require_once("../models/user.php");
    require_once("../models/restaurant.php");

        $user = new User();

        $restaurant = new Restaurant();
        $restaurants = $restaurant->getAllRestaurants();

    if(isset($_SESSION["user"])){
        $current_user = $user->getUserById($_SESSION["user"]['id']);
        if($current_user != null) $_SESSION["user"] = $current_user;
    }


       
?>

<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" lang="en">
<!--<![endif]-->

<!-- Mirrored from capricathemes.com/opencart/OPC08/OPC080181/index.php?route=account/register by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 26 Jun 2020 20:36:49 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Livraison de produit de restauration sur commande."/>
    <meta name="keywords" content="Guinée Livraison,Livraison,Restaurent"/>
    <title>
        <?php 
            if(isset($title)){ echo $title; }
            else{ echo "Guinée Livraison"; }
        ?>
    </title>
    <base />

    <script src="../../catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="../../catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="../../catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="../../catalog/view/theme/FreshMart/stylesheet/stylesheet.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


    <!-- Codezeel - Start -->
    <link rel="stylesheet" type="text/css" href="../../catalog/view/javascript/jquery/magnific/magnific-popup.css" />
    <link rel="stylesheet" type="text/css" href="../../catalog/view/theme/FreshMart/stylesheet/codezeel/carousel.css" />
    <link rel="stylesheet" type="text/css" href="../../catalog/view/theme/FreshMart/stylesheet/codezeel/custom.css" />
    <link rel="stylesheet" type="text/css" href="../../catalog/view/theme/FreshMart/stylesheet/codezeel/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../../catalog/view/theme/FreshMart/stylesheet/codezeel/lightbox.css" />
    <link rel="stylesheet" type="text/css" href="../../catalog/view/theme/FreshMart/stylesheet/codezeel/animate.css" />

    <link rel="stylesheet" type="text/css" href="../../css/guineeLivraison.css" />
    <link rel="stylesheet" type="text/css" href="../../css/restaurantContent.css" />


    <link href="style.html" type="text/css" rel="style.rel" media="style.media" />

    
    <link href="../../catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
    <script src="../../catalog/view/javascript/jquery/datetimepicker/moment/moment.min.js" type="text/javascript"></script>
    <script src="../../catalog/view/javascript/jquery/datetimepicker/moment/moment-with-locales.min.js" type="text/javascript"></script>
    <script src="../../catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

    <!--<link href="../../image/imagesBP/logoBPro.png" rel="icon"/>-->

    <!-- Codezeel - Start -->
    <script type="text/javascript" src="../../catalog/view/javascript/codezeel/custom.js"></script>
    <script type="text/javascript" src="../../catalog/view/javascript/codezeel/jstree.min.js"></script>
    <script type="text/javascript" src="../../catalog/view/javascript/codezeel/carousel.min.js"></script>
    <script type="text/javascript" src="../../catalog/view/javascript/codezeel/codezeel.min.js"></script>
    <script type="text/javascript" src="../../catalog/view/javascript/codezeel/jquery.custom.min.js"></script>
    <script type="text/javascript" src="../../catalog/view/javascript/codezeel/jquery.formalize.min.js"></script>
    <script type="text/javascript" src="../../catalog/view/javascript/lightbox/lightbox-2.6.min.js"></script>
    <script type="text/javascript" src="../../catalog/view/javascript/codezeel/tabs.js"></script>
    <script type="text/javascript" src="../../catalog/view/javascript/codezeel/jquery.elevatezoom.min.js"></script>
    <script type="text/javascript" src="../../catalog/view/javascript/codezeel/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="../../catalog/view/javascript/codezeel/doubletaptogo.js"></script>
    <script type="text/javascript" src="../../catalog/view/javascript/codezeel/parallax.js"></script>
    <script type="text/javascript" src="../../catalog/view/javascript/codezeel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="../../catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="../../catalog/view/javascript/jquery.countdown.min.js"></script>
    <!-- Codezeel - End -->

    <script src="../../catalog/view/javascript/common.js" type="text/javascript"></script>
</head>

<script>
    /*$(function() {
        $("#cart-total").load('ajoutAuPanier.php #totalPrice');
        $("#cart-quantity").load('ajoutAuPanier.php #count');
    })*/
</script>
<body class="account-register layout-2 left-col">
    <header>
        <div class="header-container">
            <div class="row">
                <div class="header-main">
                    <div class="page-container container">
                    <div class="header-top">
                            <div class="container">
                                <div class="header-logo">
                                    <div id="logo">
                                        <a href=""><h1 class="logo-title"><?=$restaurantName;?></h1></a>
                                    </div>
                                </div>
                                <div class="header-cart">
                                    <div id="cart" class="btn-group btn-block">
                                        <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="btn btn-inverse btn-block btn-lg dropdown-toggle">
                                            <a href="../views/panier.php"><i class="fa fa-shopping-cart"></i></a>
                                            <span id="cart-total">(0.00 Fg)</span> 
                                            <span id="cart-quantity">0</span>
                                        </button>
                                        <a href="../views/panier.php"><span class="cart_heading" data-toggle="dropdown">Votre Panier</span></a>
                                        <ul class="dropdown-menu pull-right cart-menu">
                                            <li>
                                                <p class="text-center voir_panier_text"><a href="../views/panier.php">Voir le panier</a></p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="dropdown myaccount">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"></a>
                                    <ul class="dropdown-menu dropdown-menu-right myaccount-menu">
                                        <li><h3 class="mt-2 text-center">Mon Compte</h3></li> 
                                        <hr>
                                        <?php
                                            if(!isset($_SESSION["user"])){
                                                ?>
                                                    <li><a href="../../php/views/inscription.php">S'inscrire</a></li>
                                                    <li><a href="../../php/views/connexion.php">Se Connecter</a></li>
                                                <?php
                                            }
                                        ?>
                                        <li><a href="../../php/views/panier.php">Mon Panier</a></li>
                                        <?php
                                            if(isset($_SESSION["user"])){
                                                ?>
                                                    <li><a href="../../php/views/compte.php">Mes informations</a></li>
                                                    <li><a href="../../php/views/deconnexion.php">Deconnexion <span class="connected">(connecté)</span> </a></li>
                                                <?php
                                                if(isset($_SESSION["user"]) AND $_SESSION["user"]["id"] == $currentRestaurant['ownerId']){
                                                    ?>
                                                        <li><a href="../restaurantAdmin/index.php?" title="">Gérér le restaurant</a></li>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                                <div id="search" class="input-group">
                                    <span class="search_button"></span>
                                    <div class="search_toggle">
                                        <div id="searchbox">
                                            <input id='searchInput' type="text" name="search" value="" placeholder="Rechercher un plât dans notre restaurant" class="form-control input-lg" />
                                            <span class="input-group-btn">
			                                <button id='searchBtn' type="button" class="btn btn-default btn-lg">Rechercher<i class="fa fa-search"></i></button>
			                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-container container">
                        <div class="header-bottom">
                            <div class="container">
                                <div id="verticalmenublock" class="box category box-category ">
                                    <div class="box-heading" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="categorymenu-dropdown">Nos Restaurents<span class="dropdown-arrow"></span></div>
                                    <div class="box-content categorymenu_block dropdown-menu" aria-labelledby="verticalmenu-dropdown">
                                        <ul id="nav-one" class="dropmenu">
                                            <?php
                                                if(count($restaurants) != 0){
                                                    foreach($restaurants as $resto){
                                                        ?>
                                                            <li class="top_level main"><a href="../views/restaurantContent.php?id=<?=$resto['id'];?>"><?=$resto['name']." (".$resto['ville'].")";?></a></li>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </ul>    
                                    </div>
                                </div>
                                <nav class="nav-container" role="navigation">
                                <div class="nav-inner">
                                        <!-- ======= Menu Code START ========= -->
                                        <!-- Opencart 3 level Category Menu-->
                                        <div id="menu" class="main-menu">
                                            <ul class="nav navbar-nav">
                                                <li class="top_level"><a href="../../../index.php"><i class="fa fa-home"></i></a></li>
                                                <li class="top_level"> <a href="../views/restaurantContent.php?action=plats">Nos Plâts </a></li>
                                                <li class="top_level"><a href="../views/restaurantContent.php?action=presentation">Présentation</a></li>
                                                <li class="top_level"> <a href="../views/panier.php">Votre Panier</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--  =============================================== Mobile menu start  =============================================  -->
                                    <div id="res-menu" class="main-menu nav-container1">
                                        <div class="nav-responsive"><span>Menu</span>
                                            <div class="expandable"></div>
                                        </div>
                                        <ul class="main-navigation">
                                            <li class="top_level"><a href="../views/restaurantContent.php?action=plats">Nos plâts</a></li>
                                            <li class="top_level"><a href="../views/restaurantContent.php?action=presentation">Presentation</a></li>
                                            <li class="top_level"><a href="../views/panier.php">Panier</a></li>
                                            <li class="top_level"><a href="../../../index.php">Accueil</a></li>
                                            
                                            <?php
                                                if(count($restaurants) != 0){
                                                    ?>
                                                        <li class="top_level dropdown"><a href="#">Restaurants</a>
                                                            <?php
                                                                foreach($restaurants as $resto){
                                                                    ?>
                                                                        <ul>
                                                                            <li class="top_level main"><a href="../views/restaurantContent.php?id=<?=$resto['id'];?>"><?=$resto['name']." (".$resto['ville'].")";?></a></li>
                                                                        </ul>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </li>
                                                    <?php
                                                }
                                            ?>
                                            
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>