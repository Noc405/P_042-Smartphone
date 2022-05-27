<?php
/**
 * ETML
 * Auteur : Emilien Charpié
 * Date: 03.05.2022
 * Controler pour gérer l'ajout au panier'
 */

class CartController extends Controller {

    /**
     * Dispatch current action
     *
     * @return mixed
     */
    public function display() {

        if(isset($_GET['action'])){
            $action = $_GET['action'] . "Action";
        }else{
            $action = "NoAction";
        }

        // Call a method in this class
        try {
            return call_user_func(array($this, $action));
        } catch (\Throwable $th) {
            return call_user_func(array($this, "addToCartAction"));
        }
    }

    /**
     * Add to cart and display the shop page
     *
     * @return string
     */
    private function seeCartAction() {
            $view = file_get_contents('views/pages/cart/cartHome.php');
    
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();
    
            return $content;
    }

    /**
     * Add to cart and display the shop page
     *
     * @return string
     */
    private function addToCartAction() {
        if(isset($_SESSION['id'])){
            if(isset($_POST['btnSubmit'])){
                extract($_POST);

                //Create the object database
                $database = new Database();
                
                //Insert a product to the cart
                $database->addAProductToCart($productId, $_SESSION['id']);

                //Select the products in the cart
                $productsInCart = $database->SelectAllProductInCart($_SESSION['id']);
                //Set the session variables
                $_SESSION['cart'] = $productsInCart;

                //Show the shop page
                $view = file_get_contents('views/pages/shop/shopHome.php');
        
                ob_start();
                eval('?>' . $view);
                $content = ob_get_clean();
        
                return $content;
            }else{
                header("Location:index.php?controller=home&action=home");
            }

        }else{
            header("Location:index.php?controller=logUsers&action=login&error=2");
        }
    }

    /**
     * Set the quantity, one more or one less
     *
     * @return string
     */
    private function setQuantityAction() {
        if(isset($_SESSION['id'])){
            if(isset($_POST['btnAdd'])){
                extract($_POST);

                //Create the object database
                $database = new Database();
                
                //Insert a product to the cart
                $database->plusProductToCart($productId, $_SESSION['id']);

                //Select the products in the cart
                $productsInCart = $database->SelectAllProductInCart($_SESSION['id']);
                //Set the session variables
                $_SESSION['cart'] = $productsInCart;

                //Redirect the user to the cart
                header("Location:index.php?controller=cart&action=seeCart");
                
            }elseif(isset($_POST['btnRemove'])){
                extract($_POST);

                //Create the object database
                $database = new Database();
                
                //Insert a product to the cart
                $database->minusProductToCart($productId, $_SESSION['id']);

                //Select the products in the cart
                $productsInCart = $database->SelectAllProductInCart($_SESSION['id']);
                //Set the session variables
                $_SESSION['cart'] = $productsInCart;

                //Redirect the user to the cart
                header("Location:index.php?controller=cart&action=seeCart");

            }else{
                header("Location:index.php?controller=home&action=home");
            }

        }else{
            header("Location:index.php?controller=logUsers&action=login&error=2");
        }
    }
}