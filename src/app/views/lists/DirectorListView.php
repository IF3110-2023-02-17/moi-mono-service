<?php

class DirectorListView
{
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render(): void
    {
        require_once __DIR__ . "/../../component/lists/DirectorListPageComponent.php";
    }
}