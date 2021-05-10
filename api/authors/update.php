<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require('../../config/Database.php');
    require('../../model/Authors.php');

    // Instantiante DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiante Author
    $Author = new Authors($db);

    // Get Posted Data
    
    $data = json_decode(file_get_contents("php://input"));
    $Author->author = $data->author;
    $Author->id = $data->id;
    // Create Post
    if($Author->update()){
        echo json_encode(
            array('message' => "Author Updated")
        );
    } else {
        echo json_encode(
            array('message' => 'Author Not Updated')
        );
    }

    