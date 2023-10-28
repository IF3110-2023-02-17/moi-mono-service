<?php

class AboutPeopleView
{
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render(): void
    {
        require_once __DIR__ . "/../../component/about/AboutPeopleComponent.php";
    }
}