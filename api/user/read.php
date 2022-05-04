<?php 
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: aplication/json');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    // Instantiate DB + connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate user object
    $user = new User($db);

    $result = $user->read();

    $count = $result->rowCount();

    // echo json_encode($result);

    if($count > 0) {
        $user_arr = array();
        $user_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $user_item = array(
                'id' => $id,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'created_at' => $created_at,
            );

            array_push($user_arr['data'],$user_item);
        }

        echo json_encode($user_arr);
    } else {
        echo json_encode(
            array('message' => 'No users yet!')
        );
    }