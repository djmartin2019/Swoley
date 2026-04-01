<?php

class BaseController
{
    /* Every controller in the app extends this class.
    That means they all get this render() method for free, 
    no need to repeat this logic in every single controller. */
    protected function render($view, $data = [])
    {
        /* Data every page needs regardless of what it is:
        is the user logged in? what's their ID?
        Instead of passing this manually every time, we inject it once here. */
        $shared = [
            'auth' => [
                'logged_in' => is_logged_in(),
                'user_id'   => current_user_id(),
            ],
        ];

        /* Merge the shared data with whatever the specific page passed in.
        Page-specific data wins if there's a key conflict. */
        $data = array_merge($shared, $data);

        /* Turn the array keys into real variables.
        e.g. $data['title'] becomes $title, $data['user'] becomes $user.
        This is what makes those variables available inside the view files. */
        extract($data);

        /* Buffer the view's output instead of printing it immediately.
        This lets us capture it as a string and slot it into the layout. */
        ob_start();
        require __DIR__ . "/../Views/{$view}.php";
        $content = ob_get_clean(); // ← $content now holds the page's HTML

        /* Load the layout shell (navbar, footer, <html> wrapper).
        It receives $content and drops it into the <main> tag. */
        require __DIR__ . "/../Views/layout.php";
    }
}
