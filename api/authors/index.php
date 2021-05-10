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

    $author->id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    // Quote query
    $result = $author->read();

    // Get Row Count
    //$num = $result->rowCount();

    //Check if any Quotes


    //Quote array
    $author_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $author_item = array(
            'id' => $id,
            'author' => $author
        );

        //push to "data"
        array_push($author_arr, $author_item);
    }

    //Turn to JSON and Output
    echo json_encode($author_arr);
    
    