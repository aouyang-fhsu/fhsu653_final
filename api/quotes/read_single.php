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

    //Get ID
    $quote->id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    //$quote->id = isset($_GET['id']) ? $_GET['id'] :die();

    //Get Quote
    $quote->read_single();

    //Create Array
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author' => $quote->author,
        'category' => $quote->category
    );

    //Make JSON
    echo json_encode($quote_arr);
