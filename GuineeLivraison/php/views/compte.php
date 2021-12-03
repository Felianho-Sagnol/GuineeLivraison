<?php 
    session_start();
    $title = "Compte";
    require_once("../models/user.php");
        $user = new User();

        $user->updateUser();
    if(isset($_SESSION["user"])){
        $current_user = $user->getUserById($_SESSION["user"]['id']);
        if($current_user != null) $_SESSION["user"] = $current_user;
    }
    if(!isset($_SESSION["user"])){
        header("location: connexion.php?want_see_my_acount=yes");
    }
    require_once("../includes/header.php");
    ?>

        <section class="page-container container">
            <div class="wrap-breadcrumb parallax-breadcrumb">
                <div class="container"></div>
            </div>
            <div id="account-register" class="container">
                <ul class="breadcrumb">
                    <li><a href="../../../index.php"><i class="fa fa-home"></i></a></li>
                    <li><a href="compte.php">Compte</a></li>
                </ul>
                <div class="row">
                    <aside id="column-left" class="col-sm-3 hidden-xs">
                        <div class="box">
                            <div class="box-heading">Mon Compte</div>
                            <div class="list-group">
                                <a href="panier.php" class="list-group-item">Mon Panier </a>
                                <a href="commandes.php" class="list-group-item">Mes commandes </a>
                                <a class="list-group-item" href="deconnexion.php">Deconnexion</a>
                            </div>
                        </div>
                    </aside>
                    <div id="content" class="col-sm-9">
                        <h2>Bienvenu sur votre compte</h2>
                        <?php
                            if(isset($_SESSION["user"])){
                                ?>
                                <form action="compte.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <fieldset id="account">
                                        <legend>Vos informations :</legend>
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label" for="">Prénom & Nom</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="pseudo" 
                                                value="<?php if(isset($_POST['pseudo'])){echo $_POST["pseudo"];}else{ echo $_SESSION["user"]['pseudo']; }?>" 
                                                placeholder="Votre pseudo" id="" class="form-control" />
                                                <p class="error">
                                                    <?php 
                                                        if(isset($_SESSION["error_pseudo"])) { echo $_SESSION["error_pseudo"]." *"; unset($_SESSION["error_pseudo"]);}
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label" for="input-telephone">Téléphone</label>
                                            <div class="col-sm-9">
                                                <input type="tel" name="phone" value="<?php if(isset($_POST['phone'])){echo $_POST["phone"];}else{ echo $_SESSION["user"]['phone']; }?>" 
                                                placeholder="votre numero de téléphone fonctionnel." id="input-telephone" class="form-control" />
                                                <p class="error">
                                                    <?php 
                                                        if(isset($_SESSION["error_phone"])) { echo $_SESSION["error_phone"]." *"; unset($_SESSION["error_phone"]);}
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset id="account">
                                        <legend>Vos informations de localisation :</legend>
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label" for="">Ville de residence :</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="ville" 
                                                value="<?php if(isset($_POST['ville'])){echo $_POST["ville"];}else{ echo $_SESSION["user"]['ville']; }?>" 
                                                placeholder="Votre de ville de résidence : Exemple : Conakry" id="" class="form-control" />
                                                <p class="error">
                                                    <?php 
                                                        if(isset($_SESSION["error_ville"])) { echo $_SESSION["error_ville"]." *"; unset($_SESSION["error_ville"]);}
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label" for="">Quartier :</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="quartier" 
                                                value="<?php if(isset($_POST['quartier'])){echo $_POST["quartier"];}else{ echo $_SESSION["user"]['quartier']; }?>" 
                                                placeholder="votre quartier dans la ville choisie." id="" class="form-control" />
                                                <p class="error">
                                                    <?php 
                                                        if(isset($_SESSION["error_quartier"])) { echo $_SESSION["error_quartier"]." *"; unset($_SESSION["error_quartier"]);}
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        
                                    </fieldset>
                                    <fieldset>
                                        <legend>Votre indcation sur votre localisation</legend>
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label" for="">indication :</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="indication" 
                                                value="<?php if(isset($_POST['indication'])){echo $_POST["indication"];}else{ echo $_SESSION["user"]['indication']; }?>" 
                                                placeholder="Exemple : école primaire de sangoyah." id="" class="form-control" />
                                                <p class="error">
                                                    <?php 
                                                        if(isset($_SESSION["error_indication"])) { echo $_SESSION["error_indication"]." *"; unset($_SESSION["error_indication"]);}
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Changer votre mot de passe</legend>
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label" for="input-password">Mot de passe</label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password" 
                                                value="<?php if(isset($_POST['password'])){echo $_POST["password"];}?>" 
                                                placeholder="Mot de passe" id="input-password" class="form-control" />
                                                <p class="error">
                                                    <?php 
                                                        if(isset($_SESSION["error_password"])) { echo $_SESSION["error_password"]." *"; unset($_SESSION["error_password"]);}
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label" for="input-confirm">Confirmation</label>
                                            <div class="col-sm-9">
                                                <input type="password" name="confirm_password" 
                                                value="<?php if(isset($_POST['confirm_password'])){echo $_POST["confirm_password"];}?>" 
                                                placeholder="Confirmer le mot de passe" id="input-confirm" class="form-control" />
                                                <p class="error">
                                                    <?php 
                                                        if(isset($_SESSION["error_confirm_password"])) { echo $_SESSION["error_confirm_password"]." *"; unset($_SESSION["error_confirm_password"]);}
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="buttons">
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <input type="submit" style="width:100%" value="Appliquer !" name="update" class="btn btn-primary" />
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                    </div>
                                </form>
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