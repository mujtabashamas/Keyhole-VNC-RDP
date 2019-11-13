<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/rdp.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$rdp = new Rdp($db);
 
// set ID property of record to read
$rdp->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$rdp->readOne();
 
if($rdp->ip!=null){
    // create array
    $rdp_arr=array(
        "id" => $rdp->id,
        "ip" => $rdp->ip,
        "port" => $rdp->port,
        "mime" => $rdp->mime,
        "image_data" => $rdp->image_data,
        "org" => $rdp->org,
        "city" => $rdp->city,
        "timestamp" => $rdp->timestamp
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($rdp_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Rdp does not exist."));
}
?>