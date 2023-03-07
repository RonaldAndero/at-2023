<?php namespace Halo;

use Aastategija\Administrator;
use Aastategija\Tests;

class admin extends Controller
{
    // does not require a logged in user (login page)
    public $requires_auth = false;

    // set template to use
    public $template = 'auth';

    function AJAX_login()
    {

        // check if one of the form elements is missing
        if (empty($_POST['username'] || $_POST['password'])) {
            exit('Error. Missing required parameters.');
        }

        // clean the variables for protection against SQL injections
        $username = addslashes($_POST['username']);
        $password = addslashes($_POST['password']);

        // check the username
        $user_id = get_one("SELECT user_id FROM users WHERE user_name = '$username'");
        if (empty($user_id)) {
            exit('Invalid username or password.');
        }
        // if for some reason there is no password
        $realPassword = get_one("SELECT password FROM users WHERE user_name = '$username' AND user_id = '$user_id'");
        if (empty($realPassword)) {
            exit('Error. Please try again later.');
        }

        // check if password matches the one in the database
        if (password_verify($password, $realPassword) != $realPassword) {
            exit('Invalid username or password.');
        }

        // store the user id in session
        $_SESSION['user_id'] = $user_id;

        echo "ok";

    }


    function index()
    {
        // set this true so this page can be active in nav menu
        $this->resultpage = true;

        // get results
        $this->results = Administrator::getResults();
    }


    function practical()
    {
        // set this true so this page can be active in nav menu
        $this->practical = true;

        // get the practical tasks
        $this->practicalQuestions = Administrator::getPracticalQuestions();
    }


    function theoretical()
    {
        // set this true so this page can be active in nav menu
        $this->theoretical = true;

        // get theoretical questions
        $this->questions = Administrator::getQuestions();
    }


    function grading()
    {
        // set this true so this page can be active in nav menu
        $this->grading = true;

        // get the tests that need to be graded
        $this->results = Administrator::getGradings();
    }


    function log()
    {
        // set this true so this page can be active in nav menu
        $this->log = true;

        // get the log
        $this->resultsLog = Administrator::getLog();
    }


    function settings()
    {
        // set this true so this page can be active in nav menu
        $this->properties = true;

        // get the settings
        $this->settings;

        // get the theoretical question count
        $this->totalQuestions = Administrator::countQuestions();

        // get the time left
        $this->time;
    }


    function help()
    {
        // set this true so this page can be active in nav menu
        $this->help = true;
    }


    function AJAX_allowAgain()
    {
        // reset fields
        Tests::resetResults($_POST['user_id']);

        // get the social id necessary for html file deletion
        $socialId = get_first("SELECT social_id FROM users WHERE user_id = {$_POST['user_id']}")['social_id'];

        // delete file if exists
        Administrator::deleteHTMLFile($socialId);

        echo 'ok';
    }


    function AJAX_deleteResult()
    {
        // get the user id and delete table entry
        $id = (int)$_POST['user_id'];
        q("DELETE FROM results WHERE user_id = $id");

        // get the social id necessary for html file deletion
        $socialId = get_first("SELECT social_id from users WHERE user_id = $id")['social_id'];

        // delete file if exists
        Administrator::deleteHTMLFile($socialId);

        echo 'ok';
    }


    function AJAX_pushToLog()
    {
        // delete all files and table entries from results
        q('DELETE FROM results');

        // delete all html files
        Administrator::deleteAllHTMLFiles();

        echo 'ok';
    }


    function AJAX_editPractical()
    {
        // remove new lines from practical text
        $practicalText = str_replace("\n", '', $_POST['practical_text']);

        // get the id, title and update database
        $practicalId = (int)$_POST['practical_id'];
        $practicalTitle = $_POST['practical_title'];

        // update database
        update('practical', [
            'practical_text' => '' . $practicalText . '',
            'practical_title' => '' . $practicalTitle . ''
        ], "practical_id = '$practicalId'");

        echo 'ok';
    }


    function AJAX_deletePractical()
    {
        // get the id
        $practicalId = (int)$_POST['practical_id'];

        // delete the entry
        q("DELETE FROM practical WHERE practical_id = '$practicalId'");

        echo 'ok';
    }


