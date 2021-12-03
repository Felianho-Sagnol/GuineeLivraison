<?php 
    require_once("../models/panier.php");
    require_once("../models/restaurant.php");

        $panier = new Panier();
        $retaurant = new Restaurant();

        $commands = $panier->getCommandsForAdmin();
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
    <title>
        <?php 
            if(isset($title)){ echo $title; }
            else{ echo "Accueil-BP";}
        ?>
    </title>
    <base />

    <script src="../../catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="../../catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="../../catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="../../catalog/view/theme/FreshMart/stylesheet/stylesheet.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" 
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Codezeel - Start -->
    <link rel="stylesheet" type="text/css" href="../../catalog/view/javascript/jquery/magnific/magnific-popup.css" />
    <link rel="stylesheet" type="text/css" href="../../catalog/view/theme/FreshMart/stylesheet/codezeel/carousel.css" />
    <link rel="stylesheet" type="text/css" href="../../catalog/view/theme/FreshMart/stylesheet/codezeel/custom.css" />
    <link rel="stylesheet" type="text/css" href="../../catalog/view/theme/FreshMart/stylesheet/codezeel/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../../catalog/view/theme/FreshMart/stylesheet/codezeel/lightbox.css" />
    <link rel="stylesheet" type="text/css" href="../../catalog/view/theme/FreshMart/stylesheet/codezeel/animate.css" />

    <link rel="stylesheet" type="text/css" href="../../css/guineeLivraison.css" />

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


<body class="account-register layout-2 left-col">
    <header>
        <div class="header-container">
            <div class="row">
                <div class="header-main">
                    <div class="page-container container">
                    <div class="header-top">
                            <div class="container">
                                <div class="header-logo ">
                                    <div id="logo">
                                        <a href=""><h1 style="font-size:30px" class="logo-title">Guinée Livraison</h1></a>
                                    </div>
                                </div>
                                <div class="dropdown myaccount">
                                    
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"></a>
                                    <ul class="dropdown-menu dropdown-menu-right myaccount-menu">
                                        <li><h3 class="mt-2 text-center">Mon Compte</h3></li> 
                                        <hr>
                                        <li><a href="../../php/views/deconnexion.php">Deconnexion <span class="connected">(connecté)</span></a></li>
                                        <li><a href="../../php/views/compte.php" title="Checkout">Mes informations</a></li>                                            
                                    </ul>
                                </div>
                                <div id="search" class="input-group">
                                    <span class="search_button"></span>
                                    <div class="search_toggle">
                                        <div id="searchbox">
                                            <input type="text" name="search" value="" placeholder="Rechercher un produit sur Guinée Livraison" class="form-control input-lg" />
                                            <span class="input-group-btn">
			                                <button type="button" class="btn btn-default btn-lg">Rechercher<i class="fa fa-search"></i></button>
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
                                    <div class="box-heading aaa" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="categorymenu-dropdown">Actions<span class="dropdown-arrow"></span></div>
                                    <div class="box-content categorymenu_block dropdown-menu" aria-labelledby="verticalmenu-dropdown">
                                        <ul id="nav-one" class="dropmenu">
                                            <li class="top_level dropdown main"><a href="#">Utilisateurs</a>
                                                <div class="dropdown-menu megamenu column1">
                                                    <div class="dropdown-inner">
                                                        <ul class="list-unstyled childs_1">
                                                            <li><a  href="viewAllUsers.php">voir tous les utilisateurs</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="top_level dropdown main"><a href="#">Restaurants</a>
                                                <div class="dropdown-menu megamenu column1">
                                                    <div class="dropdown-inner">
                                                        <ul class="list-unstyled childs_1">
                                                            <li><a  href="createRestaurant.php">Ajouter un restaurant</a></li>
                                                            <li><a  href="viewAllRestaurants.php">voir tous les restaurants</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="top_level dropdown main"><a href="#">Administeurs</a>
                                                <div class="dropdown-menu megamenu column1">
                                                    <div class="dropdown-inner">
                                                        <ul class="list-unstyled childs_1">
                                                            <li><a  href="viewAllAdmins.php">voir tous les administrateurs</a></li>
                                                            <li><a href="addAdmin.php">Ajouter un administrateur</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="top_level dropdown main"><a href="#">Commandes</a>
                                                <div class="dropdown-menu megamenu column1">
                                                    <div class="dropdown-inner">
                                                        <ul class="list-unstyled childs_1">
                                                            <li><a href="allsCommandes.php">Voir les commandes</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- <li class="top_level main"><a href="#">Clementine</a></li> -->
                                        </ul>
                                    </div>
                                </div>
                                <nav class="nav-container" role="navigation">
                                <div class="nav-inner">
                                        <!-- ======= Menu Code START ========= -->
                                        <!-- Opencart 3 level Category Menu-->
                                        <div id="menu" class="main-menu">
                                            <ul class="nav navbar-nav">
                                                <li class="top_level"><a href="index.php"><i class="fa fa-home"></i></a></li>
                                                <li class="top_level"><a href="../../../index.php">Voir le site</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--  =============================================== Mobile menu start  =============================================  -->
                                    <div id="res-menu" class="main-menu nav-container1">
                                        <div class="nav-responsive"><span>Menu</span>
                                            <div class="expandable"></div>
                                        </div>
                                        <ul class="main-navigation">
                                            <li class="top_level dropdown"><a href="#">Utilisateurs</a>
                                                <ul>
                                                    <li><a href="viewAllUsers.php">Voir tous les utilisateurs</a></li>
                                                    <li><a href="addAdmin.php">Ajouter un administrateur</a></li>
                                                </ul>
                                            </li>
                                            <li class="top_level dropdown"><a href="#">Restaurants</a>
                                                <ul>
                                                    <li><a  href="createRestaurant.php">Ajouter un restaurant</a></li>
                                                    <li><a  href="viewAllRestaurants.php">voir tous les restaurants</a></li>
                                                </ul>
                                            </li>
                                            <li class="top_level dropdown"><a href="#">Administeurs</a>
                                                <ul>
                                                    <li><a href="viewAllAdmins.php">Voir tous les administrateurs</a></li>
                                                    <li><a href="addAdmin.php">Ajouter un administrateur</a></li>
                                                </ul>
                                            </li>
                                            <li class="top_level dropdown"><a href="#">Commandes</a>
                                                <ul>
                                                    <li><a href="allsCommandes.php">Voir les commandes</a></li>
                                                </ul>
                                            </li>
                                            <li class="top_level"><a href="index.php">Accueil de l'administration</a></li>
                                            <li class="top_level"><a href="../../../index.php">Voir le site</a></li>
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