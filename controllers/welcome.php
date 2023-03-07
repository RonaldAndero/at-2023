<?php namespace Halo;

use Aastategija\Questions;

class welcome extends Controller
{

    // does not require a logged in user
    public $requires_auth = false;

    function index()
    {

        // set welcome page to true
        $this->welcome = true;

        // handle redirection if necessary
        if (isset($_SESSION['practical']) || (isset($_SESSION['user_id']) && Questions::getResult($_SESSION['user_id']) >= 0)) {
            header('Location: test/practical');
            exit();
        } else if (isset($_SESSION['theoretical'])) {
            header('Location: test');
            exit();
        }

        // get the users from database
        $this->users = get_all("SELECT * FROM users");

    }


    function AJAX_register()
    {

        // if any of the field is empty
        if (empty($_POST['firstName'] || $_POST['lastName'] || $_POST['social_id'] || $_POST['password'])) {
            exit('Error. Missing required parameters.');
        }

        // if test is closed
        if (time() < strtotime($this->settings['start']) || time() > strtotime($this->settings['end'])) {
            exit('Test is closed at the moment. Please try again later.');
        }

        // if PIN is incorrect
        if ($_POST['password'] != $this->settings['pwd']) {
            exit('Invalid PIN.');
        }

        // insert user into database
        $user_id =
            insert('users', [
                'firstname' => $_POST['firstName'],
                'lastname' => $_POST['lastName'],
                'social_id' => $_POST['social_id']
            ]);

        // in case the user already exists
        if ($user_id === false) {
            $social_id = addslashes($_POST['social_id']);
            $user_id = get_one("SELECT user_id FROM users WHERE social_id = $social_id");
        }

        // insert result default values only if user does not exist
        if (empty(get_one("SELECT user_id FROM results WHERE user_id = $user_id"))) {
            insert('results', ['user_id' => $user_id]);
        }

        // in case the user has already finished the test
        if (get_first("SELECT practical_points FROM results WHERE user_id = $user_id")['practical_points'] != -2) {
            exit('Your earlier test result was already submitted.');
        }

        // define session variables
        $_SESSION['user_id'] = $user_id;
        $_SESSION['social_id'] = $_POST['social_id'];
        $_SESSION['name'] = $_POST['firstName'] . ' ' . $_POST['lastName'];

        // if OK
        echo "ok";
    }

}