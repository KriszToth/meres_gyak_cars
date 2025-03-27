<?php

require_once "Controller/CarsController.php";

header('Content-Type: application/json');
$uri = $_SERVER["REQUEST_URI"];

$path = parse_url($uri)['path'];

if($path == "/cars"){

    $response = CarsController::getCars();

    http_response_code($response['statusCode']);
    echo json_encode($response);

}else{
    $response = [
        'status' => 'error',
        'statusCode' => 404,
        'messsage' => 'This endpoint does not exist'
    ];
    http_response_code($response['statusCode']);
    echo json_encode($response);
}