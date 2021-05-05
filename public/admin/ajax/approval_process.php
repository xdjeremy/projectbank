<?php
if (
	isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&

	//Check is AJAX
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' &&

	//Check is POST
	$_SERVER['REQUEST_METHOD'] === 'POST'
) {
	include "../../../inc/database.php";

	$id = $_POST['id'];

	$stmt = $dbh->prepare('UPDATE client SET active = 1 WHERE client_num = ?');
	$stmt->execute([$id]);


	$acc_num = rand(111111111111,999999999999);

	$stmt = $dbh->prepare('INSERT INTO account (client_num, acc_num) VALUES (:client_id, :acc_num)');
	$stmt->execute([
		"client_id" => $id,
		"acc_num" => $acc_num
	]);
}

exit();