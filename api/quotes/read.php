<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require('../../config/Database.php')
    require('../../model/Quotes.php')

    // Instantiante DB & Connect
    $database = new Database();
    $db = $database -> connect();

    // Instantiante Quote
    $quote = new Quotes($db);
    // Get Row Count
    $num = $result->rowCount();

    // Quote query
    $result = $quote->read();

    //Check if any Quotes

    if($num > 0){
        //Quote array
        $post_arr = array();
        $post_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $post_item = array(
                'quote_id' => $quote_id;
                'quote' => $quote;
                'author' => $author;
                'category' => $category;
            );

            //push to "data"
            array_push($push_arr['data'], $post_item);
        }

        //Turn to JSON and Output
        echo json_encode($post_arr);
    } else {
        // no quotes
        echo json_encode(
            array('Message' => "No Quotes Found")
        );
    }
    