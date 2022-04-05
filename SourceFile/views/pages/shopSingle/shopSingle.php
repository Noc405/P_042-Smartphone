<?php
$product = $_SESSION['singleProduct'];
?>
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="card-img rounded-0 img-fluid d-flex justify-content-around contentSinglePhoneImage">
                    <img class="card-img img-fluid" src="../../../../../P_042-Smartphone/SourceFile/ressources/productsImages/<?=$product[0]['proImg'];?>" alt="Image of the phone" id="product-detail">
                </div>
                <div class="row">
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2"><?=$product[0]['proName'];?> <?=$product[0]['proCategory'];?></h1>
                        <p class="h3 py-2">$<?=$product[0]['proPrice'];?></p>
                        <!-- <p class="py-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <span class="list-inline-item text-dark">Rating 4.8 | 36 Comments</span>
                        </p> -->
                        <!-- <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Brand:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong>Easy Wear</strong></p>
                            </li>
                        </ul> -->

                        <h6>Description:</h6>
                        <p><?=$product[0]['proDescription'];?></p>
                        <!-- <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Avaliable Color :</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong>White / Black</strong></p>
                            </li>
                        </ul> -->
                        <h6>Constructeur :</h6>
                        <ul class="list-unstyled pb-3">
                            <li><?=$product[0]['conName'];?></li>
                        </ul>

                        <h6>Détails :</h6>
                        <ul class="list-unstyled pb-3">
                            <li>Système d'exploitation : <?=$product[0]['proOS'];?> <?=$product[0]['proOSVersion'];?></li>
                            <li>Autonomie : environ <?=$product[0]['proAutonomy'];?> ans</li>
                            <li>Taille de l'ecran (diagonale) : <?=$product[0]['proSize'];?> "</li>
                        </ul>

                        <h6>Spécifications techniques :</h6>
                        <ul class="list-unstyled pb-3">
                            <li>Mémoire vive : <?=$product[0]['proRam'];?> Go</li>
                            <li>Fréquence du processeur : <?=$product[0]['proFrequence'];?> GHz</li>
                            <li>Nombre de coeurs : <?=$product[0]['proNbHearts'];?></li>
                        </ul>
                        <form action="" method="GET">
                            <input type="hidden" name="product-title" value="<?=$product[0]['proName'];?>">
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item text-right">
                                            Quantity : 
                                        </li>
                                        <li class="list-inline-item"><span class="btn btn-secondary" id="btn-minus">-</span></li>
                                        <li class="list-inline-item"><span class="mx-2" id="var-value">1</span></li>
                                        <li class="list-inline-item"><span class="btn btn-secondary" id="btn-plus">+</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="submit" value="buy">Buy</button>
                                </div>
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="submit" value="addtocard">Add To Cart</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Close Content -->