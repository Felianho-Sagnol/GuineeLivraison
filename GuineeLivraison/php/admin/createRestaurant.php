<?php 
    session_start();
    $title = "Gestion Restaurant";

    require_once("../models/restaurant.php");
        $restaurant = new Restaurant();
        $restaurant->createRestaurant();

    require_once("adminheader.php");
    ?>
        <section class="page-container container ">
            <!-- ======= Quick view JS ========= -->
            <div id="account-register" class="container section">
                <div class="row">
                    <aside id="column-left" class="col-sm-3 hidden-xs">
                        <div class="box">
                            <div class="box-heading">Restaurants</div>
                            <div class="list-group">
                                <a href="viewAllRestaurants.php" class="list-group-item">voir tous les restaurants</a> 
                            </div>
                        </div>
                    </aside>
                    <div id="content" class="col-sm-9">
                        <h1>Ajouter un Restaurant</h1>
                        <form action="createRestaurant.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <fieldset id="account">
                                <h3>
                                    <p class="succes">
                                        <?php
                                            if(isset($_SESSION["succesAdd"])){ 
                                                echo $_SESSION["succesAdd"];
                                                unset($_SESSION["succesAdd"]);
                                            }
                                        ?>
                                    </p>
                                </h3>
                            </fieldset>
                            <fieldset id="account">
                                <legend>Les informations sur le restaurant:</legend>
                                <div class="form-group required">
                                    <label class="col-sm-3 control-label" for="input-firstname">Nom du restaurant</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" value="<?php if(isset($_POST["name"])) echo $_POST["name"];?>" 
                                        placeholder="Donner le nom du restaurant" id="input-firstname" class="form-control" />
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_name"])) { echo $_SESSION["error_name"]." *"; unset($_SESSION["error_name"]);}
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-3 control-label" for="input-firstname">Numéro du propriétaire</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" value="<?php if(isset($_POST["phone"])) echo $_POST["phone"];?>" 
                                        placeholder="Donner le numéro du restaurateur" id="" class="form-control" />
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_phone"])) { echo $_SESSION["error_phone"]." *"; unset($_SESSION["error_phone"]);}
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-3 control-label" for="input-firstname">Ville</label>
                                    <div class="col-sm-9">
                                        <input type="textarea" name="ville" value="<?php if(isset($_POST["ville"])) echo $_POST["ville"];?>" 
                                        placeholder="Donner la ville où le restaurant est placé" id="input-firstname" class="form-control" />
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_ville"])) { echo $_SESSION["error_ville"]." *"; unset($_SESSION["error_ville"]);}
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-3 control-label" for="input-firstname">Quartier </label>
                                    <div class="col-sm-9">
                                        <input type="textarea" name="quartier" value="<?php if(isset($_POST["quartier"])) echo $_POST["quartier"];?>" 
                                        placeholder="Donner le quartier où le restaurant est placé dans la ville choisie" id="input-firstname" class="form-control" />
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_quartier"])) { echo $_SESSION["error_quartier"]." *"; unset($_SESSION["error_quartier"]);}
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-firstname">Présicion sur le lieu</label>
                                    <div class="col-sm-9">
                                        <input type="textarea" name="precision" value="<?php if(isset($_POST["precision"])) echo $_POST["precision"];?>" 
                                        placeholder="Donner une précision sur l'emplacement du restaurant" id="input-firstname" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-firstname">Description</label>
                                    <div class="col-sm-9">
                                        <input type="textarea" name="description" value="<?php if(isset($_POST["description"])) echo $_POST["description"];?>" 
                                        placeholder="Donner la description du restaurant" id="input-firstname" class="form-control" />
                                    </div>
                                </div>
                            </fieldset>
                            
                            <div class="buttons">
                                <div class="pull-right">
                                    <input type="submit" value="Créer !" name="create_restaurant" class="btn btn-primary" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php
    require_once("adminfooter.php");
?>