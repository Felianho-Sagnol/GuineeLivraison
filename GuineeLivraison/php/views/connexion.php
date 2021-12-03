<?php 
    session_start();
    $title = "Connexion";
    require_once("../models/user.php");
        $user = new User();

        $user->connecteUser();
    
    if(isset($_GET["nextPage"])){
        $_SESSION["nextPage"] = $_GET["nextPage"];
    }

    if(isset($_SESSION["user"]) AND !isset($_SESSION["nextPage"])){
        header("location: compte.php");
    }

    if(isset($_SESSION["user"]) AND isset($_SESSION["nextPage"])){
        unset($_SESSION["nextPage"]);
        header("location: ../../../index.php");
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
                    <li><a href="">Connexion</a></li>
                </ul>
                <div class="row">
                    <aside id="column-left" class="col-sm-3 hidden-xs">
                        <div class="box">
                            <div class="box-heading">Mon Compte</div>
                            <div class="list-group">
                                <a href="" class="list-group-item">Mon Panier </a>
                                <a href="codeArticleDetails.php" class="list-group-item">Mes codes articles </a>
                                <a href="" class="list-group-item">Mes commandes </a>
                                <a href="monCodeParrainDetail.php" class="list-group-item">Mon code Parrain </a>
                                <a href="resetPassword.php" class="list-group-item">Mot de passe oublié ?</a>
                                <?php
                                    if(isset($_SESSION["user"])){
                                        ?>
                                            <a class="list-group-item" href="deconnexion.php">Deconnexion</a>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </aside>
                    <div id="content" class="col-sm-9">
                        <h4>Connectez-vous sur votre compte  sur Guinée Livraison</h4>
                        <?php 
                            if(isset($_GET['want_connect_has_admin'])) 
                                { 
                                    echo "<h4 class='succes'>Vous tentiez de vous connecter en tant qu'administrateur , donner les bonnes informations pour le faire.</h4>";
                                }
                            if(isset($_GET['want_see_my_acount'])) 
                                { 
                                    echo "<h4 class='succes'>Vous vouliez voir votre compte ?, connectez-vous pour y aller.</h4>";
                                }
                        ?>
                        <h6>Vous n'avez pas de compte ? <a href="inscription.php"><span class="je_mee">S'inscrire</span></a>.</h6>
                        <form action="connexion.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <fieldset id="account">
                                <legend>Vos informations :</legend>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="">Téléphone</label>
                                    <div class="col-sm-10">
                                        <input type="tel" name="phone" value="<?php if(isset($_POST["phone"])) echo $_POST["phone"];?>" 
                                        placeholder="votre numero de téléphone fonctionnel." id="input" class="form-control" />
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_phone"])) 
                                                { 
                                                    echo $_SESSION["error_phone"]." *"; unset($_SESSION["error_phone"]);
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="">Mot de passe</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" value="<?php if(isset($_POST["password"])) echo $_POST["password"];?>" 
                                        placeholder="Mot de passe" id="" class="form-control" />
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_password"])) 
                                                {
                                                     echo $_SESSION["error_password"]." *"; unset($_SESSION["error_password"]);
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset id="account">
                                <p class="error">
                                    <?php 
                                        if(isset($_SESSION["error_compte_not_existe"])) 
                                        {
                                            echo $_SESSION["error_compte_not_existe"]." *"; unset($_SESSION["error_compte_not_existe"]);
                                        }
                                    ?>
                                </p>
                            </fieldset>
                            <div class="buttons">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <input type="submit" style="width:100%" value="Se Connecter !" name="connexion" class="btn btn-primary" />
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    <?php
    require_once("../includes/footer.php");
?>