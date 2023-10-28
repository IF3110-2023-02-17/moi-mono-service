<?php

class AddDataView
{
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render(): void
    {
        require_once __DIR__ . "/../../component/addData/addDataComponent.php";
    }
}