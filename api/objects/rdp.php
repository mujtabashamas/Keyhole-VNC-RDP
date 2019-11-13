<?php
class Rdp{
 
    // database connection and table name
    private $conn;
    private $table_name = "rdp";
 
    // object properties
    public $id;
    public $ip;
    public $port;
    public $asn;
    public $isp;
    public $city;
    public $region_code;
    public $area_code;
    public $country_code;
    public $postal_code;
    public $country_name;
    public $latitude;
    public $longitude;
    public $timestamp;
    public $org;
    public $mime;
    public $image_data;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
    
        // select all query
        $query = "SELECT `id`, `ip`, `port`, `asn`, `isp`, `city`, `region_code`, `area_code`, `country_code`, `postal_code`, `country_name`, `latitude`, `longitude`, `timestamp`, `org`, `mime`, `image_data` 
                    FROM " . $this->table_name;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query = "SELECT `id`, `ip`, `port`, `asn`, `isp`, `city`, `region_code`, `area_code`, `country_code`, `postal_code`, `country_name`, `latitude`, `longitude`, `timestamp`, `org`, `mime`, `image_data` 
        FROM " . $this->table_name . " WHERE
                `id` = ?
            LIMIT
                0,1";

    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //print_r($row);
    
        // set values to object properties
        $this->ip = $row['ip'];
        $this->port = $row['port'];
        $this->mime = $row['mime'];
        $this->image_data = $row['image_data'];
        $this->org = $row['org'];
        $this->city = $row['city'];
        $this->timestamp = $row['timestamp'];
    }
}


