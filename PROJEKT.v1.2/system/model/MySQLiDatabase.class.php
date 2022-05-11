<?php
require_once(SYSTEM.'exceptions/DatabaseException.class.php');

class MySQLiDatabase{
    public $MySQLi;

    protected $linkID;
    protected $host;
    protected $user;
    protected $password;
    protected $database;
    protected $charset = '';
    protected $queryCount = 0;

    function __construct($host, $user, $password, $database, $charset = 'utf8'){
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->charset = $charset;

        $this->connect();
    }

    protected function connect(){
        $this-> MySQLi = new MySQLi($this->host,$this->user,$this->password,$this->database);
        if(mysqli_connect_errno()){
            throw new DatabaseException("Spajanje na MySql server '". $this->host ."' neuspješno.");
        }
    }

    protected function selectDatabase(){
        if($this->MySQLi->select_db($this->database)===false){
            throw new DatabaseException("Nemoguće koristiti bazu ".$this->database);
        }
    }

    public function createDatabase(){
        try{
            $this->selectDatabase();
        }
        catch(DatabaseException $e){
            try{
                $this->sendQuery("CREATE DATABASE IF NOT EXISTS '".$this->database."'");
            }
            catch(DatabaseException $e2){
                throw new DatabaseException("Nemoguće kreirati bazu ".$this->database);
            }
        }
    }

    function sendQuery($query, $errorReporting = true){
        $this->queryCount++;
        $this->result = $this->MySQLi->query($query);
        if($this->result === false && $errorReporting === true){
            throw new DatabaseException("Nevaljali SQL: ".$query);
        }
        return $this->result;
    }

    function fetchArray($result) {
        return $result->fetch_array();
    }

    function escapeString($string) {
        return $this->MySQLi->real_escape_string($string);
    }
}

?>