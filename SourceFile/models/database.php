<?php

/**
 * 
 * Auteur : Emilien Charpié
 * Date : 29.03.2022
 * Description :  File that take the informations from the database
 */

include '../../UserContent/usersInfos/userInfos.php';

class Database {
    
    
    // Variable de classe
    private $connector;
    private $connexionValues;


    public function __construct(){
        //Get the values from the php file for the pdo
        $connexion = new connexionValues();
        $this->connexionValues = $connexion->getValues();

        //Get the value from the json file for the password
        $Json = file_get_contents("../../UserContent/usersInfos/password.json");
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
     * Set an array with all the user in the db
     * @return array
     */
    public function getAllTeachers(){
        // Recover the id, the firstname, the name and the nickname of all the teachers 
        $queryRequest = "SELECT idTeacher, teaFirstname, teaName, teaNickname FROM `t_teacher`";
        // Set an array with the values
        $teachers = $this->querySimpleExecute($queryRequest);
        // Return the array
        return $teachers;
    }

    /**
     * Get one teacher from the database with the id
     * @return array
     */
    public function getOneTeacher($id){
        // Recover the id, the firstname, the name and the nickname of all the teachers 
        $queryRequest = "SELECT idTeacher, teaFirstname, teaName, teaGender, fkSection, teaNickname, teaOrigine, t_section.secName FROM `t_teacher` 
        INNER JOIN t_section ON t_teacher.fkSection = t_section.idSection
        WHERE idTeacher=:idTeacher";
        //Do the array with binds
        $arrayBinds = array(
            array("varName" => "idTeacher", "value" => $id, "type" => PDO::PARAM_INT)
        );
        // Set an array with the values
        $teacher = $this->queryPrepareExecute($queryRequest, $arrayBinds);
        // Return the array
        return $teacher;
    }

    /**
     * Get all the section
     * @return array
     */
    public function getAllSections(){
        // Recover the id, the firstname, the name and the nickname of all the teachers 
        $sectionsQuery = "SELECT idSection, secName FROM `t_section`";
        //Do the prepare query
        $section = $this->querySimpleExecute($sectionsQuery);
        // Return the array
        return $section;
    }

    /**
     * Get the users with the login entered
     * @return array
     */
    public function getAUser($loginUser){
        // Recover the id, the firstname, the name and the nickname of all the teachers 
        $usersQuery = "SELECT usePassword, useLogin, useAdministrator, idUser FROM `t_user` WHERE useLogin = :userLogin";
        //Do the binds array
        $arrayBinds = array(
            0 => array("varName" => "userLogin", "value" => $loginUser, "type" => PDO::PARAM_STR)
        );
        //Do the prepare query
        $user = $this->queryPrepareExecute($usersQuery, $arrayBinds);
        // Return the array
        return $user;
    }

    /**
     * Insert a teacher to the database
     */
    public function addTeacher($Firstname, $Name, $Gender, $Nickname, $Origin, $Section){
        // Recover the id, the firstname, the name and the nickname of all the teachers 
        $InsertQuery = "INSERT INTO `t_teacher` (`idTeacher`, `teaFirstname`, `teaName`, `teaGender`, `teaNickname`, `teaOrigine`, `fkSection`) VALUES (NULL, :Firstname, :Name, :Gender, :Nickname, :Origine, :Section);";
        //Create the table for the prepare query
        $arrayWithBinds = array(
            0 => array("varName" => "Firstname", "value" => $Firstname, "type" => PDO::PARAM_STR),
            1 => array("varName" => "Name", "value" => $Name, "type" => PDO::PARAM_STR),
            2 => array("varName" => "Gender", "value" => $Gender, "type" => PDO::PARAM_STR),
            3 => array("varName" => "Nickname", "value" => $Nickname, "type" => PDO::PARAM_STR),
            4 => array("varName" => "Origine", "value" => $Origin, "type" => PDO::PARAM_STR),
            5 => array("varName" => "Section", "value" => $Section, "type" => PDO::PARAM_INT)
        );
        //Do the query prepare
        $this->queryPrepareExecute($InsertQuery, $arrayWithBinds);
    }

    /**
     * Update a teacher
     */
    public function updateTeacher($id, $Firstname, $Name, $Gender, $Nickname, $Origin, $Section){
        // Recover the id, the firstname, the name and the nickname of all the teachers 
        $InsertQuery = "UPDATE `t_teacher` SET teaFirstname = :Firstname, teaName = :Name, teaGender = :Gender, teaNickname = :Nickname, teaOrigine = :Origine, fkSection = :Section WHERE idTeacher = :idTeacher";
        //Create the array for the prepare query
        $arrayWithBinds = array(
            0 => array("varName" => "Firstname", "value" => $Firstname, "type" => PDO::PARAM_STR),
            1 => array("varName" => "Name", "value" => $Name, "type" => PDO::PARAM_STR),
            2 => array("varName" => "Gender", "value" => $Gender, "type" => PDO::PARAM_STR),
            3 => array("varName" => "Nickname", "value" => $Nickname, "type" => PDO::PARAM_STR),
            4 => array("varName" => "Origine", "value" => $Origin, "type" => PDO::PARAM_STR),
            5 => array("varName" => "Section", "value" => $Section, "type" => PDO::PARAM_INT),
            6 => array("varName" => "idTeacher", "value" => $id, "type" => PDO::PARAM_INT)
        );
        //Do the query prepare
        $this->queryPrepareExecute($InsertQuery, $arrayWithBinds);
    }

    /**
     * Delete a teacher
     */
    public function deleteTeacher($id){
        // Set the query to delete the teacher
        $DeleteQuery = "DELETE FROM `t_teacher` WHERE idTeacher = :idTeacher;";
        //Create the array for the prepare query
        $arrayWithBinds = array(
            array("varName" => "idTeacher", "value" => $id, "type" => PDO::PARAM_INT)
        );
        //Do the query prepare
        $this->queryPrepareExecute($DeleteQuery, $arrayWithBinds);
    }
 }
?>