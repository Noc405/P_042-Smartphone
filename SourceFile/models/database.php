<?php

/**
 * 
 * Auteur : Emilien Charpié
 * Date : 29.03.2022
 * Description :  File that take the informations from the database
 */

include 'data/userInfos/userInfos.php';

class Database {
    
    
    // Variable de classe
    private $connector;
    private $connexionValues;


    public function __construct(){
        //Get the values from the php file for the pdo
        $connexion = new connexionValues();
        $this->connexionValues = $connexion->getValues();

        //Get the value from the json file for the password
        $Json = file_get_contents("data/userInfos/passwords.json");
        // Converts to an array 
        $passwordArray = json_decode($Json, true);

        try {
            $dns = "mysql:host=".$this->connexionValues['host'].";dbname=".$this->connexionValues['dbname'].";charset=utf8";
            $this->connector = new PDO($dns, $this->connexionValues['user'], $passwordArray[0]['pass']);
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "PDOError: " . $e->getMessage()." In ".__FILE__;
        }
    }

    /**
     * Do a simple query request
     * @return array
     */
    private function querySimpleExecute($query){
        //Do a query to the connector with the parameter
        $req = $this->connector->query($query);
        //Set an array with the value
        $array = $this->formatData($req);
        // Return the array
        return $array;
    }

    /**
     * Do a prepare query with a binds
     * @return array
     */
    private function queryPrepareExecute($query, $binds){
        //Prepare the query
        $req = $this->connector->prepare($query);
        //Insert the values
        foreach ($binds as $key => $value) {
            $req->bindValue($binds[$key]['varName'], $binds[$key]['value'], $binds[$key]['type']);
        }
        //Execute the query
        $req->execute();
        //Set an array with the result
        $arrayResult = $this->formatData($req);
        //Return the array
        return $arrayResult;
    }

    /**
     * Format the result of a query in an array 
     * @return array
     */
    private function formatData($req){
        $array = $req->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }

    /**
     * Clear the record set
     */
    private function unsetData($req){

        // Clear Record Set
        $req->closeCursor();
    }

    /**
     * Insert a user to the database
     */
    public function insertUser($email, $password, $username, $age){
        // Get the informations of the user
        $queryRequest = "INSERT INTO `t_users` (`useEmail`, `usePassword`, `useUsername`, `useAge`)
        VALUES (:email, :password, :username, :age);";
        // Set an array with the binds values
        $arrayBinds = array(
            array("varName" => "email", "value" => $email, "type" => PDO::PARAM_STR),
            array("varName" => "password", "value" => $password, "type" => PDO::PARAM_STR),
            array("varName" => "username", "value" => $username, "type" => PDO::PARAM_STR),
            array("varName" => "age", "value" => $age, "type" => PDO::PARAM_INT)
        );
        // Do the prepare request
        $this->queryPrepareExecute($queryRequest, $arrayBinds);
    }

    /**
     * Select a user with the email
     */
    public function selectUserWithEmail($email){
        // Get the informations of the user
        $queryRequest = "SELECT idUser, useUsername, useAge, usePassword, useAdministrator FROM t_users WHERE useEmail=:email";
        // Set an array with the binds values
        $arrayBinds = array(
            array("varName" => "email", "value" => $email, "type" => PDO::PARAM_STR)
        );
        // Execute the request
        $usersReturned = $this->queryPrepareExecute($queryRequest, $arrayBinds);
        //return the array
        return $usersReturned;
    }

    /**
     * Get all the smartphone with a specifical os
     */
    public function selectProductByOS($OS){
        // Get the informations of the phones
        $queryRequest = "SELECT * FROM t_products WHERE proOS=:os";
        // Set an array with the binds values
        $arrayBinds = array(
            array("varName" => "os", "value" => $OS, "type" => PDO::PARAM_STR)
        );
        // Execute the request
        $PhoneReturned = $this->queryPrepareExecute($queryRequest, $arrayBinds);
        //return the array
        return $PhoneReturned;
    }

