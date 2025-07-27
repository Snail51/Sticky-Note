<?php

// enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    // abort on malicious input
    $check = strlen(print_r($_POST, true));
    if( $check > 8192 )
    {
        echo "Data too long (" . $check . "). Aborting.";
        exit;
    }

    // add some values from the server
    $_POST['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
    $_POST['REQUEST_TIME'] = $_SERVER['REQUEST_TIME'];

    // escape special chars
    foreach (array_keys($_POST) as $key)
    {
        $_POST[$key] = htmlspecialchars($_POST[$key]);
        $_POST[$key] = str_replace(',', '&comma;', $_POST[$key]); // escape comma for CSV parsing
        $_POST[$key] = str_replace('&#039;', '&apos;', $_POST[$key]); // prefer HTML escape for apostrophe
    }

    // convert to json and append
    $out = json_encode($_POST) . "\n";
    file_put_contents("./record.json", $out, FILE_APPEND);


    echo "Wrote " . $check . " characters following to the record:<br>" . "<pre>" . $out . "</pre>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    $out = file_get_contents($_SERVER['SCRIPT_FILENAME']);
    $out = htmlspecialchars($out);
    echo "<pre>" . $out . "</pre>";
}

?>
