<?php

session_start();

require('./Models/Database.php');

require('./Controllers/Controller.php');

require_once('./Requests/BaseRequest.php');

require_once('./Requests/PostCreateRequest.php');

require('./Controllers/PostController.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $data = $_POST;
    $data['image'] = $_FILES['image'];

    try {
        $result = PostController::add($data);

        if(isset($result['success']) && !$result['success'])
        {
            $_SESSION['error'] = $result['message'];
            header('location: ./post-create.php');
            exit();
        } else {
            $_SESSION['success'] = $result['message'];
            header('location: index.php');
            exit();
        }
    } catch(PDOException $e) {
        var_dump($e->getMessage());
        exit();
        header('location: error-page.php?status=502&message=Bad Gateway');
        exit();
    }
} else {
    header('location: error-page.php');
    exit();
}