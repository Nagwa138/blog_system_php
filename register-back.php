<?php

session_start();

require('./Models/Database.php');

require_once('./Requests/BaseRequest.php');

require_once('./Requests/RegisterRequest.php');

require_once('./Controllers/Controller.php');

require('./Controllers/Auth.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $data = $_POST;

    try {
        $result = Auth::register($data);

        if(isset($result['success']) && !$result['success'])
        {
            $_SESSION['error'] = $result['message'];
            header('location: ./register.php');
            exit();
        } else {
            $_SESSION['success'] = $result['message'];
            header('location: index.php');
            exit();
        }
    } catch(PDOException $e) {
        // 502 Bad Gateway
        // 50x
        header('location: error-page.php?status=502&message=Bad Gateway');
        exit();
    }
} else {
    header('location: error-page.php');
    exit();
}