    /**
     * Get all the smartphone with a specifical constructor
     */
    public function selectProductByConstructor($constructor){
        // Get the informations of the phones
        $queryRequest = "SELECT * FROM t_products
        INNER JOIN t_constructor ON t_constructor.idConstructor = t_products.fkConstructor
        WHERE conName=:constructor";
        // Set an array with the binds values
        $arrayBinds = array(
            array("varName" => "constructor", "value" => $constructor, "type" => PDO::PARAM_STR)
        );
        // Execute the request
        $PhoneReturned = $this->queryPrepareExecute($queryRequest, $arrayBinds);
        //return the array
        return $PhoneReturned;
    }
    
    /**
     * Get all the smartphone with a specifical constructor or os and order it by price
     */
    public function selectProductOrderByPriceLow($osOrConstructor, $osOrConstructValue){
        //Get the phones with a constructor or an os
        if($osOrConstructor == "os"){
            //Check if the os is "all" and if it's remove the WHERE clause
            if($osOrConstructValue == "All"){
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                ORDER BY proPrice ASC
                LIMIT 1";
                // Execute the request
                $PhoneReturned = $this->querySimpleExecute($queryRequestOrdered);
            }else{
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                WHERE proOS = :os
                ORDER BY proPrice ASC
                LIMIT 1";
                // Set an array with the binds values
                $arrayBinds = array(
                    array("varName" => "os", "value" => $osOrConstructValue, "type" => PDO::PARAM_STR)
                );
                // Execute the request
                $PhoneReturned = $this->queryPrepareExecute($queryRequestOrdered, $arrayBinds);
            }
        }elseif($osOrConstructor == "constructor"){
            //Check if the constructor is "all" and if it's remove the WHERE clause
            if($osOrConstructValue == "all"){
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                INNER JOIN t_constructor ON t_constructor.idConstructor = t_products.fkConstructor
                ORDER BY proPrice ASC
                LIMIT 1";
                // Execute the request
                $PhoneReturned = $this->querySimpleExecute($queryRequestOrdered);
            }else{
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                INNER JOIN t_constructor ON t_constructor.idConstructor = t_products.fkConstructor
                WHERE conName=:constructor
                ORDER BY proPrice ASC
                LIMIT 1";
                // Set an array with the binds values
                $arrayBinds = array(
                    array("varName" => "constructor", "value" => $osOrConstructValue, "type" => PDO::PARAM_STR)
                );
                // Execute the request
                $PhoneReturned = $this->queryPrepareExecute($queryRequestOrdered, $arrayBinds);
            }
        }
        //return the array
        return $PhoneReturned;
    }

    /**
     * Get all the smartphone with a specifical constructor or os and order it by price
     */
    public function selectProductOrderByPriceHeight($osOrConstructor, $osOrConstructValue){
        //Get the phones with a constructor or an os
        if($osOrConstructor == "os"){
            //Check if the os is "all" and if it's remove the WHERE clause
            if($osOrConstructValue == "All"){
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                ORDER BY proPrice DESC
                LIMIT 3";
                // Execute the request
                $PhoneReturned = $this->querySimpleExecute($queryRequestOrdered);
            }else{
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                WHERE proOS = :os
                ORDER BY proPrice DESC
                LIMIT 3";
                // Set an array with the binds values
                $arrayBinds = array(
                    array("varName" => "os", "value" => $osOrConstructValue, "type" => PDO::PARAM_STR)
                );
                // Execute the request
                $PhoneReturned = $this->queryPrepareExecute($queryRequestOrdered, $arrayBinds);
            }
        }elseif($osOrConstructor == "constructor"){
            //Check if the constructor is "all" and if it's remove the WHERE clause
            if($osOrConstructValue == "all"){
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                INNER JOIN t_constructor ON t_constructor.idConstructor = t_products.fkConstructor
                ORDER BY proPrice DESC
                LIMIT 3";
                // Execute the request
                $PhoneReturned = $this->querySimpleExecute($queryRequestOrdered);
            }else{
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                INNER JOIN t_constructor ON t_constructor.idConstructor = t_products.fkConstructor
                WHERE conName=:constructor
                ORDER BY proPrice DESC
                LIMIT 3";
                // Set an array with the binds values
                $arrayBinds = array(
                    array("varName" => "constructor", "value" => $osOrConstructValue, "type" => PDO::PARAM_STR)
                );
                // Execute the request
                $PhoneReturned = $this->queryPrepareExecute($queryRequestOrdered, $arrayBinds);
            }
        }
        //return the array
        return $PhoneReturned;
    }

