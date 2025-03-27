<?php

require_once "Controller/CarsController.php";

header('Content-Type: application/json');
$uri = $_SERVER["REQUEST_URI"];

$path = parse_url($uri)['path'];

switch($path){
    case "/cars":
        $response = CarsController::getCars();

        http_response_code($response['statusCode']);
        echo json_encode($response);
        break;

    case "/buyCar":
        $response = CarsController::buyCar();

        http_response_code($response['statusCode']);
        echo json_encode($response);
        break;  

    default:
        $response = CarsController::getCars();

        http_response_code($response['statusCode']);
        echo json_encode($response);

        $response = [
            'status' => 'error',
            'statusCode' => 404,
            'messsage' => 'This endpoint does not exist'
        ];
        http_response_code($response['statusCode']);
        echo json_encode($response);
        break;  

    case "/addCar":
            $response = CarsController::addCar();
            http_response_code($response['statusCode']);
            echo json_encode($response);
            break;
}



// if($path == "/cars"){

//     $response = CarsController::getCars();

//     http_response_code($response['statusCode']);
//     echo json_encode($response);

// }else{
//     $response = [
//         'status' => 'error',
//         'statusCode' => 404,
//         'messsage' => 'This endpoint does not exist'
//     ];
//     http_response_code($response['statusCode']);
//     echo json_encode($response);
// }