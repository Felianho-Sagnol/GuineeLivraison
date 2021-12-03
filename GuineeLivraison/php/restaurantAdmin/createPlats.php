<?php 
    session_start();
    $title = "Ajout de Plat";
        
    require_once("../models/plats.php");
        $plat = new Plat();
        $plat->createPlat();
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
                            </div>
                        </div>
                    </aside>
                    <div id="content" class="col-sm-9">
                        <h1>Ajoutez un plat</h1>
                        <h3>Il sera visible sur notre site par les utilisateurs.</h3>
                        <?php 
                            if(isset($_SESSION["success_creation"])) {
                                echo "<h4 class='succes'>".$_SESSION["success_creation"].".</h4>";
                                unset($_SESSION["success_creation"]);
                            }
                        ?> 

                        <form action="createPlats.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <fieldset id="account">
                                <legend>Les informations sur le plat :</legend>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-firstname">Nom</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="<?php if(isset($_POST["name"])) echo $_POST["name"];?>" 
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
                                        <input type="number" min="0" stet="1"  name="price" value="<?php if(isset($_POST["price"])) echo $_POST["price"];?>" 
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
                                        <input type="textarea" name="description" value="<?php if(isset($_POST["description"])) echo $_POST["description"];?>" 
                                        placeholder="La description du plat (non obligatoire)." id="input-firstname" class="form-control" />
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_description"])) { echo $_SESSION["error_description"]." *"; unset($_SESSION["error_description"]);}
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset>
                                <legend>La photo du plat</legend>
                                <div class="form-group required">
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
                                        <input type="submit" style="width:100%" value="Ajoutez le plat !" name="create_plat" class="btn btn-primary" />
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