    /**
     * Get all the smartphone with a specifical constructor or os and order it by the screen size
     */
    public function selectProductOrderByScreen($osOrConstructor, $osOrConstructValue){
        //Get the phones with a constructor or an os
        if($osOrConstructor == "os"){
            //Check if the os is "all" and if it's remove the WHERE clause
            if($osOrConstructValue == "All"){
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                ORDER BY proSize DESC";
                // Execute the request
                $PhoneReturned = $this->querySimpleExecute($queryRequestOrdered);
            }else{
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                WHERE proOS = :os
                ORDER BY proSize DESC";
                // Set an array with the binds values
                $arrayBinds = array(
                    array("varName" => "os", "value" => $osOrConstructValue, "type" => PDO::PARAM_STR)
                );
                // Execute the request
                $PhoneReturned = $this->queryPrepareExecute($queryRequestOrdered, $arrayBinds);
            }
        }elseif($osOrConstructor == "constructor"){
            //Check if the constructor is "all" and if it's remove the WHERE clause
            if($osOrConstructValue == "all"){
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                INNER JOIN t_constructor ON t_constructor.idConstructor = t_products.fkConstructor
                ORDER BY proSize DESC";
                // Execute the request
                $PhoneReturned = $this->querySimpleExecute($queryRequestOrdered);
            }else{
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                INNER JOIN t_constructor ON t_constructor.idConstructor = t_products.fkConstructor
                WHERE conName=:constructor
                ORDER BY proSize DESC";
                // Set an array with the binds values
                $arrayBinds = array(
                    array("varName" => "constructor", "value" => $osOrConstructValue, "type" => PDO::PARAM_STR)
                );
                // Execute the request
                $PhoneReturned = $this->queryPrepareExecute($queryRequestOrdered, $arrayBinds);
            }
        }
        //return the array
        return $PhoneReturned;
    }

    /**
     * Get all the smartphone with a specifical constructor or os and order it by the autonomy duration
     */
    public function selectProductOrderByAutonomy($osOrConstructor, $osOrConstructValue){
        //Get the phones with a constructor or an os
        if($osOrConstructor == "os"){
            //Check if the os is "all" and if it's remove the WHERE clause
            if($osOrConstructValue == "All"){
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                ORDER BY proAutonomy DESC
                LIMIT 5";
                // Execute the request
                $PhoneReturned = $this->querySimpleExecute($queryRequestOrdered);
            }else{
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                WHERE proOS = :os
                ORDER BY proAutonomy DESC
                LIMIT 5";
                // Set an array with the binds values
                $arrayBinds = array(
                    array("varName" => "os", "value" => $osOrConstructValue, "type" => PDO::PARAM_STR)
                );
                // Execute the request
                $PhoneReturned = $this->queryPrepareExecute($queryRequestOrdered, $arrayBinds);
            }
        }elseif($osOrConstructor == "constructor"){
            //Check if the constructor is "all" and if it's remove the WHERE clause
            if($osOrConstructValue == "all"){
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                INNER JOIN t_constructor ON t_constructor.idConstructor = t_products.fkConstructor
                ORDER BY proAutonomy DESC
                LIMIT 5";
                // Execute the request
                $PhoneReturned = $this->querySimpleExecute($queryRequestOrdered);
            }else{
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                INNER JOIN t_constructor ON t_constructor.idConstructor = t_products.fkConstructor
                WHERE conName=:constructor
                ORDER BY proAutonomy DESC
                LIMIT 5";
                // Set an array with the binds values
                $arrayBinds = array(
                    array("varName" => "constructor", "value" => $osOrConstructValue, "type" => PDO::PARAM_STR)
                );
                // Execute the request
                $PhoneReturned = $this->queryPrepareExecute($queryRequestOrdered, $arrayBinds);
            }
        }
        //return the array
        return $PhoneReturned;
    }

