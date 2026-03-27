<?php

class HomeController
{
    public function index()
    {
        $title = "Home";

        // Render view
        ob_start();
        require __DIR__ . '/../Views/home.php';
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layout.php';
    }
}
