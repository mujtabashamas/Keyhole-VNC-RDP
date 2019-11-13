<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/vnc.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$vnc = new Vnc($db);
 
// set ID property of record to read
$vnc->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$vnc->readOne();
 
if($vnc->ip!=null){
    // create array
    $vnc_arr=array(
        "id" => $vnc->id,
        "ip" => $vnc->ip,
        "port" => $vnc->port,
        "mime" => $vnc->mime,
        "image_data" => $vnc->image_data,
        "org" => $vnc->org,
        "city" => $vnc->city,
        "timestamp" => $vnc->timestamp
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($vnc_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Vnc does not exist."));
}
?>