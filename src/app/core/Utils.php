<?php

class Utils
{
    public static function view($folder, $view, $data = [])
    {
        require_once __DIR__ . "/../views/$folder/$view.php";
        return new $view($data);
    }
    public static function middleware($middleware)
    {
        require_once __DIR__ . "/../middleware/$middleware.php";
        return new $middleware();
    }
    public static function model($model)
    {
        require_once __DIR__ . "/../models/$model.php";
        return new $model();
    }
}