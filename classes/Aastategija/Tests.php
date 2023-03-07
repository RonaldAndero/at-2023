<?php
/**
 * Created by PhpStorm.
 * User: Renee
 * Date: 3/22/2017
 * Time: 12:45
 */

namespace Aastategija;


class Tests
{

    static function setTestResult($answers, $user_id)
    {

        // default is 0
        $correctAnswers = 0;

        // set the theoretical test result according to users answers
        foreach ($answers as $answer) {
            foreach ($answer as $value) {
                $check = get_first("SELECT answer_correct FROM answers WHERE answer_id = $value");
                if ($check['answer_correct'] == 1) {
                    $correctAnswers++;
                }
            }
        }

        // update table
        update('results', [
            'theoretical_points' => $correctAnswers,
        ], "user_id = '$user_id'");
    }


    static function writePracticalTestFile($user_id, $social_id, $html)
    {
        // write the html file for the practical test that the user took
        $htmlFile = fopen('results/' . $social_id . '.html', 'w');
        fwrite($htmlFile, $html);
        fclose($htmlFile);

        // update practical points, if -1 then practical is done but ungraded
        update('results', ['practical_points' => -1], "user_id = '$user_id'");
    }


    static function resetResults($userId)
    {
        // reset the results table (pushes everything to log table)
        update('results', [
            'theoretical_points' => -1,
            'practical_errors' => '',
            'practical_points' => -2,
            'nr_of_questions' => 0
        ], "user_id = $userId");
    }


    static function closeTest()
    {
        // reset the time values so the test is closed
        update('settings', [
            'start' => NULL,
            'end' => NULL
        ], "id = '1'");
    }

}