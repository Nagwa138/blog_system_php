<?php

class PostController extends Controller{

    const TABLE = 'posts';

    public static function add(array $post)
    {
        $validationResult = (new PostCreateRequest())->validate($post);

        if( isset($validationResult['success']) && !$validationResult['success']) return $validationResult;

        $newPath = "./photos/".$post['image']['name'];

        move_uploaded_file($post['image']['tmp_name'],$newPath);

        $post['image'] = $newPath;

        // todo :: user -> register, login (email) -> user id

        self::getDB()->create(self::TABLE, $post);
        
        return [
            'success' => true,
            'message' => 'Post added successfully!'
        ];
    }

}