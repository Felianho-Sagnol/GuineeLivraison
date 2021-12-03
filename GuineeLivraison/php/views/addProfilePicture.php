<?php 
    session_start();
    $title = "Connexion-BP";
    require_once("../models/user.php");
        $user = new User();
        $user->add_profile_picture();
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
                        <h1>Changez votre profile sur Burkina Promo</h1>
                        <form action="addProfilePicture.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <fieldset>
                                <legend></legend>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-password">Photo</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="photo" id="input-password" class="form-control"/>
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["photo_errors"])) { echo $_SESSION["photo_errors"]." *"; unset($_SESSION["photo_errors"]);}
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="buttons">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <input type="submit" style="width:100%" value="Appliquer !" name="addPict" class="btn btn-primary" />
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