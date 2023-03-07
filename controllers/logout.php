<?php namespace Halo;

/**
 * Logout the user if <BASE_URL>/logout link is visited
 */
class logout extends Controller
{
    // does not require a logged in user
    public $requires_auth = false;

    function index()
    {
        session_destroy();
        header('Location: ' . BASE_URL);

        exit();
    }
} 