<?php
    session_start();

    /*wU@gy$B!(veZfqcRvbRB web*/

    require_once("GuineeLivraison/php/models/user.php");
    require_once("GuineeLivraison/php/models/restaurant.php");
    require_once("GuineeLivraison/php/models/plats.php");


        $user = new User();

        $restaurant = new Restaurant();
        $restaurants = $restaurant->getAllRestaurants();

        $plat = new Plat();
        $plats = $plat->getTwoPlatsForEveryRestaurants();

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
<html dir="ltr" lang="fr">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Guinée-Livraison</title>
    <base />
    <meta name="description" content="Livraison de produit de restauration sur commande."/>
    <meta name="keywords" content="Guinée Livraison,Livraison,Restaurent"/>
    <link rel="stylesheet" href="GuineeLivraison/css/guineeLivraison.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" 
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" 
        crossorigin="anonymous">
    <script src="GuineeLivraison/catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="GuineeLivraison/catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="GuineeLivraison/catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="GuineeLivraison/catalog/view/theme/FreshMart/stylesheet/stylesheet.css" rel="stylesheet" />

    <!-- Codezeel - Start -->
    <link rel="stylesheet" type="text/css" href="GuineeLivraison/catalog/view/javascript/jquery/magnific/magnific-popup.css" />
    <link rel="stylesheet" type="text/css" href="GuineeLivraison/catalog/view/theme/FreshMart/stylesheet/codezeel/carousel.css" />
    <link rel="stylesheet" type="text/css" href="GuineeLivraison/catalog/view/theme/FreshMart/stylesheet/codezeel/custom.css" />
    <link rel="stylesheet" type="text/css" href="GuineeLivraison/catalog/view/theme/FreshMart/stylesheet/codezeel/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="GuineeLivraison/catalog/view/theme/FreshMart/stylesheet/codezeel/lightbox.css" />
    <link rel="stylesheet" type="text/css" href="GuineeLivraison/catalog/view/theme/FreshMart/stylesheet/codezeel/animate.css" />

    <link href="style.html" type="text/css" rel="style.rel" media="style.media" />
    <link href="style.html" type="text/css" rel="style.rel" media="style.media" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="GuineeLivraison/catalog/view/javascript/jquery/swiper/css/swiper.min.css" type="text/css" rel="stylesheet" media="screen" />
    <link href="GuineeLivraison/.css" type="text/css"/>
    <link href="GuineeLivraison/catalog/view/javascript/jquery/swiper/css/opencart.css" type="text/css" rel="stylesheet" media="screen" />
    <script src="GuineeLivraison/catalog/view/javascript/jquery/swiper/js/swiper.jquery.js" type="text/javascript"></script>

    <!-- <link href="GuineeLivraison/image/imagesGuineeLivraison/logoBPro.png" rel="icon"/>-->
    <!-- Codezeel - Start -->
    <script type="text/javascript" src="GuineeLivraison/catalog/view/javascript/codezeel/custom.js"></script>
    <script type="text/javascript" src="GuineeLivraison/catalog/view/javascript/codezeel/jstree.min.js"></script>
    <script type="text/javascript" src="GuineeLivraison/catalog/view/javascript/codezeel/carousel.min.js"></script>
    <script type="text/javascript" src="GuineeLivraison/catalog/view/javascript/codezeel/codezeel.min.js"></script>
    <script type="text/javascript" src="GuineeLivraison/catalog/view/javascript/codezeel/jquery.custom.min.js"></script>
    <script type="text/javascript" src="GuineeLivraison/catalog/view/javascript/codezeel/jquery.formalize.min.js"></script>
    <script type="text/javascript" src="GuineeLivraison/catalog/view/javascript/lightbox/lightbox-2.6.min.js"></script>
    <script type="text/javascript" src="GuineeLivraison/catalog/view/javascript/codezeel/tabs.js"></script>
    <script type="text/javascript" src="GuineeLivraison/catalog/view/javascript/codezeel/jquery.elevatezoom.min.js"></script>
    <script type="text/javascript" src="GuineeLivraison/catalog/view/javascript/codezeel/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="GuineeLivraison/catalog/view/javascript/codezeel/doubletaptogo.js"></script>
    <script type="text/javascript" src="GuineeLivraison/catalog/view/javascript/codezeel/parallax.js"></script>
    <script type="text/javascript" src="GuineeLivraison/catalog/view/javascript/codezeel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="GuineeLivraison/catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="GuineeLivraison/catalog/view/javascript/jquery.countdown.min.js"></script>
    <!-- Codezeel - End -->
    <script src="GuineeLivraison/catalog/view/javascript/common.js" type="text/javascript"></script>

