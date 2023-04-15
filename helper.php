<?php

function isAuth()
{
    return isset($_COOKIE['user']);
}