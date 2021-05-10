<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require('../../config/Database.php');
    require('../../model/Categories.php');

    // Instantiante DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiante Quote
    $category = new Categories($db);

    // Get Posted Data
    $data = json_decode(file_get_contents("php://input"));

    $category->category = $data->category;
    $category->id = $data->id;
        
    // Create Post
    if($category->update()){
        echo json_encode(
            array('message' => "Category Updated")
        );
    } else {
        echo json_encode(
            array('message' => 'Category Not Updated')
        );
    }

    