<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../objects/water.php';

$database = new Database();
$db = $database->getConnection();

$product = new Water($db);

// get posted data
$value = $_POST["value"];
$tds = $_POST["tds"];




$data->value = $value;
$data->tds = $tds;

// make sure data is not empty
if(
    !empty($data->value) &&
    !empty($data->tds)


){

    // set product property values
    $product->value = $data->value;
    $product->tds = $data->tds;



    // create the product
    if($product->create()){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Product was created."));
    }

    // if unable to create the product, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
    echo $data->value;
}
?>