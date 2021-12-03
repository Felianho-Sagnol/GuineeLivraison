<?php 
    session_start();
    $title = "Utilisateurs";

    require_once("../models/user.php");
        $user = new User();

        if(isset($_GET["delete"])){
            $user->deleteUser($_GET["delete"]);
        }

        $pagination = $user->userPagination();

        $users = $pagination["users"];

        require_once("adminheader.php");
    ?>
        <section class="page-container container ">
            <!-- ======= Quick view JS ========= -->
            <div id="account-register" class="container section">
                <div class="row">
                    <div id="" class="col-sm-12">
                        <h1>Tous les utilisateurs de votre site sont ici.</h1>
                        <fieldset id="account">
                            <legend>
                                <p>
                                    <?php
                                        if(count($users) == 0){ 
                                            echo "Aucun utilisateur pour l'instant, veillez en ajouter.";
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
                                                    <th scope="col">Pseudo</th>
                                                    <th scope="col">N°-Téléphone</th>
                                                    <th scope="col">Ville(Quartier)</th>
                                                    <th scope="col">Membre Depuis le : </th>
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
                                                                <td><?=$name;?></td>
                                                                <td><?=$phone;?></td>
                                                                <td><?=$ville."(".$quartier.")";?></td>
                                                                <td><?=$date;?></td>
                                                                <?php
                                                                    if($_SESSION['user']['id'] == $id){
                                                                        ?>
                                                                            <td><?="(Vous)";?></td>
                                                                        <?php
                                                                    }else if($_SESSION['user']['isAdmin'] == 1){
                                                                        ?>
                                                                            <td><a class="error" href="?delete=<?=$id;?>">Supprimer</a></td>
                                                                        <?php
                                                                    }
                                                                ?>
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
        <section class="page-container container ">
            <div id="account-register" class="container section">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <?php
                            if($pagination['totalPage'] != 0){
                                ?>
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <?php
                                                for($i = 1; $i <= $pagination['totalPage']; $i++){
                                                    ?>
                                                        <li class="page-item  <?php if($pagination['pageCourante'] == $i) echo "active"; ?>">
                                                            <a class="page-link" href="?page=<?=$i;?>"><?=$i;?></a>
                                                        </li>
                                                    <?php
                                                }
                                            ?>
                                        </ul>
                                    </nav>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </section>
    <?php
    require_once("adminfooter.php");
?>