<?php
/**
 * Created by PhpStorm.
 * User: Renee
 * Date: 3/3/2017
 * Time: 00:57
 */

namespace Aastategija;


class Administrator
{
    // for theoretical -1 means it is not done
    // for practical -2 means it is not done, -1 means it is not graded
    // if statements in sql query are needed because otherwise the sum would be incorrect
    static function getResults()
    {
        // get results for admin index view
        return get_all("SELECT
                          *,
                          (IF(results.theoretical_points > 0, results.theoretical_points, 0) +
                           IF(results.practical_points > 0, results.practical_points, 0)) AS sum
                        FROM results
                          INNER JOIN users
                        WHERE results.user_id = users.user_id
                        ORDER BY
                          IF(results.practical_points >= 0, sum, results.practical_points) DESC");
    }


    static function getGradings()
    {
        // get entries for grading view (graded and ungraded)
        return get_all("SELECT
                          *,
                          (IF(results.theoretical_points > 0, results.theoretical_points, 0) +
                           IF(results.practical_points > 0, results.practical_points, 0)) AS sum
                        FROM results
                          INNER JOIN users ON results.user_id = users.user_id
                          INNER JOIN
                          practical ON results.practical_id = practical.practical_id
                        ORDER BY date ASC");
    }


    static function getLog()
    {
        // get log data
        return get_all("SELECT
                          *,
                          (IF(results_log.theoretical_points > 0, results_log.theoretical_points, 0) +
                           IF(results_log.practical_points > 0, results_log.practical_points, 0)) AS sum
                        FROM results_log
                          INNER JOIN users
                        WHERE results_log.user_id = users.user_id
                        ORDER BY
                          date DESC");
    }


    static function getQuestions()
    {
        // get all the theoretical questions and answers
        q('SELECT * FROM questions JOIN answers USING (question_id) ORDER BY question_id DESC', $q);

        while ($row = mysqli_fetch_assoc($q)) {
            $questions[$row['question_id']]['question'] = htmlentities($row['question']);
            $questions[$row['question_id']]['question_id'] = $row['question_id'];
            $questions[$row['question_id']]['answers'][] = [
                'id' => $row['answer_id'],
                'text' => htmlentities($row['answer_text'])
            ];
        }

        return $questions;
    }


    static function countQuestions()
    {
        // get all the theoretical questions for counting puproses
        $totalQuestions = q('SELECT * FROM questions');

        return $totalQuestions;
    }


    static function getPracticalQuestions()
    {

        // get practical questions
        $practicalQuestions = get_all('SELECT * FROM practical ORDER BY practical_id DESC');
        $oneTask['id'] = array();
        $oneTask['title'] = array();
        $oneTask['description'] = array();

        // loop through the practical task descriptions, explode at the end of line mark ";"
        // maintain the title and task structure for one assignment
        foreach ($practicalQuestions as $practicalQuestion) {
            $oneTask['id'][] = $practicalQuestion['practical_id'];
            $oneTask['title'][] = $practicalQuestion['practical_title'];
            $oneTask['description'][] = explode(';', $practicalQuestion['practical_text'], -1);
        }

        return $oneTask;

    }


    static function deleteAllHTMLFiles()
    {

        // delete all html files that are in results directory
        foreach (glob("results/*.html") as $filename) {
            if (is_file($filename)) {
                unlink($filename);
            }
        }

    }


    static function deleteHTMLFile($social_id)
    {

        // delete a specific file that is in results directory
        if (file_exists('results/' . $social_id . '.html')) {
            unlink('results/' . $social_id . '.html');
        }

    }


    static function setNewTheoretical($elements)
    {

        // loop through array elements and determine whether it is question, wrong or right answer
        // and insert into database
        foreach ($elements as $key => $element) {
            switch ($key) {
                case 'question':
                    insert('questions', ['question' => '' . $element . '']);
                    $questionID = get_first('SELECT LAST_INSERT_ID() as question_id');
                    break;
                case 'correct':
                    insert('answers', [
                        'answer_text' => $element,
                        'question_id' => $questionID['question_id'],
                        'answer_correct' => 1
                    ]);
                    break;
                default:
                    insert('answers', [
                        'answer_text' => $element,
                        'question_id' => $questionID['question_id']
                    ]);
                    break;
            }
        }

    }

    static function checkFields($array)
    {

        // checks if any of the array elements is equal to NULL
        foreach ($array as $arrayMember) {
            if ($arrayMember == NULL) {
                exit('All fields are required.');
            }
        }

    }

    static function changePassword($old, $new1, $new2, $real)
    {

        // if empty
        if (empty($old) || empty($new1) || empty($new2)) {
            exit('All fields are required.');
        }

        // if old password given does not match the real password
        if (password_verify($old, $real) != $real) {
            exit('Invalid password.');
        }

        // if new passwords do not match
        if ($new1 != $new2) {
            exit('Passwords do not match.');
        }

        // hash the new password
        $new = password_hash($new1, PASSWORD_DEFAULT);

        // update database
        update('users', ['password' => '' . $new . ''], "user_id = '{$_SESSION['user_id']}'");

    }

    static function changeTheoreticalQuestion($questionId, $question, $answers)
    {
        // update database
        update('questions', ['question' => '' . $question . ''], "question_id = '$questionId'");

        foreach ($answers as $key => $answer) {
            $answer_text = addslashes($answer);
            update('answers', ['answer_text' => '' . $answer_text . ''], "answer_id = '$key'");
        }
    }

    static function deleteTheoreticalQuestion($questionId)
    {
        // delete the question and its answers
        q("DELETE FROM answers WHERE question_id = '$questionId'");
        q("DELETE FROM questions WHERE question_id = '$questionId'");
    }

    static function updateScoreOption($score, $scorePrivate)
    {

        update('settings', ['scores' => '' . $score . ''], "id = '1'");
        update('settings', ['scores_private' => '' . $scorePrivate . ''], "id = '1'");
    }

}