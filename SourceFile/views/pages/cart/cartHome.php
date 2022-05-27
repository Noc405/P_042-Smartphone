<div class="row d-flex justify-content-around mt-5 mb-5">

<?php
//set an array with the session value selectedProducts
$products = $_SESSION['cart'];

if(count($products) >= 1){
    //for all products, create a card
    foreach ($products as $key => $value) {
    ?>
        <div class="w-75">
            <div class="card mb-4 product-wap rounded-0 d-flex flex-row">
                <div class="card rounded-0">
                    <div class="d-flex flex-column vertical-align-center justify-content-around picturePhoneContentCart">
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
                    <a class="h3 w-100 h-auto mt-5 text-decoration-none" href="index.php?controller=shopSingle&action=shopSingle&id=<?=$products[$key]['idProducts'];?>">
                        <ul class="list-unstyled mb-0 text-center w-100 d-flex justify-content-around">
                            <li class="text-center"><?=$products[$key]['proName'];?></li>
                            <li class="text-center"><?=$products[$key]['proCategory'];?></li>
                            <p class="text-center">$<?=$products[$key]['proPrice'] * $products[$key]['carQuantity'];?></p>
                        </ul>
                    </a>
                    <div class="w-100 d-flex justify-content-around">
                        <div>
                            <form class="d-flex w-100" action="index.php?controller=cart&action=setQuantity" method="post">
                            <input type="hidden" name="productId" value="<?=$products[$key]['idProducts'];?>">
                                <p class="text-center me-2">Quantité :</p>
                                <input type="submit" name="btnAdd" class="btn btn-secondary me-2 h-25" value="+">
                                <p class="mt-2"><?=$products[$key]['carQuantity'];?></p>
                                <input type="submit" name="btnRemove" class="btn btn-secondary ms-2 h-25" value="-">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
    //End foreach
    }
//End if(count($products) >= 1)
}else{
    ?>
    <h1 class="w-100 text-center mb-5">Votre panier est vide</h1>
    <a class="text-success w-100 text-center" href="index.php?controller=shop&action=home&os=all&order=all">Acheter des produits</a>
    <?php
}
?>
</div>