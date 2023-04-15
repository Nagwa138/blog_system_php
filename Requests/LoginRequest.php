<?php

class LoginRequest extends BaseRequest {

    protected function rules(array $user) {
        return [
            [
                'rule' => !$this->getDB()->exists('users', $user), 
                'message' => 'Invalid credentials!'
            ]
        ];
    }
}