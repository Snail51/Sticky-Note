<?php

// enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// add some values from the server
$_POST['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
$_POST['REQUEST_TIME'] = $_SERVER['REQUEST_TIME'];

// escape special chars
foreach (array_keys($_POST) as $key)
{
    $_POST[$key] = htmlspecialchars($_POST[$key]);
}

// convert to json and append
$out = json_encode($_POST) . "\n";
file_put_contents("./record.csv", $out, FILE_APPEND);


echo "Wrote the following to the record:<br>" . "<pre>" . $out . "</pre>";
exit;
?>
