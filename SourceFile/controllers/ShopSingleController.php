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

        $action = $_GET['action'] . "Action";

        return call_user_func(array($this, $action));
    }

    /**
     * Display the home page
     *
     * @return string
     */
    private function shopSingleAction() {
        $database = new Database();

        $product = $database->selectOneProduct($_GET['id']);

        $_SESSION['singleProduct'] = $product;

        $view = file_get_contents('views/pages/shopSingle/shopSingle.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}