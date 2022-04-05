<?php

class connexionValues {
    private $host = "localhost";
    private $user = 'userForDB_Smartphone';
    private $dbname = "db_smartphones";

    public function getValues(){
        $values = array("host"=>$this->host, "user"=>$this->user, "dbname"=>$this->dbname);
        return $values;
    }
}
?>