    function AJAX_addPractical()
    {
        // if empty
        if (empty($_POST['practical_title'] && $_POST['practical_text'])) {
            exit('All fields are required!');
        }

        // get the title and text (remove new lines from text)
        $practicalTitle = $_POST['practical_title'];
        $practicalText = str_replace("\n", '', $_POST['practical_text']);

        // insert it into database
        insert('practical', [
            'practical_text' => $practicalText,
            'practical_title' => $practicalTitle
        ]);

        echo 'ok';
    }


    function AJAX_editTheoretical()
    {
        // get the answers
        $answers = $_POST['answers'];

        // exit if a field is missing
        Administrator::checkFields($answers);

        // get the questions and the question id
        $question = addslashes(array_values($_POST['question'])[0]);
        $questionId = key($_POST['question']);

        // update database
        Administrator::changeTheoreticalQuestion($questionId, $question, $answers);

        echo 'ok';

    }


    function AJAX_deleteTheoretical()
    {
        // delete question and answers
        $questionId = key($_POST['question']);

        // delete question and answers
        Administrator::deleteTheoreticalQuestion($questionId);

        echo 'ok';
    }


    function AJAX_addTheoretical()
    {

        // if empty
        if (empty($_POST)) {
            exit('All fields are required.');
        }

        // get the elements necessary for a new theoretical question
        $elements = $_POST;

        // exit if a field is missing
        Administrator::checkFields($elements);

        // set the new questions
        Administrator::setNewTheoretical($elements);

        echo 'ok';

    }


    function AJAX_gradePractical()
    {
        // update the practical grade
        update('results', ['practical_points' => $_POST['grade']], "user_id = {$_POST['user_id']}");

        echo 'ok';
    }


    function AJAX_editQuestionCount()
    {
        // update the nr of questions
        $questionCount = addslashes($_POST['nr_of_questions']);

        // update the question count in database
        update('settings', ['nr_of_questions' => '' . $questionCount . ''], "id = '1'");

        echo 'ok';
    }


    function AJAX_generatePassword()
    {
        // generate a random PIN and update database
        $randomPIN = generateRandomPIN(4);

        // update database
        update('settings', ['pwd' => '' . $randomPIN . ''], "id = '1'");

        // exit with the generated PIN
        exit($randomPIN);
    }


    function AJAX_openTest()
    {
        // get the test hours and current date
        $testHours = addslashes($_POST['test_hours']);
        $currentDate = date('Y-m-d H:i:s');

        // update database
        update('settings', [
            'start' => $currentDate,
            'end' => date('Y-m-d H:i:s', strtotime("+$testHours hour"))
        ], "id = '1'");

        echo 'ok';
    }


    function AJAX_closeTest()
    {
        // close the test
        Tests::closeTest();

        echo 'ok';
    }


    function AJAX_liveTime()
    {
        // check if the test is already closed
        if ($this->time['time'] >= 0) {
            echo $this->time['time'];
        } else {
            echo 'Test on suletud';
        }
    }


    function AJAX_validationOption()
    {
        // get the validation option value
        $validateHTML = addslashes($_POST['validationOption']);

        // update validation option
        update('settings', ['htmlvalidator' => '' . $validateHTML . ''], "id = '1'");

        echo 'ok';
    }


    function AJAX_liveOption()
    {
        // get the live option and update database
        $livehtml = addslashes($_POST['liveOption']);

        // update database
        update('settings', ['livehtml' => '' . $livehtml . ''], "id = '1'");

        echo 'ok';
    }


    function AJAX_scoreOption()
    {
        // change score options
        $score = addslashes($_POST['scoreOption']);
        $scorePrivate = addslashes($_POST['scorePrivateOption']);

        // update score option
        Administrator::updateScoreOption($score, $scorePrivate);

        echo 'ok';
    }


    function AJAX_changePassword()
    {
        // get the old password (user given), new password (new1, new2) and the real password from database
        $old = addslashes($_POST['old-password']);
        $new1 = addslashes($_POST['password1']);
        $new2 = addslashes($_POST['password2']);
        $real = get_one("SELECT password FROM users WHERE user_id = '{$_SESSION['user_id']}'");

        // change password if all is well
        Administrator::changePassword($old, $new1, $new2, $real);

        echo 'ok';

    }

}