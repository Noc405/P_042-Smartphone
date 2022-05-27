<?php
session_start();
/**
 * ETML
 * Auteur : Emilien Charpié
 * Date: 29.03.2022
 * Controler pour gérer les pages de connexion et d'inscription
 * ../../../P_042-Smartphone/SourceFile/models/database.php
 */

include('models/database.php');

class LogController extends Controller {

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
            return call_user_func(array($this, "loginAction"));
        }
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

    /**
    * Display signin method
    *
    * @return string
    */
    private function checkSigninAction() {
        if(isset($_POST['btnSubmit'])){
            //Get the class Database
            $database = new Database();

            extract($_POST);

            //Check if the user correctly entered the values
            if(preg_match('/^([a-z]+|\.)+\@[a-z]+\.[a-z]+$/', $email) && 
            preg_match('/^([a-z]|[A-z]|\d|\_)+$/', $username) &&
            preg_match('/^[0-9]+$/', $age)){
                //Check if the user entered the same passwords
                if($password == $passwordConfirm){
                    //Hash password
                    $hashPass = password_hash($password, PASSWORD_BCRYPT);

                    //Insert the user
                    $database->insertUser($email, $hashPass, $username, $age);

                    //Connect the user
                    $usersFound = $database->selectUserWithEmail($email);

                    if($usersFound){
                        foreach ($usersFound as $key => $value) {
                            $passwordFromDB = $usersFound[$key]['usePassword'];
                            if($hashPass == $passwordFromDB){
                                //Select the products in the cart
                                $productsInCart = $database->SelectAllProductInCart($usersFound[$key]['idUser']);
                                //Set the session variables
                                $_SESSION['cart'] = $productsInCart;
                                $_SESSION['username'] = $usersFound[$key]['useUsername'];
                                $_SESSION['id'] = $usersFound[$key]['idUser'];
                                $_SESSION['admin'] = $usersFound[$key]['useAdministrator'];
                                header("Location:index.php?controller=home&action=home");
                            }else{
                                //Write an error message if the password is false
                            }
                        }
                    }
                }else{
                    //Write error message if the password not corresponding
                    header("Location:index.php?controller=logUsers&action=signin&error=2");
                }
            }else{
                //Write a message error if the fields have wrong inputs
                header("Location:index.php?controller=logUsers&action=signin&error=1");
            }
        }else{
            //Redirect the user to the home page if he can't see the page
            header("Location:index.php?controller=home&action=home");
        }
    }

    /**
    * Login method
    *
    * @return string
    */
    private function checkLoginAction() {
        if(isset($_POST['btnSubmit'])){
            //Get the class Database
            $database = new Database();

            extract($_POST);

            //Check if the user correctly entered the values
            if(preg_match('/^([a-z]+|\.)+\@[a-z]+\.[a-z]+$/', $email)){
                $usersFound = $database->selectUserWithEmail($email);
                
                if($usersFound){
                    foreach ($usersFound as $key => $value) {
                        $hashPass = $usersFound[$key]['usePassword'];
                        if(password_verify($password, $hashPass)){
                            //Select the products in the cart
                            $productsInCart = $database->SelectAllProductInCart($usersFound[$key]['idUser']);
                            //Set the session variables
                            $_SESSION['cart'] = $productsInCart;
                            $_SESSION['username'] = $usersFound[$key]['useUsername'];
                            $_SESSION['id'] = $usersFound[$key]['idUser'];
                            $_SESSION['admin'] = $usersFound[$key]['useAdministrator'];
                            header("Location:index.php?controller=home&action=home");
                        }else{
                            //Write an error message if the password is false
                            header("Location:index.php?controller=logUsers&action=login&error=1");
                        }
                    }
                }else{
                    //Write a message if none of the email have an account
                    header("Location:index.php?controller=logUsers&action=login&error=1");
                }
            }
        }else{
            //Redirect the user to the home page if he can't see the page
            header("Location:index.php?controller=home&action=home");
        }
    }
}