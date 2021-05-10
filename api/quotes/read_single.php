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
    $quote->quote_id = isset($_GET['quote_id']) ? $_GET['quote_id'] :die();

    //Get Quote
    $quote->read_single();

    //Create Array
    $quote_arr = array(
        'quote_id' => $quote->quote_id,
        'quote' => $quote->quote,
        'author' => $quote->author,
        'category' => $quote->category
    );

    //Make JSON
    print_r(json_encode($post_arr));