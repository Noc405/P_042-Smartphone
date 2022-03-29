<?php
/**
 * ETML
 * Auteur : Emilien Charpié
 * Date: 29.03.2022
 * Controler pour gérer les pages de connexion et d'inscription
 */

class LogController extends Controller {

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
    * Display signin page
    *
    * @return string
    */
    private function signinAction() {

        $view = file_get_contents('views/pages/logUsers/signin.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
    * Display login page
    *
    * @return string
    */
    private function loginAction() {

        $view = file_get_contents('views/pages/logUsers/login.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
    * Display logout page
    *
    * @return string
    */
    private function logoutAction() {

        $view = file_get_contents('views/pages/logUsers/logout.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}