<?php

abstract class BaseRequest {
    
    abstract protected function rules(array $user);

    public function validate(array $user)
    {
        foreach($this->rules($user) as $item){
            $result = $this->validateInput($item);
            if(!$result['success']) return $result;
        }
    }

    protected function validateInput($item)
    {
        return [
            'success' => !$item['rule'],
            'message' => $item['rule']? $item['message'] : ''
        ];
    }

    protected function getDB()
    {
        return new Database();
    }
}