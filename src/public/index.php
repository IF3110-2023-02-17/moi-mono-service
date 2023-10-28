<?php

require_once '../app/init.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();

    $currTime = time();
    $_SESSION['created_at'] = $currTime;
    $_SESSION['updated_at'] = $currTime;
}

$app = new App();