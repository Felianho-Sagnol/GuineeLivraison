<?php 
    session_start();
    $title = "Plats";

    require_once("../models/plats.php");
        $plat = new Plat();

        $pagination = $plat->platPagination();

        $plats = $pagination["plats"];


        require_once("restaurantAdminHeader.php");
    ?>
        <section class="page-container container ">
            <!-- ======= Quick view JS ========= -->
            <div id="account-register" class="container section">
                <div class="row">
                    <aside id="column-left" class="col-sm-3 hidden-xs">
                        <div class="box">
                            <div class="box-heading">Plats</div>
                            <div class="list-group">
                                <a href="createPlats.php" class="list-group-item">Ajoutez un plat</a> 
                            </div>
                        </div>
                    </aside>
                    <div id="content" class="col-sm-9">
                        <h1>Tous les plats seront affichés ici.</h1>
                        <fieldset id="account">
                            <legend>
                                <p>
                                    <?php
                                        if(count($plats) == 0){ 
                                            echo "Aucun plat pour l'instant, veillez en ajouter.";
                                        }
                                    ?>
                                </p>
                            </legend>
                            <h5>
                                <?php
                                    if(isset($_SESSION["article_suppression"])){ 
                                        echo $_SESSION["article_suppression"];
                                        unset($_SESSION["article_suppression"]);
                                    }
                                ?>
                            </h5>
                        </fieldset>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-container container ">
            <div id="account-register" class=" section">
                <div class="row">
                    <div id="" class="col-sm-12">
                        <fieldset id="account">
                            <?php
                                if(count($plats) != 0){
                                    ?> 
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Prix</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    for($i = 0; $i < count($plats);$i++){
                                                        $id = $plats[$i]['id'];
                                                        $name = $plats[$i]['name'];
                                                        $description = $plats[$i]['description'];
                                                        $price = $plats[$i]['price'];
                                                        $image = $plats[$i]['photo'];
                                                        ?>
                                                            <tr>
                                                                <td><?=$name;?></td>
                                                                <td><?=$price." Fg";?></td>
                                                                <td><?=($description==null) ? "Pas de description" : $description;?></td>
                                                                <td class="">
                                                                    <img  src="../../image/platImages/<?=$image;?>" alt="<?=$image;?>" width="60" height="60">
                                                                </td>
                                                                <td><a class="error" href="modification.php?modifier=<?=$id;?>">Modifer</a></td>
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
    require_once("restaurantAdminFooter.php");
?>