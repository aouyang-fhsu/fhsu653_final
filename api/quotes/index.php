<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require('../../config/Database.php');
    require('../../model/Quotes.php');

    // Instantiante DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiante Quote
    $quote = new Quote($db);

    $quote->authorId = filter_input(INPUT_GET, 'authorId', FILTER_VALIDATE_INT);
    //echo $quote->authorId;
    $quote->categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_VALIDATE_INT);
    //echo $quote->categoryId;
    $quote->lim = filter_input(INPUT_GET, 'lim', FILTER_VALIDATE_INT);
    //echo $quote->lim;
    // Quote query
    $result = $quote->read();

    // Get Row Count
    //$num = $result->rowCount();

    //Check if any Quotes


    //Quote array
    $quote_arr = array();
    //$quote_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category
        );

        //push to "data"
        array_push($quote_arr, $quote_item);
    }

    //Turn to JSON and Output
    echo json_encode($quote_arr);
    
    