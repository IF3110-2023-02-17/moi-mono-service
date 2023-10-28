<?php

class NotFoundController
{
    public function index(): void
    {
        $notFoundView = Utils::view("NotFound", "NotFoundView", []);
        $notFoundView->render();
    }
}