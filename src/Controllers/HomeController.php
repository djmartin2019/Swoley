<?php

require_once __DIR__ . '/../Core/BaseController.php';

class HomeController extends BaseController
{
    public function index()
    {
        $this->render('home', ['title' => 'Home']);
    }

    public function about()
    {
        $this->render('about', ['title' => 'About']);
    }

    public function contact()
    {
        $success = false;
        $errors  = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name    = trim($_POST['name']    ?? '');
            $email   = trim($_POST['email']   ?? '');
            $subject = trim($_POST['subject'] ?? '');
            $message = trim($_POST['message'] ?? '');

            if ($name === '')    $errors[] = 'Name is required.';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email is required.';
            if ($subject === '') $errors[] = 'Subject is required.';
            if (strlen($message) < 10) $errors[] = 'Message must be at least 10 characters.';

            if (empty($errors)) {
                /* Mail sending goes here when ready */
                $success = true;
            }
        }

        $this->render('contact', [
            'title'   => 'Contact',
            'success' => $success,
            'errors'  => $errors,
        ]);
    }
}
