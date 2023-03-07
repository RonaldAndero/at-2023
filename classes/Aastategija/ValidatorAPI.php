<?php
/**
 * Created by PhpStorm.
 * User: Renee
 * Date: 3/22/2017
 * Time: 12:01
 */

namespace Aastategija;


class ValidatorAPI
{

    public static function setValidatorErrors($user_id, $social_id)
    {

        // define the URL for validator
        $html = 'https://validator.w3.org/nu/?&doc=' . BASE_URL . 'results/' . $social_id . '.html' . '&out=json';

        // get the json data
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $html);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
        $data = curl_exec($curl);
        curl_close($curl);

        // decode json to php array
        $check = json_decode($data, true);

        // get only the errors and push them into array
        $errorList = array();
        foreach ($check['messages'] as $key => $value) {
            foreach ($check['messages'][$key] as $key1 => $value1) {
                if ($value1 == 'error') {
                    array_push($errorList, $check['messages'][$key]['message']);
                }
            }
        }

        // serialize errors for database insertion
        $insertErrors = serialize($errorList);

        // update database
        update('results', ['practical_errors' => '' . $insertErrors . ''], "user_id = '$user_id'");

    }

}