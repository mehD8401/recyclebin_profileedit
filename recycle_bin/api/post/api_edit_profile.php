<?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../model/model_edit_profile.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $post = new model_edit_profile($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if (isset($_POST["email"], $_POST['name'], $_POST['address'], $_POST['description'], $_POST['phone'],  $_POST['profile_pht'] )){
        $name = $_POST['name'];
        $email = $_POST["email"];
        $address = $_POST['address'];
        $description = $_POST['description'];
        $phone = $_POST['phone'];
        $profile_pht = $_POST['profile_pht'];

        if ($post->edit($email, $name, $address, $description, $phone, $profile_pht)){
            echo "true";
        } else {
            echo "failed";

        }
    }else{
        
        echo "\$_post failed";
    }
