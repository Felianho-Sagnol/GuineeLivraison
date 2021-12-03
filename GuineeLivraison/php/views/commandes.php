<?php 
    session_start();
    $title = "Commandes";

    require_once("../models/panier.php");
    require_once("../models/restaurant.php");

        $panier = new Panier();
        $retaurant = new Restaurant();


    if(!isset($_SESSION["user"])){
        $userState = false;
        $commands = [];
    }else{
        $userState = true;
        $commands = $panier->getCommands(intval($_SESSION["user"]['id']));
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
                    <li><a href="commandes.php">Commandes</a></li>
                </ul>
                <div class="row">
                    <aside id="column-left" class="col-sm-12 hidden-xs">
                        <div class="box">
                            <div class="box-heading">Mon Panier</div>
                            <div class="list-group">
                                <a href="panier.php" class="list-group-item">Contenu du Panier </a>
                            </div>
                        </div>
                    </aside>
                    <div id="" class="col-sm-12">
                        <?php
                            if($userState){
                                ?>
                                    <?php
                                        if(count($commands) != 0){
                                            ?>
                                                <h3>Vos Commandes ajoutées .</h3>
                                                <hr>
                                                <div class="row">
                                                    <?php
                                                        $num = 0;
                                                        foreach ($commands as $command){
                                                            $restoCurrent = $retaurant->getRestaurantById($command['restaurantId']);
                                                            $platsInCommand = $panier->getPlatsInfoInCommand($command['platsIdAndQuantities']);
                                                            ?>
                                                                <div class="col-md-12">
                                                                    <h4>Facture pour la commande n° <?=$num +1; ?></h4>
                                                                    <?php
                                                                        foreach ($platsInCommand as $item){
                                                                            ?>
                                                                                <p>
                                                                                    <span style='font-size: 12px; font-weight: bold;margin-right:4px'>Nom du produit  : </span> <?=$item['name']; ?>.<br>
                                                                                    <span style='font-size: 12px; font-weight: bold;margin-right:4px'>Quantité  :  </span> <?=$item['quantity']." X ".$item['price'].' Fg'; ?>. <br>
                                                                                </p>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                    <p>
                                                                        <span style='font-size: 12px; font-weight: bold;margin-right:4px;color:black'>Date de la commande  :  </span>Le <?=$command['createdAt']; ?>. <br>
                                                                        <span style='font-size: 12px; font-weight: bold;margin-right:4px;color:black'>Prix Total  :  </span><?=$command['totapPrice'].' Fg'; ?>. <br>
                                                                        <span style='font-size: 12px; font-weight: bold;margin-right:4px;color:black'>Nombre de produits  :  </span><?=count($platsInCommand); ?>. <br>
                                                                        <span style='font-size: 12px; font-weight: bold;margin-right:4px;color:black'>Restaurant  :  </span><?=$restoCurrent['name']." size à ".$restoCurrent['ville']."(".$restoCurrent['quartier'].")"; ?>. <br>
                                                                    </p>
                                                                    <hr>
                                                                </div>
                                                                
                                                            <?php
                                                            
                                                            $num++;
                                                        }
                                                    ?>
                                                </div>
                                            <?php
                                        }else{
                                            ?>
                                                <h3>Aucune commande ajoutée pour l'instant .</h3>
                                                <hr>
                                            <?php
                                        }
                                    ?>
                                <?php
                            }else{
                                ?>
                                    <h3>connectez-vous pour voir vos commandes .</h3>
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