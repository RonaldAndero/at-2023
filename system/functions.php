<?php

/**
 * Display a fancy error page and quit.
 * @param $error_msg string Error message to show
 * @param int $code HTTP RESPONSE CODE. Default is 500 (Internal server error)
 */
function error_out($error_msg, $code = 500)
{

    // Return HTTP RESPONSE CODE to browser
    header($_SERVER["SERVER_PROTOCOL"] . " $code Something went wrong", true, $code);


    // Set error message
    $errors[] = $error_msg;


    // Show pretty error, too, to humans
    require __DIR__ . '/../templates/error_template.php';


    // Stop execution
    exit();
}

/**
 * Loads given controller/action, and global, translations to memory
 * @param $lang string Language to load
 * @param $controller string Controller to load translations for
 * @param $action string Action to load translations for
 */
function get_translation_strings($lang, $controller, $action)
{
    global $translations;
    $translations_raw = get_all("SELECT controller,`action`,phrase,translation FROM translations WHERE language='$lang' AND ((controller='{$controller}' and action = '{$action}') OR (action='global'  and controller = 'global'))");

    foreach ($translations_raw as $item) {
        // Uncomment this line if the same phrase need to be translated differently on different pages
        //$translations[$item['controller'] . $item['action'] . $item['phrase']] = $item['translation'];
        $translations[$item['phrase']] = $item['translation'];

    }
}

/**
 * Translates the text into currently selected language
 * @param $text string The text to be translated
 * @param bool $global Set to false if you want to let the user translate this string differently on different sub-pages.
 * @return string Translated text
 */
function __($text, $global = true)
{
    global $translations;
    global $controller;

    $active_language = $_SESSION['language'];


    // Don't translate native language
    if ($active_language == PROJECT_NATIVE_LANGUAGE) {
        return $text;
    }

    // Controller should be always available, unless we aren't called from a view
    if (!isset($controller->controller)) {
        $global = true;
    }

    // Set translations scope
    $c = $global ? 'global' : $controller->controller;
    $a = $global ? 'global' : $controller->action;
    $page_controller = $controller->controller;
    $page_action = $controller->action;

    // Load translations only the first time (per request)
    if (empty($translations) && $active_language) {
        get_translation_strings($active_language, $page_controller, $page_action);
    }


    // Safe way to query translation
    $translation = isset($translations[$text]) ? $translations[$text] : '';
    // Insert new translation stub into DB when text wasn't empty but a matching translation didn't exist in the DB
    if ($text !== null && $translation == null) {


        // Insert new stub
        insert('translations', ['phrase' => $text, 'translation' => '{untranslated}', 'language' => $active_language, 'controller' => $c, 'action' => $a]);


        // Set translation to input text when stub didn't exist
        $translation = $text;

    } else if ($translation == '{untranslated}') {

        // Set translation to input text when stub existed but was not yet translated
        $translation = $text;
    }

    return $translation;

}


// shuffle associative array
function shuffle_assoc($list) {
    if (!is_array($list)) return $list;

    $keys = array_keys($list);
    shuffle($keys);
    $random = array();
    foreach ($keys as $key)
        $random[$key] = $list[$key];

    return $random;
}

// generate random PIN
function generateRandomPIN($length) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


// kill session including all session related files
function killSession() {
// Destroy session completely
// Unset all of the session variables.
    $_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

// Finally, destroy the session.
    session_destroy();
}

// replace every letter in string with asterisks, except for the first letter
function hideString($str) {
    return substr($str, 0, 1).str_repeat("*", strlen($str) - 1);
}


// check if server is using localhost or not
function notLocalhost() {
    // localhost
    $whitelist = array('127.0.0.1', '::1');

    if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
        return true;
    } else {
        return false;
    }
}

// show php errors
function dbg() {
    echo htmlspecialchars("<?php error_reporting(E_ALL); ini_set('display_errors', 1); ?>");
}





