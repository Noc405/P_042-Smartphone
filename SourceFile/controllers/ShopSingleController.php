<?php
/**
 * ETML
 * Auteur : Emilien Charpié
 * Date: 29.03.2022
 * Controler pour gérer les pages du shop avec les détails d'un seul article
 */

class ShopSingleController extends Controller {

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
            return call_user_func(array($this, "shopSingleAction"));
        }
    }

    /**
     * Display the home page
     *
     * @return string
     */
    private function shopSingleAction() {
        $database = new Database();

        if(isset($_GET['id'])){
            $product = $database->selectOneProduct($_GET['id']);
    
            $_SESSION['singleProduct'] = $product;
    
            $view = file_get_contents('views/pages/shopSingle/shopSingle.php');
    
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();
    
            return $content;
        }else{
            header("Location:index.php?controller=home&action=home");
        }
    }
}