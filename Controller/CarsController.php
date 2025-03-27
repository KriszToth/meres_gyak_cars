<?php

require_once __DIR__ . "/../Model/Cars.php";

class CarsController{
    static function getCars(){

        
        $brand = $_GET['brand'] ?? '';
        $type = $_GET['type'] ?? '';
    
        $result = Cars::getCars($brand,$type);

        $response = [
            'status' => 'success',
            'statusCode' => 200,
            'messsage' => 'Select Successful',
            'body' => $result
        ];
    
        return $response;
    
    }

    static function buyCar(){

        $userId = $_POST['userId'];
        $carId = $_POST['carId'];

        if(isset($userId) && isset($carId)){    
            $modelResult = Cars::buyCar($userId,$carId);

            if($modelResult["status"]){
                
            $response = [
                'status' => 'success',
                'statusCode' => 200,
                'messsage' => 'The car is bought'
            ];
        }

        else{
            $response = [
                'status' => 'success',
                'statusCode' => 500,
                'messsage' => $modelResult["message"]
            ];
        }
        } else {
            $response = [
                'status' => 'error',
                'statusCode' => 417,
                'messsage' => 'User and Car id required'
            ];
        }
        return $response;
}

static function addCar() {
    // Retrieve POST data
    $marka = $_POST['marka'] ?? '';
    $modell = $_POST['modell'] ?? '';
    $ev = $_POST['ev'] ?? '';
    $ar = $_POST['ar'] ?? '';
    $kilometerallas = $_POST['kilometerallas'] ?? '';

    // Validate required fields
    // if (empty($marka) || empty($modell) || empty($ev) || empty($ar) || empty($kilometerallas)) {
    //     return [
    //         'status' => 'error',
    //         'statusCode' => 400,
    //         'message' => 'All fields (marka, modell, ev, ar, kilometerallas) are required.'
    //     ];
    // }

    // Add the car via the model
    $result = Cars::addNewCar($marka, $modell, $ev, $ar, $kilometerallas);

    if ($result['status']) {
        return [
            'status' => 'success',
            'statusCode' => 201,
            'message' => $result['message'],
            'body' => ['insertId' => $result['insertId']]
        ];
    } else {
        return [
            'status' => 'error',
            'statusCode' => 500,
            'message' => $result['message']
        ];
    }
}
}

