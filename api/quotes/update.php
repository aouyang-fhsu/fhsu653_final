<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require('../../config/Database.php');
    require('../../model/Quotes.php');

    // Instantiante DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiante Quote
    $quote = new Quote($db);

    // Get Posted Data
    $data = json_decode(file_get_contents("php://input"));

    $quote->id = $data->id;

    $quote->quote = $data->quote;
    $quote->authorId = $data->authorId;
    $quote->categoryId = $data->categoryId;

    // Create Post
    if($quote->update()){
        echo json_encode(
            array('message' => "Quote Updated")
        );
    } else {
        echo json_encode(
            array('message' => 'Quote Not Updated')
        );
    }

    