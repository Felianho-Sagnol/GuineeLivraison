<?php 
    session_start();
    $title = "Commandes";

    require_once("../models/panier.php");
    require_once("../models/restaurant.php");
    require_once("../models/user.php");


        $panier = new Panier();
        $retaurant = new Restaurant();
        $user = new User();



    if(isset($_GET['commandeId'])){
        if(isset($_SESSION['commandeId'])) unset($_SESSION['commandeId']);
        $_SESSION['commandeId'] = $_GET['commandeId'];
    }

    $command = $panier->getCommandById($_SESSION['commandeId']);
    $platsInCommand = $panier->getPlatsInfoInCommand($command['platsIdAndQuantities']);
    $owner  = $user->getUserById($command['ownerId']);

    require_once("adminheader.php");

    ?>
        <section class="page-container container ">
            <div id="account-register" class=" section">
                <div class="row">
                    <h3>Facture & Détails de la  commande : </h3> <hr>
                    <div id="" class="col-sm-12">
                        <?php
                            foreach ($platsInCommand as $item){
                                ?>
                                    <h3></h3>
                                    <p>
                                        <span style='font-size: 12px; font-weight: bold;margin-right:4px'>Nom du produit  : </span> <?=$item['name']; ?>.<br>
                                        <span style='font-size: 12px; font-weight: bold;margin-right:4px'>Quantité  :  </span> <?=$item['quantity']." X ".$item['price'].' Fg'; ?>. <br>
                                        <span>-------------------------------------</span>
                                    </p>
                                <?php
                            }
                        ?>
                        <p>
                            <span style='font-size: 12px; font-weight: bold;margin-right:4px;color:black'>Date de la commande  :  </span>Le <?=$command['createdAt']; ?>. <br>
                            <span style='font-size: 12px; font-weight: bold;margin-right:4px;color:black'>Prix Total  :  </span><?=$command['totapPrice'].' Fg'; ?>. <br>
                            <span style='font-size: 12px; font-weight: bold;margin-right:4px;color:black'>Nombre de produits  :  </span><?=count($platsInCommand); ?>. <br>
                        </p>
                        <p>
                            <span style="color:black;font-size: 13px;font-weight: bold;">Informations sur le client: :</span>  <br>
                            <span style="font-size: 12px;font-weight: bold;">Nom & Prénom :  </span><?=$owner['pseudo']; ?>. <br>
                            <span style="font-size: 12px;font-weight: bold;">Numéro de téléphone :  </span><?=$owner['phone']; ?>. <br>
                            <span style="font-size: 12px;font-weight: bold;">Ville(Quartier) :  </span><?=$owner['ville']." (".$owner['quartier'].")"; ?>. <br>
                            <span style="font-size: 12px;font-weight: bold;">Indication sur le lieu  :  </span><?=($owner['indication'] == null) ? "Pas d'indication sur le lieu" : $owner['indication']; ?>. <br>
                        </p>
                        <a class="btn btn-primary"href="">Valider la commande</a>
                    </div>
                </div>
            </div>
        </section>
    <?php
    require_once("adminfooter.php");
?>