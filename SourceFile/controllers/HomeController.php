<?php
/**
 * ETML
 * Auteur : Emilien Charpié
 * Date: 29.03.2022
 * Controler pour gérer les pages de l'acceuil
 */

class HomeController extends Controller {

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
            return call_user_func(array($this, "homeAction"));
        }
    }

    /**
     * Display the home page
     *
     * @return string
     */
    private function homeAction() {

        $view = file_get_contents('views/pages/home/home.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}