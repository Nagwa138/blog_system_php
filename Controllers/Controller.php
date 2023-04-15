<?php

class Controller {

    protected static function getDB()
    {
        return new Database();
    }
}