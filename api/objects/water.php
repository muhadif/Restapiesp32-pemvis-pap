<?php
class Water{

    // database connection and table name
    private $conn;
    private $table_name = "kuantitas_air";

    // object properties
    public $id;
    public $value;
    public $tds;
    public $date;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // select all query
        $query = "SELECT
                * from kuantitas_air";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create product
    function create(){

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                value=:value, tds=:tds";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->value=htmlspecialchars(strip_tags($this->value));
        $this->tds=htmlspecialchars(strip_tags($this->tds));



        // bind values
        $stmt->bindParam(":value", $this->value);
        $stmt->bindParam(":tds", $this->tds);


        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }
}