<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./assets/img/banner_img_01.jpg" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success"><b>Nom du site</b> Vente de smartphones</h1>
                            <h3 class="h2">Subtitle</h3>
                            <p>
                                Text
                                <a rel="sponsored" class="text-success" href="#" target="_blank">Lien</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./assets/img/banner_img_02.jpg" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Title</h1>
                            <h3 class="h2">Subtitle</h3>
                            <p>
                                Text normal
                                <strong>Text en gras</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./assets/img/banner_img_03.jpg" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Title</h1>
                            <h3 class="h2">Subtitle</h3>
                            <p>
                                Text
                                <strong>Text en gras</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Banner Hero -->

<!-- Start Month Product -->
<section class="MothProducts">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Meilleur prix</h1>
                <p>
                    Smartphone vendu le moin cher en ce moment !
                </p>
            </div>
        </div>
        <?php
            $database = new Database();
            $products = $database->getLowerPriceProduct();
        ?>
        <div class="row justify-content-around">
            <div class="col-md-4">
                <div class="card mb-4 product-wap rounded-0">
                    <div class="card rounded-0">
                        <div class="w-100 d-flex justify-content-around picturePhoneContent">
                            <img class="card-img rounded-0 img-fluid" src="../../../../../P_042-Smartphone/SourceFile/ressources/productsImages/<?=$products[0]['proImg'];?>" alt="Image of the phone">
                        </div>
                        <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                            <ul class="list-unstyled">
                                <li><a class="btn btn-success text-white mt-2" href="index.php?controller=shopSingle&action=shopSingle&id=<?=$products[0]['idProducts'];?>"><i class="far fa-eye"></i></a></li>
                                <!-- <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i class="fas fa-cart-plus"></i></a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <a href="index.php?controller=shopSingle&action=shopSingle&id=<?=$products[0]['idProducts'];?>" class="h3 text-decoration-none">
                            <ul class="w-100 list-unstyled mb-0">
                                <li class="mt-2"><?=$products[0]['proName'];?></li>
                                <li class="mt-2"><?=$products[0]['proCategory'];?></li>
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
                        <p class="text-center mb-0">$<?=$products[0]['proPrice'];?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Month Product -->