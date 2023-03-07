<?php
/**
 * Created by PhpStorm.
 * User: Renee
 * Date: 2/28/2017
 * Time: 12:59
 */

namespace Aastategija;

// database queries
class Questions
{

    public static function get()
    {
        // questions are ordered by random
        q('SELECT * FROM questions JOIN answers USING (question_id) ORDER BY RAND()', $q);

        while ($row = mysqli_fetch_assoc($q)) {
            $questions[$row['question_id']]['question'] = htmlentities($row['question']);
            $questions[$row['question_id']]['question_id'] = $row['question_id'];
            $questions[$row['question_id']]['answers'][] = [
                'id' => $row['answer_id'],
                'text' => htmlentities($row['answer_text'])
            ];
        }

        // get nr of questions needed from settings
        $questionCount = get_first('SELECT * FROM settings');

        // slice the questions where needed
        return array_slice($questions, 0, $questionCount['nr_of_questions']);
    }


    static function getPractical()
    {
        // get practical questions for the test
        $practicalText = get_first('SELECT * FROM practical ORDER BY RAND()');
        $array = array();

        // organize the test description at the end of line mark ";"
        array_push($array, $practicalText['practical_id']);
        array_push($array, explode(';', $practicalText['practical_text'], -1));

        // return the structured array
        return $array;
    }


    static function getResult($userId = NULL)
    {
        // get result only if user is logged in
        if (isset($userId)) {
            $points = get_first("SELECT theoretical_points FROM results WHERE user_id = $userId");
            return $points['theoretical_points'];
        } else {
            $points = -1;
            return $points;
        }
    }

}