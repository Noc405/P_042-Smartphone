<?php

class connexionValues {
    private $host = "localhost";
    private $user = 'userSmartphones';
    private $dbname = "db_smartphones";

    public function getValues(){
        $values = array("host"=>$this->host, "user"=>$this->user, "dbname"=>$this->dbname);
        return $values;
    }
}
?>