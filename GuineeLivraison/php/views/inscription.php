<?php 
    session_start();
    $title = "Inscription-BP";
    require_once("../models/user.php");

    if(isset($_SESSION["user"])){
        header("location: compte.php");
    }
    
    $user = new User();
    $user->createUser();
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
                    <li><a href="compte.php">Compte</a></li>
                    <li><a href="inscription.php">Inscription</a></li>
                </ul>
                <div class="row">
                    <aside id="column-left" class="col-sm-3 hidden-xs">
                        <div class="box">
                            <div class="box-heading">Mon Compte</div>
                            <div class="list-group">
                                <a href="indexe223.html?route=account/login" class="list-group-item">Connexion</a> 
                                <a href="index5502.html?route=account/register" class="list-group-item">Inscription</a> 
                                <a href="indexacda.html?route=account/forgotten" class="list-group-item">Mot de passe oublié ?</a>
                                <a href="indexe223.html?route=account/download" class="list-group-item">Mon Panier </a>
                                <a href="indexe223.html?route=account/transaction" class="list-group-item">Mes commandes </a> 
                                <a href="indexe223.html?route=account/newsletter"class="list-group-item">Newsletter </a>
                            </div>
                        </div>
                    </aside>
                    <div id="content" class="col-sm-9">
                        <h3>Créer un compte sur Guinée Livraison</h3>
                        <p>Vous avez déjà un compte ? <a href="connexion.php"><span class="je_me_connecte">Se Connecter !</span></a>.</p>
                        <form action="inscription.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <fieldset id="account">
                                <legend>Vos informations :</legend>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-firstname">Prénom & Nom</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="pseudo" value="<?php if(isset($_POST["pseudo"])) echo $_POST["pseudo"];?>" 
                                        placeholder="Votre pseudo" id="input-firstname" class="form-control" />
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_pseudo"])) { echo $_SESSION["error_pseudo"]." *"; unset($_SESSION["error_pseudo"]);}
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Téléphone</label>
                                    <div class="col-sm-10">
                                        <input type="tel" name="phone" value="<?php if(isset($_POST["phone"])) echo $_POST["phone"];?>" 
                                        placeholder="votre numero de téléphone fonctionnel." id="input-telephone" class="form-control" />
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_phone"])) { echo $_SESSION["error_phone"]." *"; unset($_SESSION["error_phone"]);}
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Ville</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="ville" value="<?php if(isset($_POST["ville"])) echo $_POST["ville"];?>" 
                                        placeholder="Votre de ville de résidence : Exemple : Conakry" id="input-telephone" class="form-control" />
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_ville"])) { echo $_SESSION["error_ville"]." *"; unset($_SESSION["error_ville"]);}
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-telephone">Quartier</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="quartier" value="<?php if(isset($_POST["quartier"])) echo $_POST["quartier"];?>" 
                                        placeholder="votre quartier dans la ville choisie." id="input-telephone" class="form-control" />
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_quartier"])) { echo $_SESSION["error_quartier"]." *"; unset($_SESSION["error_quartier"]);}
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Indiquer un lieu reconnu dans votre quartier pour vous retrouver facilement</legend>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-confirm">indication</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="indication" value="<?php if(isset($_POST["indication"])) echo $_POST["indication"];?>" 
                                        placeholder="Exemple : école primaire de sangoyah" id="input-confirm" class="form-control" />
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_indication"])) { echo $_SESSION["error_indication"]." *"; unset($_SESSION["error_indication"]);}
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Votre mot de passe</legend>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-password">Mot de passe</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" value="<?php if(isset($_POST["password"])) echo $_POST["password"];?>" 
                                        placeholder="Mot de passe" id="input-password" class="form-control" />
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_password"])) { echo $_SESSION["error_password"]." *"; unset($_SESSION["error_password"]);}
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-confirm">Confirmation</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="confirm_password" value="<?php if(isset($_POST["confirm_password"])) echo $_POST["confirm_password"];?>" 
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
                                <div class="pull-right">J'ai lu et j'acepte les <a href="" class="agree"><b>conditions d'utilisation</b></a> de Guinée Livraison 
                                    <input type="submit" value="S'inscrire !" name="inscription" class="btn btn-primary" />
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