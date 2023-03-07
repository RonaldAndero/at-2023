<?php namespace Halo;

use Aastategija\Questions;
use Aastategija\ValidatorAPI;
use Aastategija\Tests;

class test extends Controller
{
    // theoretical test page
    function index()
    {

        // handle redirection if necessary
        if (isset($_SESSION['result'])) {
            header('Location: result');
            exit();
        } else if (isset($_SESSION['practical'])) {
            header('Location: practical');
            exit();
        } else if (Questions::getResult($_SESSION['user_id']) >= 0) {
            header('Location: test/practical');
            exit();
        }

        // catch the questions into session if it is not previously done
        if (!isset($_SESSION['questions'])) {
            $_SESSION['questions'] = Questions::get();
        }

        // get the questions if they already exist in session
        $this->questions = $_SESSION['questions'];

        // the user has started theoretical quiz
        $_SESSION['theoretical'] = true;

        // update the nr of questions user got
        update('results', [
            'nr_of_questions' => $this->settings['nr_of_questions']
        ], "user_id = '{$_SESSION['user_id']}'");

    }


    // confirm theoretical test answers and redirects user to practical test
    function practical()
    {

        // handle redirection if necessary
        if (isset($_SESSION['result'])) {
            header('Location: result');
            exit();
        }

        // check the theoretical answers if necessary (check also session variable)
        if (Questions::getResult($_SESSION['user_id']) == -1) {

            // get user answers
            $_SESSION['practical'] = true;
            $userId = (int)$_SESSION['user_id'];
            $answers = $_POST;

            // set test result
            Tests::setTestResult($answers, $userId);

        }

        // catch the practical task into session if it is not previously done
        if (!isset($_SESSION['task'])) {
            $_SESSION['task'] = Questions::getPractical();
        }

        // get the practical task if it already exist in session
        $this->practicalQuestions = $_SESSION['task'];

        // the user has started practical test
        $_SESSION['practical'] = true;

        // update table with the practical test given
        update('results', [
            'practical_id' => $_SESSION['task'][0],
        ], "user_id = '{$_SESSION['user_id']}'");

    }


    function result()
    {

        // handle redirection if necessary
        if (!isset($_SESSION['practical'])) {
            header('Location: ../');
            exit();
        }

        // define variables and set session to true
        $_SESSION['result'] = true;
        $user_id = (int)$_SESSION['user_id'];
        $social_id = $_SESSION['social_id'];

        // write the html file
        if (!empty($_POST)) {
            $html = $_POST['validateHTML'];
            Tests::writePracticalTestFile($user_id, $social_id, $html);
        }

        // if in localhost, skip HTML validator as it needs live URL... also check the setting
        if (notLocalhost() && $this->settings['htmlvalidator'] == 1) {
            ValidatorAPI::setValidatorErrors($user_id, $social_id);
        }

    }

    function finished()
    {

        // get the user id from session
        $userId = (int)$_SESSION['user_id'];

        // get theoretical test result
        $this->points = Questions::getResult($userId);

        // kill the session
        killSession();

        // redirect user to homepage after 15 seconds
        header("refresh:15;url=" . BASE_URL . "");

    }


}

