<?php 
    session_start();
    $title = "Commandes";

    require_once("../models/panier.php");
    require_once("../models/restaurant.php");
    require_once("../models/user.php");


        $panier = new Panier();
        $retaurant = new Restaurant();
        $user = new User();


        $commands = $panier->getCommandsForAdmin();

    if(isset($_GET['commandIndex'])){
        if(isset($_SESSION['commandIndex'])) unset($_SESSION['commandIndex']);
        $_SESSION['commandIndex'] = $_GET['commandIndex'];
    }

    require_once("adminheader.php");

    ?>
        <section class="page-container container ">
            <!-- ======= Quick view JS ========= -->
            <div id="account-register" class="container section">
                <div class="row">
                    <div id="" class="col-sm-12">
                        <h3>Toutes les commandes en cours sont ici.</h3>
                        <fieldset id="account">
                            <legend>
                                <p>
                                    <?php
                                        if(count($commands) == 0){ 
                                            echo "Aucune aucune commande pour l'instant.";
                                        }
                                    ?>
                                </p>
                            </legend>
                            
                        </fieldset>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-container container ">
            <div id="account-register" class=" section">
                <div class="row">
                    <div id="" class="col-sm-12">
                        <div class="container">
                            <?php
                                if(count($commands) != 0){
                                    foreach($commands as $command){
                                        $owner  = $user->getUserById($command['ownerId']);
                                        $_restaurent = $retaurant->getRestaurantById($command['restaurantId']);
                                        $platsInCommand = $panier->getPlatsInfoInCommand($command['platsIdAndQuantities']);
                                        ?> 
                                            <div class="row">
                                                <span class="col-12" style="font-size:15px;">
                                                    Par <?=$owner['pseudo']; ?> depuis le : <span><?=$command['createdAt']; ?></span> 
                                                </span>
                                                <p>
                                                    <span style='font-size: 12px; font-weight: bold;margin-right:4px;color:black'>Prix Total  :  </span><?=$command['totapPrice'].' Fg'; ?>. <br>
                                                    <span style='font-size: 12px; font-weight: bold;margin-right:4px;color:black'>Restauant  :  </span><?=$_restaurent['name']; ?>. <br>
                                                    <span style='font-size: 12px; font-weight: bold;margin-right:4px;color:black'>Nombre de produits  :  </span><?=count($platsInCommand); ?>. <br>
                                                    <span style='font-size: 12px; font-weight: bold;margin-right:4px;color:black'>Etat  :  </span><?=($command['state'] == 1)?"Livrée":"Non livrée"; ?>. <br>
                                                    <a style="margin-top:2px" class='btn btn-primary mt-2' href="viewCommands.php?commandeId=<?=$command['id']; ?>">
                                                        Voir la commande
                                                    </a>
                                                </p>
                                                <hr>
                                            </div>
                                        <?php
                                    }
                                    
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    require_once("adminfooter.php");
?>