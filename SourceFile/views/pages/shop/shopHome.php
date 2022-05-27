<div class="container py-5">
    <div class="row">

        <div class="col-lg-3">
            <h1 class="h2 pb-4">Regrouper par :</h1>
            <ul class="list-unstyled templatemo-accordion">
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        OS
                        <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul class="collapse show list-unstyled pl-3">
                        <li><a class="text-decoration-none" href="index.php?controller=shop&action=home&os=all&order=all">Tous OS confondus</a></li>
                        <li><a class="text-decoration-none" href="index.php?controller=shop&action=home&os=apple&order=all">iOS</a></li>
                        <li><a class="text-decoration-none" href="index.php?controller=shop&action=home&os=samsung&order=all">Android</a></li>
                        <li><a class="text-decoration-none" href="index.php?controller=shop&action=home&os=windows&order=all">Microsoft Phone</a></li>
                    </ul>
                </li>
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Constructeur
                        <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul id="collapseTwo" class="collapse list-unstyled pl-3">
                        <li><a class="text-decoration-none" href="index.php?controller=shop&action=home&constructor=all&order=all">Tous constructeurs confondus</a></li>
                        <?php
                        $constructors = $_SESSION['constructors'];

                        foreach ($constructors as $key => $value) {
                        ?>
                            <li><a class="text-decoration-none" href="index.php?controller=shop&action=home&constructor=<?=$constructors[$key]['conName'];?>&order=all"><?=$constructors[$key]['conName'];?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="col-lg-9">
            <div class="row flex-row-reverse">
                <div class="col-md-6 pb-4 w-50 d-flex-columns">
                    <div>
                        <h2 class="h2">Trier :</h2>
                    </div>
                    <div class="d-flex">
                        <select class="form-control listOrder">
                            <option value="all">Tout afficher</option>
                            <option value="screen" <?php if(isset($_GET['order'])){if($_GET['order'] == "screen"){echo "selected";}}?>>Taille d'ecran (plus grand au plus petit)</option>
                            <option value="autonomy" <?php if(isset($_GET['order'])){if($_GET['order'] == "autonomy"){echo "selected";}}?>>Meilleur en autonomie (plus long au plus court)</option>
                            <option value="cpu" <?php if(isset($_GET['order'])){if($_GET['order'] == "cpu"){echo "selected";}}?>>Meilleur en CPU (plus élevé au plus bas)</option>
                            <option value="ram" <?php if(isset($_GET['order'])){if($_GET['order'] == "ram"){echo "selected";}}?>>Meilleur en CPU, Taille d'écran et RAM (plus élevé au plus bas)</option>
                            <option value="priceHigh" <?php if(isset($_GET['order'])){if($_GET['order'] == "priceHigh"){echo "selected";}}?>>Prix le plus cher en premier</option>
                            <option value="priceLow" <?php if(isset($_GET['order'])){if($_GET['order'] == "priceLow"){echo "selected";}}?>>Prix le moin cher en premier</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">

            <?php
            //set an array with the session value selectedProducts
            $products = $_SESSION['selectedProducts'];

            //for all products, create a card
            foreach ($products as $key => $value) {
            ?>
                <div class="col-md-4">
                    <div class="card mb-4 product-wap rounded-0">
                        <div class="card rounded-0">
                            <div class="w-100 d-flex justify-content-around picturePhoneContent">
                                <img class="card-img rounded-0 img-fluid" src="../../../../../P_042-Smartphone/SourceFile/ressources/productsImages/<?=$products[$key]['proImg'];?>" alt="Image of the phone">
                            </div>
                            <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                <ul class="list-unstyled">
                                    <li><a class="btn btn-success text-white mt-2" href="index.php?controller=shopSingle&action=shopSingle&id=<?=$products[$key]['idProducts'];?>"><i class="far fa-eye"></i></a></li>
                                    <!-- <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i class="fas fa-cart-plus"></i></a></li> -->
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="index.php?controller=shopSingle&action=shopSingle&id=<?=$products[$key]['idProducts'];?>" class="h3 text-decoration-none">
                                <ul class="w-100 list-unstyled mb-0">
                                    <li class="mt-2"><?=$products[$key]['proName'];?></li>
                                    <li class="mt-2"><?=$products[$key]['proCategory'];?></li>
                                </ul>
                            </a>
                            <!-- star for know the appreciacions of the users -->
                            <!-- <ul class="list-unstyled d-flex justify-content-center mb-1">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                            </ul> -->
                            <p class="text-center mb-0">$<?=$products[$key]['proPrice'];?></p>
                        </div>
                    </div>
                </div>

            <?php
            //End foreach
            }
            ?>
            </div>
        </div>
    </div>
</div>