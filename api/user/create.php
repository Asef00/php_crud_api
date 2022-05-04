<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: aplication/json');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';

// Instantiate DB + connect
$database = new Database();
$db = $database->connect();

// Instantiate user object
$user = new User($db);

// Get Posted Data
$data = json_decode(file_get_contents('php://input'));

if ($data) {
    // each data item should be checked
    $user->firstname = $data->firstname;
    $user->lastname = $data->lastname;
    $user->email = $data->email;
}

if ($user->create()) {
    echo json_encode(
        array('message' => 'User Created!')
    );
} else {

    echo json_encode(
        array('message' => 'User Not Created!')
    );
}
