<?php 
    session_start();
    $title = "Gestion";

    require_once("../models/user.php");
        $user = new user();

        $user->addAdmin();

    require_once("adminheader.php");
    ?>
        <section class="page-container container ">
            <!-- ======= Quick view JS ========= -->
            <div id="account-register" class="container section">
                <div class="row">
                    <aside id="column-left" class="col-sm-3 hidden-xs">
                        <div class="box">
                            <div class="box-heading">Administrateurs</div>
                            <div class="list-group">
                                <a href="viewAllAdmins.php" class="list-group-item">voir tous les administrateurs</a> 
                            </div>
                        </div>
                    </aside>
                    <div id="content" class="col-sm-9">
                        <h1>Ajouter un administrateur</h1>
                        <form action="addAdmin.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <fieldset id="account">
                                <h3>
                                    <p class="succes">
                                        <?php
                                            if(isset($_SESSION["addAdminSuccess"])){ 
                                                echo $_SESSION["addAdminSuccess"];
                                                unset($_SESSION["addAdminSuccess"]);
                                            }
                                        ?>
                                    </p>
                                </h3>
                            </fieldset>
                            <fieldset id="account">
                                <legend>Ajout d'administrateur :</legend>
                                <div class="form-group required">
                                    <label class="col-sm-3 control-label" for="input-firstname">Numéro de téléphone</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" value="<?php if(isset($_POST["phone"])) echo $_POST["phone"];?>" 
                                        placeholder="Donner le numéro " id="" class="form-control" />
                                        <p class="error">
                                            <?php 
                                                if(isset($_SESSION["error_phone"])) { echo $_SESSION["error_phone"]." *"; unset($_SESSION["error_phone"]);}
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <div class="buttons">
                                <div class="pull-right">
                                    <input type="submit" value="Ajouter !!" name="add" class="btn btn-primary" />
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