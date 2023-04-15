<?php

class RegisterRequest extends BaseRequest {

    protected function rules(array $user) {
        
        return [
            [
                'rule' => strlen($user['first_name']) < 4, 
                'message' =>'First name must be at least 4 characters'
            ],
            [
                'rule' => strlen($user['email']) < 1,
                'message' => 'Email Required'
            ],
            [
                'rule' => self::getDB()->exists('users', ['email' => $user['email']]),
                'message' => 'Email already exists!'
            ],
            [
                'rule' => strlen($user['date_of_birth']) < 1,
                'message' => 'Date of birth Required'
            ],
            [
                'rule' => strlen($user['password']) < 1, 
                'message' => 'Password Required'
            ],
            [
                'rule' => ($user['password'] !== $user['confirm']), 
                'message' => 'Passwords are not matching'
            ]
        ];
    }
}