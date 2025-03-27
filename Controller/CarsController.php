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
}

