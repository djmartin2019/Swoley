<?php

Class BaseController
{
    protected function render($view, $data = [])
    {
        // Shared/global variables available in ALL views
        $shared = [
            'auth' => [
                'logged_in' => is_logged_in(),
                'user_id'   => current_user_id(),
            ],
        ];

        // Merge shared + page-specific data
        $data = array_merge($shared, $data);

        // Extract variables into scope (turns array keys into variables)
        extract($data);

        // Capture view output
        ob_start();
        require __DIR__ . "/../Views/{$view}.php";
        $content = ob_get_clean();

        // Load layout (which uses $content)
        require __DIR__ . "/../Views/layout.php";
    }
}
