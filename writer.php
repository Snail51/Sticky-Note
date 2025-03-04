<?php

// enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$_POST['TIMESTAMP_SELECTED'] = strtotime($_POST['TIMESTAMP_SELECTED']);

$master = "";

$master = $master . $_SERVER['REMOTE_ADDR'] . ", ";
$master = $master . $_SERVER['REQUEST_TIME'] . ", "; 

$keys = array_keys($_POST);
foreach ($keys as $key)
{
    $master = $master . $_POST[$key] . ", ";
}
$master = $master . ":::, ";

$master = $master . 'REMOTE_ADDR' . ", ";
$master = $master . 'REQUEST_TIME' . ", "; 

foreach ($keys as $key)
{
    $master = $master . $key . ", ";
}

file_put_contents("./record.csv", $master, FILE_APPEND);

echo "Wrote the following to the record: \n\n\n" . $master;

exit;

?>
