<?php
// display errors (helpful during deployment/debugging)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// database connection – update with the values provided by InfinityFree
$db = mysqli_connect('sql309.infinityfree.com', 'if0_40993535', 'yisoosxcl01', 'if0_40993535_mark');

// verify connection
if (!$db) {
    error_log('Database connection failed: ' . mysqli_connect_error());
    die('Database connection failed.');
}

?>