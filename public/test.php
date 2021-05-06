<?php

include "../inc/database.php";

$stmt = $dbh->prepare('SELECT * FROM account WHERE acc_num = ? ORDER BY id DESC LIMIT 1');
$stmt->execute(['409663565927']);
$receiver = $stmt->fetch(PDO::FETCH_OBJ);