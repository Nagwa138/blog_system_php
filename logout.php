<?php

require_once('./Controllers/Auth.php');

Auth::logout();

header('location: ./login.php');

exit();