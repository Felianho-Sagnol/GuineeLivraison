<?php 
    session_start();
    $title = "Modification de Plat";
        
    require_once("../models/plats.php");
        $plat = new Plat();


    if(isset($_GET['modifier']) AND $_GET["modifier"] > 0){
        if(isset($_SESSION['currentPlatId'])) unset($_SESSION['currentPlatId']);
        $_SESSION['currentPlatId'] = $_GET['modifier'];
    }
    if(!isset($_SESSION['currentPlatId'])){
        header("Location: viewAllPlats.php");
    }
    if(isset($_SESSION['currentPlat'])){
        unset($_SESSION['currentPlat']);
        $_SESSION['currentPlat'] = $plat->getPlatById($_SESSION['currentPlatId']);
    }else{
        $_SESSION['currentPlat'] = $plat->getPlatById($_SESSION['currentPlatId']);
    }

    $plat->updatePlat();
    require_once("restaurantAdminHeader.php");
    ?>
        <section class="page-container container ">
            <div id="account-register" class="container section">
                <div class="row">
                    <aside id="column-left" class="col-sm-3 hidden-xs">
                        <div class="box">
                            <div class="box-heading">Plats</div>
                            <div class="list-group">
                                <a href="viewAllPlats.php" class="list-group-item">voir tous les plats</a> 
                                <a href="createPlats.php" class="list-group-item">Ajoutez un plat</a> 
                            </div>
                        </div>
                    </aside>
                    <div id="content" class="col-sm-9">
                        <h1>Modifiez le plat</h1>
                        <h3>Il sera visible sur notre site par les utilisateurs.</h3>
                        <?php 
                            if(isset($_SESSION["success_apdated"])) {
                                echo "<h4 class='succes'>".$_SESSION["success_apdated"].".</h4>";
                                unset($_SESSION["success_apdated"]);
                            }
                        ?>
                        <form action="modification.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <fieldset id="account">
                                <legend>Les informations sur le plat :</legend>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-firstname">Nom</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="<?=$_SESSION['currentPlat']["name"];?>" 
                                        placeholder="Le nom du plat" id="input-firstname" class="form-control" />
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_name"])) { echo $_SESSION["error_name"]." *"; unset($_SESSION["error_name"]);}
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-firstname">Prix</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="0" stet="1"  name="price" value="<?=$_SESSION['currentPlat']["price"];?>" 
                                        placeholder="Le prix du plat" id="input-firstname" class="form-control" />
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_price"])) { echo $_SESSION["error_price"]." *"; unset($_SESSION["error_price"]);}
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-firstname">Description</label>
                                    <div class="col-sm-10">
                                        <input type="textarea" name="description" value="<?=($_SESSION['currentPlat']["description"]==null) ? "" : $_SESSION['currentPlat']["description"];?>" 
                                        placeholder="La description du plat (non obligatoire)." id="input-firstname" class="form-control" />
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset>
                                <legend>La photo du plat</legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-password">Photo</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="photo" id="input-password" class="form-control"/>
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_photo"])) { echo $_SESSION["error_photo"]." *"; unset($_SESSION["error_photo"]);}
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="buttons">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-6">
                                        <input type="submit" style="width:100%" value="Appliquez !" name="update" class="btn btn-primary" />
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    <?php
    require_once("restaurantAdminFooter.php");
?>