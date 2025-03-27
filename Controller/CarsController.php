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
}

