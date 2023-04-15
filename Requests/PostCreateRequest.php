<?php

class PostCreateRequest extends BaseRequest {

    protected function rules(array $post) {

        $imgExplode = explode(".", $post['image']['name']);
        $extension = end($imgExplode); 

        return [
            [
                'rule' => strlen($post['title'])  < 1,
                'message' => 'Title is required'
            ],
            [
                'rule' => strlen($post['title']) > 255,
                'message' => 'Title maximum length is 255 character'
            ],
            [
                'rule' => !$post['image'],
                'message' => 'Image is required'
            ],
            [
                'rule' => !in_array($extension ,['jpg', 'png', 'jpeg']),
                'message' => 'Image type support are jpg, png, jpeg'
            ],
            [
                'rule' => $post['image']['size'] > 10000000,
                'message' => 'Image should be less than 10M'
            ]
        ];
    }
}