    /**
     * Get all the smartphone with a specifical constructor or os and order it by the nb of hearth * frequence
     */
    public function selectProductOrderByCPU($osOrConstructor, $osOrConstructValue){
        //Get the phones with a constructor or an os
        if($osOrConstructor == "os"){
            //Check if the os is "all" and if it's remove the WHERE clause
            if($osOrConstructValue == "All"){
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                ORDER BY (proNbHearts * proFrequence) DESC
                LIMIT 10";
                // Execute the request
                $PhoneReturned = $this->querySimpleExecute($queryRequestOrdered);
            }else{
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                WHERE proOS = :os
                ORDER BY (proNbHearts * proFrequence) DESC
                LIMIT 10";
                // Set an array with the binds values
                $arrayBinds = array(
                    array("varName" => "os", "value" => $osOrConstructValue, "type" => PDO::PARAM_STR)
                );
                // Execute the request
                $PhoneReturned = $this->queryPrepareExecute($queryRequestOrdered, $arrayBinds);
            }
        }elseif($osOrConstructor == "constructor"){
            //Check if the constructor is "all" and if it's remove the WHERE clause
            if($osOrConstructValue == "all"){
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                INNER JOIN t_constructor ON t_constructor.idConstructor = t_products.fkConstructor
                ORDER BY (proNbHearts * proFrequence) DESC
                LIMIT 10";
                // Execute the request
                $PhoneReturned = $this->querySimpleExecute($queryRequestOrdered);
            }else{
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                INNER JOIN t_constructor ON t_constructor.idConstructor = t_products.fkConstructor
                WHERE conName=:constructor
                ORDER BY (proNbHearts * proFrequence) DESC
                LIMIT 10";
                // Set an array with the binds values
                $arrayBinds = array(
                    array("varName" => "constructor", "value" => $osOrConstructValue, "type" => PDO::PARAM_STR)
                );
                // Execute the request
                $PhoneReturned = $this->queryPrepareExecute($queryRequestOrdered, $arrayBinds);
            }
        }
        //return the array
        return $PhoneReturned;
    }

    /**
     * Get all the smartphone with a specifical constructor or os and order it by the screen size, the nb of hearth * frequence and the RAM
     */
    public function selectProductOrderByCPUScreenRam($osOrConstructor, $osOrConstructValue){
        //Get the phones with a constructor or an os
        if($osOrConstructor == "os"){
            //Check if the os is "all" and if it's remove the WHERE clause
            if($osOrConstructValue == "All"){
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                ORDER BY (proNbHearts * proFrequence) DESC, proRam DESC, proSize DESC
                LIMIT 5";
                // Execute the request
                $PhoneReturned = $this->querySimpleExecute($queryRequestOrdered);
            }else{
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                WHERE proOS = :os
                ORDER BY (proNbHearts * proFrequence) DESC, proRam DESC, proSize DESC
                LIMIT 5";
                // Set an array with the binds values
                $arrayBinds = array(
                    array("varName" => "os", "value" => $osOrConstructValue, "type" => PDO::PARAM_STR)
                );
                // Execute the request
                $PhoneReturned = $this->queryPrepareExecute($queryRequestOrdered, $arrayBinds);
            }
        }elseif($osOrConstructor == "constructor"){
            //Check if the constructor is "all" and if it's remove the WHERE clause
            if($osOrConstructValue == "all"){
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                INNER JOIN t_constructor ON t_constructor.idConstructor = t_products.fkConstructor
                ORDER BY (proNbHearts * proFrequence) DESC, proRam DESC, proSize DESC
                LIMIT 5";
                // Execute the request
                $PhoneReturned = $this->querySimpleExecute($queryRequestOrdered);
            }else{
                // Get the informations of the phones
                $queryRequestOrdered = "SELECT * FROM t_products
                INNER JOIN t_constructor ON t_constructor.idConstructor = t_products.fkConstructor
                WHERE conName=:constructor
                ORDER BY (proNbHearts * proFrequence) DESC, proRam DESC, proSize DESC
                LIMIT 5";
                // Set an array with the binds values
                $arrayBinds = array(
                    array("varName" => "constructor", "value" => $osOrConstructValue, "type" => PDO::PARAM_STR)
                );
                // Execute the request
                $PhoneReturned = $this->queryPrepareExecute($queryRequestOrdered, $arrayBinds);
            }
        }
        //return the array
        return $PhoneReturned;
    }

