<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require('../../config/Database.php');
    require('../../model/Authors.php');

    // Instantiante DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiante Quote
    $Author = new Authors($db);

    // Get Posted Data
    $data = json_decode(file_get_contents("php://input"));
    $Author->author = $data->author;

    // Create Post
    if($Author->create()){
        echo json_encode(
            array('message' => "Author Created")
        );
    } else {
        echo json_encode(
            array('message' => 'Author Not Created')
        );
    }

    