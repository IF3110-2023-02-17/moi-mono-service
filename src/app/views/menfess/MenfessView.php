<?php

class MenfessView {
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render(): void
    {
        require_once __DIR__ . "/../../component/menfess/MenfessPage.php";
    }
}