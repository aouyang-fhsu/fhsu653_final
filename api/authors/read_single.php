<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require('../../config/Database.php');
    require('../../model/Authors.php');

    // Instantiante DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiante Quote
    $author = new Authors($db);

    //Get ID
    $author->id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    //Get Quote
    $author->read_single();

    //Create Array
    $author_arr = array(
        'id' => $author->id,
        'author' => $author->author
    );

    //Make JSON
    echo json_encode($author_arr);