<?php

// server info
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'survey';

// connect to the database
$mysqli = new mysqli($server, $user, $pass, $db);

// Set the encoding...
mysqli_set_charset($mysqli, 'utf8');

?>
