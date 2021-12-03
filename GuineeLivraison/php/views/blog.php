<?php 
    session_start();
    $title = "Panier-BP";
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
                    <li><a href="panier.php">Panier</a></li>
                </ul>
                <div class="row">
                    <aside id="column-left" class="col-sm-3 hidden-xs">
                        <div class="box">
                            <div class="box-heading">Mon Compte</div>
                            <div class="list-group">
                                <a href="panier.php" class="list-group-item">Mon Panier </a>
                                <a href="#" class="list-group-item">Mes commandes </a> 
                            </div>
                        </div>
                    </aside>
                    <div id="content" class="col-sm-9">
                        <h1>Blog</h1>
                    </div>
                </div>
            </div>
            
        </section>

    <?php
    require_once("../includes/footer.php");
?>