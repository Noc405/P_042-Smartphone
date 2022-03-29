<?php

/**
 * ETML
 * Auteur :  Emilien Charpié
 * Date: 29.03.2022
 * index du site en MVC
 */

$debug = false;

if ($debug) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}
date_default_timezone_set('Europe/Zurich');

include_once 'controllers/Controller.php';
include_once 'controllers/HomeController.php';
include_once 'controllers/LogController.php';

class MainController {

    /**
     * Permet de sélectionner le bon contrôler et l'action
     */
    public function dispatch() {

        if (!isset($_GET['controller'])) {
            $_GET['controller'] = 'home';
            $_GET['action'] = 'home';
        }


        $currentLink = $this->menuSelected($_GET['controller']);
        $this->viewBuild($currentLink);
    }

    /**
     * Selectionner la page et instancier le contrôleur
     *
     * @param string $page : page sélectionner
     * @return $link : instanciation d'un contrôleur
     */
    protected function menuSelected ($page) {

        switch($_GET['controller']){
            case 'home':
                $link = new HomeController();
                break;
            case 'logUsers':
                $link = new LogController();
                break;
            default:
                $link = new HomeController();
                break;
        }

        return $link;
    }

    /**
     * Construction de la page
     *
     * @param $currentPage : page qui doit s'afficher
     */
    protected function viewBuild($currentPage) {

            $content = $currentPage->display();

            if($currentPage == new LogController){
                include(dirname(__FILE__) . '/views/header.html');
                echo $content;
            }else{
                include(dirname(__FILE__) . '/views/header.html');
                include(dirname(__FILE__) . '/views/menu.php');
                echo $content;
                include(dirname(__FILE__) . '/views/footer.html');
            }

    }
}

/**
 * Affichage du site internet - appel du contrôleur par défaut
 */
$controller = new MainController();
$controller->dispatch();