<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT, GET, DELETE, POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require('../../config/Database.php');
    require('../../model/Quotes.php');
    require('../../model/Authors.php');
    require('../../model/Categories.php');

    // Get required data from Model
    $types = TypeDB::get_types();
    $classes = ClassDB::get_classes();
    $makes = MakeDB::get_makes();

    // Get Parameter data sent to Controller
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    $firstname = filter_input(INPUT_GET, 'firstname', FILTER_SANITIZE_STRING);
    
    $make_id = filter_input(INPUT_GET, 'make_id', FILTER_VALIDATE_INT);
    $type_id = filter_input(INPUT_GET, 'type_id', FILTER_VALIDATE_INT);
    $class_id = filter_input(INPUT_GET, 'class_id', FILTER_VALIDATE_INT);
    $sort = filter_input(INPUT_GET, 'sort', FILTER_SANITIZE_STRING);
    if (!$sort) $sort = 'price';

    // Get vehicles
    $vehicles = VehicleDB::get_all_vehicles($sort);
    // Filter vehicles 
    if ($make_id) {
        $make_name = MakeDB::get_make_name($make_id);
        $vehicles = array_filter($vehicles, function($array) use ($make_name) {
            return $array["Make"] === $make_name;
        });
    }
    if ($type_id) {
        $type_name = TypeDB::get_type_name($type_id);
        $vehicles = array_filter($vehicles, function($array) use ($type_name) {
            return $array["Type"] === $type_name;
        });
    }
    if ($class_id) {
        $class_name = ClassDB::get_class_name($class_id);
        $vehicles = array_filter($vehicles, function($array) use ($class_name) {
            return $array["Class"] === $class_name;
        });
    }

    if ($firstname) { 
        $_SESSION['userid'] = $firstname;
    }

    switch($action) {
        case 'register':
            include('view/register.php');
            break;
        case 'logout':
            include('view/logout.php');
            break;
        default:
        include('view/vehicle_list.php');
    }