    /**
     * Get the lowest price product
     */
    public function getLowerPriceProduct(){
        // Get the informations of the phones
        $queryRequestOrdered = "SELECT * FROM t_products
        ORDER BY proPrice ASC
        LIMIT 1";
        // Execute the request
        $PhoneReturned = $this->querySimpleExecute($queryRequestOrdered);
        //return the array
        return $PhoneReturned;
    }

    /**
     * Get all the smartphone
     */
    public function selectAllProduct(){
        // Get the informations of the phones
        $queryRequest = "SELECT * FROM t_products";
        // Execute the request
        $PhoneReturned = $this->querySimpleExecute($queryRequest);
        //return the array
        return $PhoneReturned;
    }

    /**
     * Get one of the smartphone with the id
     */
    public function selectOneProduct($id){
        // Get the informations of the phones
        $queryRequest = "SELECT *, t_constructor.conName FROM t_products 
        INNER JOIN t_constructor ON t_constructor.idConstructor = t_products.fkConstructor
        WHERE idProducts=:id";
        // Set an array with the binds values
        $arrayBinds = array(
            array("varName" => "id", "value" => $id, "type" => PDO::PARAM_INT)
        );
        // Execute the request
        $PhoneReturned = $this->queryPrepareExecute($queryRequest, $arrayBinds);
        //return the array
        return $PhoneReturned;
    }

    /**
     * Get all the constructors
     */
    public function selectAllConstructors(){
        // Get the informations of the constructors
        $queryRequest = "SELECT idConstructor, conName FROM t_constructor";
        // Execute the request
        $constructors = $this->querySimpleExecute($queryRequest);
        //return the array
        return $constructors;
    }

    /**
     * Add a product to a cart
     */
    public function addAProductToCart($idProduct, $idCustomer){
        // Check if the product exists
        $queryRequest = "SELECT * FROM t_cart WHERE fkProduct=:idProduct AND fkClient=:idClient";
        // Set an array with the binds values
        $arrayBinds = array(
            array("varName" => "idProduct", "value" => $idProduct, "type" => PDO::PARAM_INT),
            array("varName" => "idClient", "value" => $idCustomer, "type" => PDO::PARAM_INT)
        );
        // Do the prepare request
        $result = $this->queryPrepareExecute($queryRequest, $arrayBinds);

        //If the product is already in this cart, add 1 to the quantity, else add it to the cart
        if($result){
            // Insert the product to the table t_cart
            $queryRequest = "UPDATE t_cart
            SET carQuantity = :quantityToUpdate
            WHERE fkProduct=:idProduct AND fkClient=:idClient";
            // Set an array with the binds values
            $arrayBinds = array(
                array("varName" => "quantityToUpdate", "value" => $result[0]['carQuantity'] + 1, "type" => PDO::PARAM_INT),
                array("varName" => "idProduct", "value" => $idProduct, "type" => PDO::PARAM_INT),
                array("varName" => "idClient", "value" => $idCustomer, "type" => PDO::PARAM_INT)
            );
            // Do the prepare request
            $this->queryPrepareExecute($queryRequest, $arrayBinds);
        }
        else{
            // Insert the product to the table t_cart
            $queryRequest = "INSERT INTO `t_cart` (`carQuantity`, `fkProduct`, `fkClient`)
            VALUES (1, :idProduct, :idClient);";
            // Set an array with the binds values
            $arrayBinds = array(
                array("varName" => "idProduct", "value" => $idProduct, "type" => PDO::PARAM_INT),
                array("varName" => "idClient", "value" => $idCustomer, "type" => PDO::PARAM_INT)
            );
            // Do the prepare request
            $this->queryPrepareExecute($queryRequest, $arrayBinds);
        }
    }
    
