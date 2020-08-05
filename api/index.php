<?php
include 'config/Database.php';

include 'models/Users.php';
include 'models/Currency.php';

$database = new Database;
$db = $database->connect();
?>