<?php

class Auth extends Controller{

    const TABLE = 'users';

    public static function register(array $user)
    {
        $validationResult = (new RegisterRequest())->validate($user);

        if(
            isset($validationResult['success']) && !$validationResult['success']
        ) return $validationResult;

        unset($user['confirm']);

        self::getDB()->create(self::TABLE, $user);
        
        unset($user['password']);

        setcookie('user', implode(',', $user), time() + 2 * 60 * 60, './');

        return [
            'success' => true,
            'message' => 'User added successfully!'
        ];
    }

    public static function login(array $user)
    {
        $validationResult = (new LoginRequest())->validate($user);

        if(
            isset($validationResult['success']) && !$validationResult['success']
        ) return $validationResult;

        unset($data['password']);

        setcookie('user', implode(',', $user), time() + 2 * 60 * 60, './');

        return [
            'success' => true,
            'message' => 'Logged in successfully!'
        ];
    }

    public static function logout()
    {
        setcookie('user', '', time() - 2 * 60 * 60, './');
    }
}