    /**
     * Set the quantity than one more
     */
    public function plusProductToCart($idProduct, $idCustomer){
        // Select the product
        $queryRequest = "SELECT * FROM t_cart WHERE fkProduct=:idProduct AND fkClient=:idClient";
        // Set an array with the binds values
        $arrayBinds = array(
            array("varName" => "idProduct", "value" => $idProduct, "type" => PDO::PARAM_INT),
            array("varName" => "idClient", "value" => $idCustomer, "type" => PDO::PARAM_INT)
        );
        // Do the prepare request
        $result = $this->queryPrepareExecute($queryRequest, $arrayBinds);

        // Update the product to the table t_cart
        $queryRequest = "UPDATE t_cart
        SET carQuantity = :quantityToUpdate
        WHERE fkProduct=:idProduct AND fkClient=:idClient";
        // Set an array with the binds values
        $arrayBinds = array(
            array("varName" => "quantityToUpdate", "value" => $result[0]['carQuantity'] + 1, "type" => PDO::PARAM_INT),
            array("varName" => "idProduct", "value" => $idProduct, "type" => PDO::PARAM_INT),
            array("varName" => "idClient", "value" => $idCustomer, "type" => PDO::PARAM_INT)
        );
        // Do the prepare request
        $this->queryPrepareExecute($queryRequest, $arrayBinds);
    }
    
    /**
     * Set the quantity less than one
     */
    public function minusProductToCart($idProduct, $idCustomer){
        // Select the product
        $queryRequest = "SELECT * FROM t_cart WHERE fkProduct=:idProduct AND fkClient=:idClient";
        // Set an array with the binds values
        $arrayBinds = array(
            array("varName" => "idProduct", "value" => $idProduct, "type" => PDO::PARAM_INT),
            array("varName" => "idClient", "value" => $idCustomer, "type" => PDO::PARAM_INT)
        );
        // Do the prepare request
        $result = $this->queryPrepareExecute($queryRequest, $arrayBinds);

        //Check if the product if more than 1
        if($result[0]['carQuantity'] > 1){
            // Update the product to the table t_cart
            $queryRequest = "UPDATE t_cart
            SET carQuantity = :quantityToUpdate
            WHERE fkProduct=:idProduct AND fkClient=:idClient";
            // Set an array with the binds values
            $arrayBinds = array(
                array("varName" => "quantityToUpdate", "value" => $result[0]['carQuantity'] - 1, "type" => PDO::PARAM_INT),
                array("varName" => "idProduct", "value" => $idProduct, "type" => PDO::PARAM_INT),
                array("varName" => "idClient", "value" => $idCustomer, "type" => PDO::PARAM_INT)
            );
            // Do the prepare request
            $this->queryPrepareExecute($queryRequest, $arrayBinds);
        }
    }
    
    /**
     * Add a product to a cart
     */
    public function SelectAllProductInCart($idCustomer){
        // Select the products of a cart
        $queryRequest = "SELECT * FROM t_cart 
        INNER JOIN t_products ON t_cart.fkProduct = t_products.idProducts
        WHERE fkClient=:idClient";
        // Set an array with the binds values
        $arrayBinds = array(
            array("varName" => "idClient", "value" => $idCustomer, "type" => PDO::PARAM_INT)
        );
        // Do the prepare request
        $result = $this->queryPrepareExecute($queryRequest, $arrayBinds);

        return $result;
    }
 }
?>