<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
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
    $quote->quote = $data->quote;
    $quote->authorId = $data->authorId;
    $quote->categoryId = $data->categoryId;

    // Create Post
    if($quote->create()){
        echo json_encode(
            array('message' => "Quote Created")
        );
    } else {
        echo json_encode(
            array('message' => 'Quote Not Created')
        );
    }

    