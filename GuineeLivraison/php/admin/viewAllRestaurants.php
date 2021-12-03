<?php 
    session_start();
    $title = "Tous les utilisateurs-BP";

    require_once("../models/restaurant.php");
    require_once("../models/user.php");

        $restaurant = new Restaurant();
        $user = new User();

        $restaurants = $restaurant->getAllRestaurants();


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
                                <a href="createRestaurant.php" class="list-group-item">Ajouter un restaurant</a> 
                            </div>
                        </div>
                    </aside>
                    <div id="content" class="col-sm-9">
                        <h1>Vos Restaurants enregistrés :</h1>
                        <fieldset id="account">
                            <legend>
                                <p>
                                    <?php
                                        if(count($restaurants) == 0){ 
                                            echo "Aucun restaurant pour l'instant, veillez en ajouter.";
                                        }
                                    ?>
                                </p>
                            </legend>
                            <h5>
                                <?php
                                    if(isset($_SESSION["code_article_suppression"])){ 
                                        //echo $_SESSION["code_article_suppression"];
                                       // unset($_SESSION["code_article_suppression"]);
                                    }
                                ?>
                            </h5>
                        </fieldset>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-container container ">
            <div id="account-register" class="container section">
                <div class="row">
                    <div id="" class="col-sm-12">
                        <fieldset id="account" style="width:100%">
                            <?php
                                if(count($restaurants) != 0){
                                    ?> 
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Ville</th>
                                                    <th scope="col">Quartier</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Propriétaire</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    for($i = 0; $i < count($restaurants);$i++){
                                                        $name = $restaurants[$i]['name'];
                                                        $ville = $restaurants[$i]['ville'];
                                                        $quartier = $restaurants[$i]['quartier'];
                                                        $description = $restaurants[$i]['description'];
                                                        ?>
                                                            <tr>
                                                                <td><?=$name;?></td>
                                                                <td><?=$ville;?></td>
                                                                <td><?=$quartier;?></td>
                                                                <td><?=($description!=null) ? $description : "pas de description";?></td>
                                                                <td><?=$user->getUserById($restaurants[$i]['ownerId'])['pseudo'];?></td>
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