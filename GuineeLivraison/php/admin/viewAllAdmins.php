<?php 
    session_start();
    $title = "Utilisateurs";

    require_once("../models/user.php");
        $user = new User();

        
        if(isset($_GET['deleteAmdinOption'])){
            $user->deleteAdminOption($_GET['deleteAmdinOption']);
        }


        $users = $user->getAllAdmins();

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
                                <a href="addAdmin.php" class="list-group-item">Ajouter un adminstrateur</a> 
                            </div>
                        </div>
                    </aside>
                    <div id="content" class="col-sm-9">
                        <h1>Tous les administrateurs de votre site sont ici.</h1>
                        <fieldset id="account">
                            <legend>
                                <p>
                                    <?php
                                        if(count($users) == 0){ 
                                            echo "Aucun adminstrateurs pour l'instant, veillez en ajouter.";
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
            <div id="account-register" class="container section">
                <div class="row">
                    <div id="" class="col-sm-12">
                        <fieldset id="account">
                            <?php
                                if(count($users) != 0){
                                    ?> 
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">N°</th>
                                                    <th scope="col">Pseudo</th>
                                                    <th scope="col">N°-Téléphone</th>
                                                    <th scope="col">Ville</th>
                                                    <th scope="col">Quartier</th>
                                                    <th scope="col">Membre Depuis le</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    for($i = 0; $i < count($users);$i++){
                                                        $id = $users[$i]['id'];
                                                        $name = $users[$i]['pseudo'];
                                                        $phone = $users[$i]['phone'];
                                                        $ville = $users[$i]['ville'];
                                                        $quartier = $users[$i]['quartier'];
                                                        $date = $users[$i]['createdAt'];
                                                        ?>
                                                            <tr>
                                                                <td><?=$id;?></td>
                                                                <td><?=($_SESSION['user']['id'] == $users[$i]['id']) ? $name." (vous)":$name;?></td>
                                                                <td><?=$phone;?></td>
                                                                <td><?=$ville;?></td>
                                                                <td><?=$quartier;?></td>
                                                                <td><?=$date;?></td>
                                                                <td><a class="error" href="?deleteAmdinOption=<?=$id;?>"><?=($_SESSION['user']['id'] == $users[$i]['id']) ? "":"Enlever";?></a></td>
                                                            </tr>
                                                        <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php
                                }
                            ?>
                        </fieldset>
                    </div>
                </div>
            </div>
        </section>
    <?php
    require_once("adminfooter.php");
?>