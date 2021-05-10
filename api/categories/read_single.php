<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require('../../config/Database.php');
    require('../../model/Categories.php');

    // Instantiante DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiante Quote
    $categories = new Categories($db);

    //Get ID
    $categories->id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    //Get Quote
    $categories->read_single();

    //Create Array
    $categories_arr = array(
        'id' => $categories->id,
        'category' => $categories->category
    );

    //Make JSON
    echo json_encode($categories_arr);