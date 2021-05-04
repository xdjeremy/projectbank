<?php

$hostname = "localhost";
$user = "root";
$pass = "";
$database = "project_bank";

$dsn = 'mysql:host=' . $hostname . ';dbname=' . $database;
$dbh = new PDO($dsn, $user, $pass);