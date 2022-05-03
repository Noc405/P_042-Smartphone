<?php
/**
 * ETML
 * Auteur : Emilien Charpié
 * Date: 29.03.2022
 * Controler pour gérer les pages du shop
 */

class ShopController extends Controller {

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

        if(isset($_GET['os'])){
            $this->OS();
        }
        if(isset($_GET['constructor'])){
            $this->constructor();
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

        //Get all the constructor of phones
        $database = new Database();

        $constructors = $database->selectAllConstructors();

        $_SESSION['constructors'] = $constructors;

        $view = file_get_contents('views/pages/shop/shopHome.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Get the os that the user have selected
     *
     * @return string
     */
    private function OS() {
        if(isset($_GET['order'])){
            $resultOrder = $this->order("os", $this->GetNameOS($_GET['os']));
        }else{
            //Write an error message
        }

        $_SESSION['selectedProducts'] = $resultOrder;
    }

    /**
     * Get the constructor that the user have selected
     *
     * @return string
     */
    private function constructor() {
        if(isset($_GET['order'])){
            $resultOrder = $this->order("constructor", $_GET['constructor']);
        }else{
            //Write an error message
        }

        $_SESSION['selectedProducts'] = $resultOrder;
    }

    /**
     * Order the products
     *
     * @return string
     */
    private function order($osOrConstruct, $osOrConstructValues) {
        $database = new Database();

        //Check if the user order by os or by constructor
        if($osOrConstruct == "os"){  
            //Get all the phone by the os
            $OS = $this->GetNameOS($_GET['os']);

            if($OS != "All"){
                $products = $database->selectProductByOS($OS);
            }else{
                $products = $database->selectAllProduct();
            }

        }elseif($osOrConstruct == "constructor"){
            //Get all the phone by the constructor
            $constructor = $_GET['constructor'];

            if($constructor != "all"){
                $products = $database->selectProductByConstructor($constructor);
            }else{
                $products = $database->selectAllProduct();
            }
        }

        //Set the good value to $order and calleach method for order the products
        switch($_GET['order']){
            case 'screen':
                $products = $database->selectProductOrderByScreen($osOrConstruct, $osOrConstructValues);
                break;
            case 'autonomy':
                $products = $database->selectProductOrderByAutonomy($osOrConstruct, $osOrConstructValues);
                break;
            case 'cpu':
                $products = $database->selectProductOrderByCPU($osOrConstruct, $osOrConstructValues);
                break;
            case 'ram':
                $products = $database->selectProductOrderByCPUScreenRam($osOrConstruct, $osOrConstructValues);
                break;
            case 'priceHigh':
                $products = $database->selectProductOrderByPriceHeight($osOrConstruct, $osOrConstructValues);
                break;
                case 'priceLow':
                $products = $database->selectProductOrderByPriceLow($osOrConstruct, $osOrConstructValues);
                break;
            case 'all':
                break;
            default:
                break;
        }

        return $products;
    }

    /**
     * Get the good name of the os
     *
     * @return string
     */
    private function GetNameOS($array) {
        $database = new Database();

        //Set the good value to $OS
        switch($array){
            case 'apple':
                $OS = "iOS";
                break;
            case 'samsung':
                $OS = "Android";
                break;
            case 'windows':
                $OS = "Windows Phone";
                break;
            case 'all':
                $OS = "All";
                break;
            default:
                $OS = "All";
                break;
        }
        return $OS;
    }

}