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
    $category = new Categories($db);

    $category->id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    // Quote query
    $result = $category->read();

    //Quote array
    $categories_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $categories_item = array(
            'id' => $id,
            'category' => $category
        );

        //push to "data"
        array_push($categories_arr, $categories_item);
    }

    //Turn to JSON and Output
    echo json_encode($categories_arr);
    
    