</head>
<body class="common-home layout-1">
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
                                <div class="header-cart">
                                    <div id="cart" class="btn-group btn-block">
                                        <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="btn btn-inverse btn-block btn-lg dropdown-toggle">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span id="cart-total">(0.00 fr)</span> 
                                            <span id="cart-quantity">0</span>
                                        </button>
                                        <span class="cart_heading" data-toggle="dropdown">Votre Panier</span>
                                        <ul class="dropdown-menu pull-right cart-menu">
                                            <li>
                                                <p class="text-center voir_panier_text"><a href="GuineeLivraison/php/views/panier.php">Voir le panier</a></p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="dropdown myaccount">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"></a>
                                    <ul class="dropdown-menu dropdown-menu-right myaccount-menu">
                                        <li><h3 class="mt-3 text-center">Mon Compte</h3></li> 
                                        <hr>
                                        <?php
                                            if(!isset($_SESSION["user"])){
                                                ?>
                                                    <li><a href="GuineeLivraison/php/views/inscription.php">S'incrire</a></li>
                                                    <li><a href="GuineeLivraison/php/views/connexion.php?nextPage=home">Se Connecter</a></li>
                                                <?php
                                            }
                                        ?>
                                        <li><a href="GuineeLivraison/php/views/panier.php">Mon Panier</a></li>
                                        <?php
                                            if(isset($_SESSION["user"])){
                                                ?>
                                                    <li><a href="GuineeLivraison/php/views/compte.php">Mes informations</a></li>
                                                    <li><a href="GuineeLivraison/php/views/deconnexion.php">Deconnexion <span class="connected">(connecté)</span> </a></li>
                                                <?php
                                                if($_SESSION["user"]["isAdmin"] == 1){
                                                    ?>
                                                        <li><a href="GuineeLivraison/php/admin/index.php" title="">Administration</a></li>
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
                                            <input id='searchInputRestoBTN' type="text" name="search" value="" placeholder="Rechercher un restaurant sur Guinée Livraison" class="form-control input-lg" />
                                            <span class="input-group-btn">
			                                <button type="button" id='searchListRestoBTN' class="btn btn-default btn-lg searchListRestoBTN">Rechercher<i class="fa fa-search"></i></button>
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
                                <div id="verticalmenublock" class="box category box-category  open ">
                                    <div class="box-heading" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="categorymenu-dropdown">Nos restaurents<span class="dropdown-arrow"></span></div>
                                    <div class="box-content categorymenu_block dropdown-menu" aria-labelledby="verticalmenu-dropdown">
                                        <ul id="nav-one" class="dropmenu">
                                            <?php
                                                if(count($restaurants) != 0){
                                                    foreach($restaurants as $resto){
                                                        ?>
                                                            <li class="top_level main"><a href="GuineeLivraison/php/views/restaurantContent.php?id=<?=$resto['id'];?>"><?=$resto['name']." (".$resto['ville'].")";?></a></li>
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
                                                <li class="top_level"><a href="./index.php"><i class="fa fa-home"></i></a></li>
                                                <li class="top_level"><a href="GuineeLivraison/php/views/contact.php">Contact</a></li>
                                                <li class="top_level"> <a href="GuineeLivraison/php/views/bog.php">Blogs </a></li>
                                                <li class="top_level"> <a href="GuineeLivraison/php/views/panier.php">Panier </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--  =============================================== Mobile menu start  =============================================  -->
                                    <div id="res-menu" class="main-menu nav-container1">
                                        <div class="nav-responsive"><span>Menu</span>
                                            <div class="expandable"></div>
                                        </div>
                                        <ul class="main-navigation">
                                            <?php
                                                if(count($restaurants) != 0){
                                                    ?>
                                                        <li class="top_level dropdown"><a href="#">Restaurants</a>
                                                            <?php
                                                                foreach($restaurants as $resto){
                                                                    ?>
                                                                        <ul>
                                                                            <li class="top_level main"><a href="GuineeLivraison/php/views/restaurantContent.php?id=<?=$resto['id'];?>"><?=$resto['name']." (".$resto['ville'].")";?></a></li>
                                                                        </ul>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </li>
                                                    <?php
                                                }
                                            ?>
                                            <li class="top_level"><a href="GuineeLivraison/php/views/panier.php">Panier</a></li>
                                            <li class="top_level"><a href="index.php">Accueil</a></li>
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
    <section class="page-container container ">
        <div class="content-top  mb-1">
            <div class="home-container">
                <div class="main-slider">
                <!--<div id="spinner"></div> -->
                    <div class="swiper-viewport">
                        <div id="slideshow0" class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide text-center sliderWrapper" style="height: 450px;width:100%">
                                    <a href="#"><img style="height: 100%;width:100%" src="GuineeLivraison/image/slideImages/slide1.jpeg" alt="Main Banner1" class="img-responsive slideImage" /></a>
                                </div>
                                <div class="swiper-slide text-center" style="height: 450px;width:100%">
                                    <a href="#"><img  style="height: 100%;width:100%" src="GuineeLivraison/image/slideImages/slide2.jpeg" alt="Main Banner2" class="img-responsive" /></a>
                                </div>
                                <div class="swiper-slide text-center" style="height: 450px;width:100%">
                                    <a href="#"><img  style="height: 100%;width:100%" src="GuineeLivraison/image/slideImages/slide2.jpeg" alt="Main Banner2" class="img-responsive" /></a>
                                </div>
                                <div class="swiper-slide text-center" style="height: 450px;width:100%">
                                    <a href="#"><img  style="height: 100%;width:100%" src="GuineeLivraison/image/slideImages/slide3.jpeg" alt="Main Banner2" class="img-responsive" /></a>
                                </div>
                                <div class="swiper-slide text-center" style="height: 450px;width:100%">
                                    <a href="#"><img  style="height: 100%;width:100%" src="GuineeLivraison/image/slideImages/slide4.jpeg" alt="Main Banner2" class="img-responsive" /></a>
                                </div>
                                <div class="swiper-slide text-center" style="height: 450px;width:100%">
                                    <a href="#"><img  style="height: 100%;width:100%" src="GuineeLivraison/image/slideImages/slide5.jpeg" alt="Main Banner2" class="img-responsive" /></a>
                                </div>
                                <div class="swiper-slide text-center" style="height: 450px;width:100%">
                                    <a href="#"><img  style="height: 100%;width:100%" src="GuineeLivraison/image/slideImages/slide6.jpeg" alt="Main Banner2" class="img-responsive" /></a>
                                </div>
                            </div>

                        </div>
                        <div class="swiper-pagination slideshow0"></div>
                        <div class="swiper-pager">
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $('#slideshow0').swiper({
                        mode: 'horizontal',
                        slidesPerView: 1,
                        pagination: '.slideshow0',
                        paginationClickable: true,
                        nextButton: '.swiper-button-next',
                        prevButton: '.swiper-button-prev',
                        spaceBetween: 0,
                        autoplay: 5000,
                        autoplayDisableOnInteraction: true,
                        loop: true,
                        effect: 'fade'
                    });
                </script>
                <script type="text/javascript">
                    // Can also be used with $(document).ready()
                    /*$(window).load(function() {
                        $("#spinner").fadeOut("slow");
                    });*/
                </script>
            </div>
        </div>
    </section>
    <section class="page-container container " id="presentation">
        <div id="account-register" class="container">
                <?php 
                    if(count($plats) != 0){
                        ?>
                                <h3>Voici nos plats en liste , commandez et nous vous livrons chez vous.</h3>
                                <hr>
                                <div class="row">
                                    <?php
                                        foreach ($plats as $platItem){
                                            ?>
                                                <div class="col-sm-12 col-xs-12 col-md-4 cardItem">
                                                    <div class="card" style="width: 100%;">
                                                        <a href="GuineeLivraison/php/views/productDetails.php?product_id=<?=$platItem["id"] ?>"><img style="width:100%;height:170px" class="card-img-top" src="GuineeLivraison/image/platImages/<?=$platItem["photo"] ?>" title="<?=$platItem["name"] ?>" alt="<?=$platItem["name"] ?>"></a>
                                                        <div class="card-body">
                                                            <h4><a href="GuineeLivraison/views/php/productDetails.php?product_id=<?=$platItem["id"] ?>"><?=$platItem["name"] ?></a></h4>
                                                            <a  class='content' href="GuineeLivraison/php/views/restaurantContent.php?id=<?=$plat->getRestaurantByIdForPlat($platItem["restaurantId"])['id'];?>"><h5 style="color:orange">Restaurant : <?=$plat->getRestaurantByIdForPlat($platItem["restaurantId"])['name'] ?></h5></a>
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
    </section>
    <section class="page-container container">
        <div class="wrap-breadcrumb parallax-breadcrumb">
            <div class="container"></div>
        </div>
        <script>
            function quickbox() {
                if ($(window).width() > 767) {
                    $('.quickview-button').magnificPopup({
                        type: 'iframe',
                        delegate: 'a',
                        preloader: true,
                        tLoading: 'Loading image #%curr%...',
                    });
                }
            }
            jQuery(document).ready(function() {
                quickbox();
            });
            jQuery(window).resize(function() {
                quickbox();
            });
            $(document).ready(function() {
                $('#service-carousel').owlCarousel({
                    items: 3,
                    singleItem: false,
                    navigation: false,
                    pagination: false,
                    autoPlay: true,
                    itemsDesktop: [1199, 3],
                    itemsDesktopSmall: [991, 2],
                    itemsTablet: [650, 1],
                    itemsMobile: [480, 1]
                });
            });
        </script>
       
        <div class="row home_row">

            <div id="content" class="col-sm-12">
                <div id="czservicecmsblock">
                    <div class="service_container">
                        <div class="service-area">
                            <div class="service-fourth service1">
                                <div class="service-icon icon1"></div>
                                <div class="service-content">
                                    <a href="">
                                        <div class="service-heading">100% de satisfaction avec Guinée Livraison</div>
                                        <div class="service-description">Encore mieux en ayant un compte.</div>
                                    </a>
                                </div>
                            </div>
                            <div class="service-fourth service2">
                                <div class="service-icon icon2"></div>
                                <div class="service-content">
                                    <a href="">
                                        <div class="service-heading">Passez votre commande </div>
                                        <div class="service-description">Dans un restaurent de votre choix et recevez depuis chez vous.</div>
                                    </a>
                                </div>
                            </div>
                            <div class="service-fourth service2">
                                <div class="service-icon icon2"></div>
                                <div class="service-content">
                                    <a href="">
                                        <div class="service-heading">Guinée Livraison</div>
                                        <div class="service-description">A votre service.</div>
                                    </a>
                                </div>
                            </div>
                            <div class="service-fourth service4">
                                <div class="service-icon icon2"></div>
                                <div class="service-content">
                                    <div class="service-heading">Avec Guinée Livraison,</div>
                                    <div class="service-description">c'est la qualité du service.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="czbannercmsblock" class="block czbanners">
                    <div class="czbanner_container">
                        <div class="cmsbanners">
                            <div class="one-half cmsbanner-part1">
                                <div class="cmsbanner-inner">
                                    <div class="cmsbanner cmsbanner1">
                                        <a href="#" class="banner-anchor"><img style="height: 300px;opacity:0.6" src="GuineeLivraison/image/slideImages/banner3.jpeg" alt="cms-banner1" class="banner-image1"></a>
                                        <div class="cmsbanner-text">
                                            <div class="main-title"><span class="title">Plats au riz</span> <span class="title1"></span></div>
                                            <div class="shop-button"><a href="#">Voire les plats spéciaux</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="one-half cmsbanner-part2">
                                <div class="cmsbanner-inner">
                                    <div class="cmsbanner cmsbanner2">
                                        <a href="#" class="banner-anchor"><img style="height: 300px;opacity:0.6"  src="GuineeLivraison/image/slideImages/banner2.jpeg" alt="cms-banner2" class="banner-image2"></a>
                                        <div class="cmsbanner-text">
                                            <div class="main-title"><span class="title">Plats au carote </span> <span class="title1"></span></div>
                                            <div class="shop-button"><a href="#">Voire les plats spéciaux</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="one-half cmsbanner-part2 mt-2">
                                <div class="cmsbanner-inner">
                                    <div class="cmsbanner cmsbanner2">
                                        <a href="#" class="banner-anchor"><img style="height: 300px;opacity:0.6;width: 100%"  src="GuineeLivraison/image/slideImages/gateau2.jpeg" alt="cms-banner2" class="banner-image2"></a>
                                        <div class="cmsbanner-text">
                                            <div class="main-title"><span class="title">Plats au carote </span> <span class="title1"></span></div>
                                            <div class="shop-button"><a href="#">Voire les plats spéciaux</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="one-half cmsbanner-part2 mt-2">
                                <div class="cmsbanner-inner">
                                    <div class="cmsbanner cmsbanner2">
                                        <a href="#" class="banner-anchor"><img style="height: 300px;opacity:0.6"  src="GuineeLivraison/image/slideImages/gateau1.jpeg" alt="cms-banner2" class="banner-image2"></a>
                                        <div class="cmsbanner-text">
                                            <div class="main-title"><span class="title">Plats au carote </span> <span class="title1"></span></div>
                                            <div class="shop-button"><a href="#">Voire les plats spéciaux</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>

                <div class="hometab box">
                <!--<div class="container tab-content mb-5">
                        <div class="row tab-content"><h2 class="col-12">Nouveaux Plats</h2><hr></div>
                        <div class="row">
                            <?php
                                /*for($i = 0; $i < $newArticleCount; $i++){
                                    $article = $nouveaux_articles[$i];
                                    ?>
                                        <div class="col-sm-6 col-xs-6 col-lg-2 col-md-4">
                                            <div class="card" style="width: 16rem;">
                                                <img class="card-img-top" src="GuineeLivraison/image/articleImages/<?=$article["photo"] ?>" title="<?=$article["name"] ?>" alt="<?=$article["name"] ?>">
                                                <div class="card-body">
                                                    <h4><a href="GuineeLivraison/php/views/productDetails.php?product_id=<?=$article["id"] ?>"><?=$article["name"] ?></a></h4>
                                                    <p class="card-text"><?=$article["description"] ?></p>
                                                    <p class="price">
                                                        <?=$article["price"] ?> fcfa
                                                    </p>
                                                    <button type="button" class="btn btn-primary addProduct" id="<?=$article['id'];?>"><span><i class="panier fas fa-cart-plus"></i></span></button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }*/
                            ?>
                        </div>
                    </div>-->
                </div>

                <script type="text/javascript">
                    $('#categorytabs a').tabs();
                </script>

                <div id="cztestimonialcmsblock">
                    <div class="testimonial_container">
                        <div class="testimonial_wrapper">
                            <div class="testimonial-area">
                                <div class="customNavigation"><a class="btn prev cztestimonial_prev"> &nbsp; </a> <a class="btn next cztestimonial_next">&nbsp;</a></div>
                                <ul id="testimonial-carousel" class="cz-carousel product_list">
                                <?php
                                    for($i = 1; $i <= 5; $i++){
                                        ?>
                                            <li class="item">
                                                <div class="testimonial-item">
                                                    <div class="item cms_face">
                                                        <div class="testimonial-detail">
                                                            <div class="quote_img"></div>
                                                            <div class="name"><a href="#">Mr.Abbu</a><span>Senior Manager</span></div>
                                                            <div class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the dummy text ever since the 1500s, when an unknown printer took a galley of type only five centuries</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php
                                    }
                                ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="blog_default_width" style="display:none; visibility:hidden"></span>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.blogcarousel').owlCarousel({
                            items: 3,
                            singleItem: false,
                            navigation: false,
                            pagination: false,
                            itemsDesktop: [1199, 3],
                            itemsDesktopSmall: [991, 2],
                            itemsTablet: [575, 1]
                        });
                        // Custom Navigation Events
                        $(".czblog_next").click(function() {
                            $('.blogcarousel').trigger('owl.next');
                        })
                        $(".czblog_prev").click(function() {
                            $('.blogcarousel').trigger('owl.prev');
                        });
                    });
                </script>
            </div>
        </div>
    </section>


    <footer>
        <div class="page-container container">
            <div class="footerbefore">
                <script>
                    /*function subscribe() {
                        var emailpattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                        var email = $('#txtemail').val();
                        if (email != "") {
                            if (!emailpattern.test(email)) {
                                $('.text-danger').remove();
                                var str = '<span class="error">Invalid Email</span>';
                                $('#txtemail').after('<div class="text-danger">Invalid Email</div>');

                                return false;
                            } else {
                                $.ajax({
                                    url: 'index.php?route=extension/module/newsletters/news',
                                    type: 'post',
                                    data: 'email=' + $('#txtemail').val(),
                                    dataType: 'json',


                                    success: function(json) {

                                        $('.text-danger').remove();
                                        $('#txtemail').after('<div class="text-danger">' + json.message + '</div>');

                                    }

                                });
                                return false;
                            }
                        } else {
                            $('.text-danger').remove();
                            $('#txtemail').after('<div class="text-danger">Email Is Require</div>');
                            $(email).focus();

                            return false;
                        }
                    }*/
                </script>
            </div>
        </div>
        <div class="page-container container">
            <div id="footer">
                <div class="row">
                    <div class="footer-blocks">
                        <div class="footerleft-block">
                            <div class="col-sm-3 column footerleft">
                                <div class="contact-block">
                                    <h5>Nous contacter </h5>
                                    <ul>
                                        <li>
                                            <span class="fig">Téléphone:</span>
                                            <i class="fa fa-call-marker"></i>
                                            <span>+01 2222 365 / +91 1256 789</span>
                                        </li>
                                        <li>
                                        </li>
                                        <li>
                                            <span class="fig">Adresss:</span>
                                            <i class="fa fa-map-marker"></i>
                                            <span>507-UTC,Ring Road,California.</span>
                                        </li>
                                        <li>
                                            <span class="fig">Mail:</span>
                                            <i class="fa fa-envelope-o"></i>
                                            <span>sales@yourcompany.com</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-3 column">
                                <h5>Informations</h5>
                                <ul class="list-unstyled">
                                    <li><a href="#">A pros</a></li>
                                    <li><a href="#">Terms &amp; Conditions</a></li>
                                </ul>
                            </div>
                            <div id="extra-link" class="col-sm-3 column">
                                <div class="social-block">
                                    <h5>Nous suivre sur</h5>
                                    <ul>
                                        <li class="facebook"><a href="wa.me/+22673090862"><span>Facebook</span></a></li>
                                        <li class="twitter"><a href="#"><span>Twitter</span></a></li>
                                        <li class="youtube"><a href="#"><span>YouTube</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-3 column">
                                <h5>Mon Compte</h5>
                                <ul class="list-unstyled">
                                        <?php
                                            if(!isset($_SESSION["user"])){
                                                ?>
                                                    <li><a href="GuineeLivraison/php/views/inscription.php">S'incrire</a></li>
                                                <?php
                                            }
                                        ?>
                                        <?php
                                            if(!isset($_SESSION["user"])){
                                                ?>
                                                    <li><a href="GuineeLivraison/php/views/connexion.php">Se Connecter</a></li>
                                                <?php
                                            }
                                        ?>
                                        <?php
                                            if(!isset($_SESSION["user"])){
                                                ?>
                                                    <li><a href="GuineeLivraison/php/views/inscription.php">S'incrire</a></li>
                                                <?php
                                            }
                                        ?>
                                        <?php
                                            if(isset($_SESSION["user"])){
                                                ?>
                                                    <li><a href="GuineeLivraison/php/views/deconnexion.php">Deconnexion <span class="connectedfooter">(connecté)</a></li>
                                                <?php
                                            }
                                        ?>
                                    <li><a href="GuineeLivraison/php/views/panier.php" title="Votre Panier">Mon Panier</a></li>
                                </ul>
                            </div>
                            <div class="footerright">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div id="bottom-footer" class="bottomfooter">
            <div class="row">
            </div>
            <div class="page-container container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <p  class="text-center copyright"> © 2000-2021, Tous les droits sont reservés à Guinée Livraison</p>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" 
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" 
        crossorigin="anonymous"></script>
        <script defer type="module" src="GuineeLivraison/js/guineeLivraison.js"></script>
        <script src="GuineeLivraison/js/functions.js"></script>
	</body>
</html>

<script type="text/javascript">
    $(document).ready(function() {

        $('#ourcategory-carousel').owlCarousel({
            items: 3,
            singleItem: false,
            navigation: false,
            pagination: true,
            autoPlay: false,
            itemsDesktop: [1199, 2],
            itemsDesktopSmall: [991, 2],
            itemsTablet: [575, 1],
            itemsMobile: [480, 1]
        });

        $('#testimonial-carousel').owlCarousel({
            singleItem: true,
            navigation: false,
            pagination: false,
            autoPlay: false
        });
        // Custom Navigation Events
        $(".cztestimonial_next").click(function() {
            $('#testimonial-carousel').trigger('owl.next');
        })
        $(".cztestimonial_prev").click(function() {
            $('#testimonial-carousel').trigger('owl.prev');
        });

        $('.special-carousel').owlCarousel({
            items: 2,
            singleItem: false,
            navigation: false,
            pagination: false,
            itemsDesktop: [1199, 2],
            itemsDesktopSmall: [991, 1],
            itemsTablet: [767, 1]
        });
        // Custom Navigation Events
        $(".special-next").click(function() {
            $('.special-carousel').trigger('owl.next');
        })
        $(".special-prev").click(function() {
            $('.special-carousel').trigger('owl.prev');
        });

        $('#service-carousel').owlCarousel({
            items: 3,
            singleItem: false,
            navigation: false,
            pagination: true,
            autoPlay: true,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [991, 2],
            itemsTablet: [650, 1],
            itemsMobile: [480, 1]
        });

        $('.brand-carousel').owlCarousel({
            items: 5,
            singleItem: false,
            navigation: true,
            pagination: false,
            autoPlay: true,
            itemsDesktop: [1199, 4],
            itemsDesktopSmall: [991, 3],
            itemsTablet: [480, 2],
            itemsMobile: [380, 1]
        });
    });
</script>