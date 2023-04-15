<?php

session_start();

require_once('./Requests/BaseRequest.php');

require_once('./Requests/LoginRequest.php');

require_once('./Models/Database.php');

require('./Controllers/Auth.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $data = $_POST;

    try {
        $result = Auth::login($data);;
        if(isset($result['success']) && !$result['success'])
        {
            $_SESSION['error'] = $result['message'];
            header('location: ./login.php');
            exit();
        } else {
            $_SESSION['success'] = $result['message'];
            header('location: index.php');
            exit();
        }
    }  catch(PDOException $e) {
        header('location: error-page.php?status=502&message=Bad Gateway');
        exit();
    }
} else {
    header('location: error-page.php');
    exit();
}