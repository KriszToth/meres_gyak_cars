<?php
header('Content-Type: application/json');
$uri = $_SERVER["REQUEST_URI"];
$mysqli = new mysqli();
$mysqli->connect("localhost","root","root","cars");
$path = parse_url($uri)['path'];

if($path == "/cars"){
    $brand = $_GET['brand'] ?? '';
    $type = $_GET['type'] ?? '';

    $sql = "SELECT * FROM `autok` WHERE marka LIKE '%$brand%' AND modell LIKE '%$type%';";
    $resultObject = $mysqli->query($sql);
    $result = $resultObject->fetch_all(MYSQLI_ASSOC);
    
    $response = [
        'status' => 'success',
        'statusCode' => 200,
        'messsage' => 'Select Successful',
        'body' => $result
    ];

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