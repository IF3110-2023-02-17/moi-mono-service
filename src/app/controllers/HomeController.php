<?php

class HomeController
{
    public function index() {
            $data['isLogin'] = false;

            try {
                $auth = Utils::middleware("Authentication");
                $auth->isUserLogin();
                $data['isLogin'] = true;
            } catch (Exception $e) {
                if ($e-> getCode() !== STATUS_UNAUTHORIZED) {
                    throw new Exception($e->getMessage(), $e->getCode());
                }
            }

            $movieModel = Utils::model('Movie');
            $data["movies"] = $movieModel->getTopMovies();
            $homeView = Utils::view("home", "HomeView", $data);
            $homeView->render();
    }
}