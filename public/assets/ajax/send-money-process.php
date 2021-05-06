<?php
if (!isset($_SESSION)) {
    session_start();
}
if (
    isset($_SESSION['csrf_ajax_key']) &&
    isset($_SESSION['csrf_ajax_val']) &&
    isset($_POST[$_SESSION['csrf_ajax_key']]) &&
    isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&

    //Check is AJAX
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' &&

    //Check is POST
    $_SERVER['REQUEST_METHOD'] === 'POST' &&

    //Check POST'ed keys match the session keys
    $_SESSION['csrf_ajax_val'] == $_POST[$_SESSION['csrf_ajax_key']]
) {
    include_once '../../../inc/database.php';

    //check if balance is available
    $stmt = $dbh->prepare('SELECT * FROM account WHERE client_num = ? ORDER BY id DESC LIMIT 1');
    $stmt->execute([$_SESSION['client_num']]);
    $account = $stmt->fetch(PDO::FETCH_OBJ);

	$stmt = $dbh->prepare('SELECT * FROM account WHERE acc_num = ? ORDER BY id DESC LIMIT 1');
	$stmt->execute([$_POST['account_number']]);
	$toSend = $stmt->fetch(PDO::FETCH_OBJ);

    if ($account->acc_balance < $_POST['amount']){
        $return = json_encode(array(
            'success' => false,
            'msg' => 'Insufficient funds'
        ));
        die($return);
    }

    //check if sending to self
    elseif ($_POST['account_number'] == $account->acc_num) {
	    $return = json_encode(array(
		    'success' => false,
		    'msg' => 'You cannot send money to yourself'
	    ));
	    die($return);
    }


    //check if account number is valid
    elseif ($stmt->rowCount() < 1){
        $return = json_encode(array(
            'success' => false,
            'msg' => 'Please enter a valid account number'
        ));
        die($return);
    } else {

    	$date = date('Y-m-d');

    	//calculate balance after transaction
    	$sender_running_balance = $account->acc_balance - $_POST['amount'];

    	//random transaction id bullshit
	    $tid = str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);

	    //make negative num
	    $dec_amount = $_POST['amount'];
	    $dec_amount = -1 * abs($dec_amount);

		//decrease payer
    	$stmt = $dbh->prepare('INSERT INTO transaction (date, acc_num, payee, acc_balance, amount, ref_num) VALUES (:transact_date, :acc_num, :payee, :after_balance, :amount, :ref_id)');
    	$stmt->execute([
    		'transact_date' => $date,
		    'acc_num' => $account->acc_num,
		    'payee' => $_POST['account_number'],
		    'after_balance' => $sender_running_balance,
		    'amount' => $dec_amount,
			'ref_id' => $tid
	    ]);


    	$stmt = $dbh->prepare('SELECT * FROM account WHERE acc_num = ? ORDER BY id DESC LIMIT 1');
    	$stmt->execute([$_POST['account_number']]);
    	$receiver = $stmt->fetch(PDO::FETCH_OBJ);

    	$receiver_new_balance = $receiver->acc_balance + $_POST['amount'];

    	//increase payee
	    $stmt = $dbh->prepare('INSERT INTO transaction (date, acc_num, payee, acc_balance, amount, ref_num) VALUES (:transact_date, :acc_num, :payee, :after_balance, :amount, :ref_num)');
	    $stmt->execute([
		    'transact_date' => $date,
		    'acc_num' => $_POST['account_number'],
		    'payee' => $account->acc_num,
		    'after_balance' => $receiver_new_balance,
		    'amount' => $_POST['amount'],
		    'ref_num' => $tid
	    ]);

    	//update balance for sender
		$stmt = $dbh->prepare('UPDATE account SET acc_balance = :new_bal WHERE acc_num = :acc_num');
		$stmt->execute([
			'new_bal' => $sender_running_balance,
			'acc_num' => $account->acc_num
		]);

		//update balance for receiver
	    $stmt = $dbh->prepare('UPDATE account SET acc_balance = :new_bal WHERE acc_num = :acc_num');
	    $stmt->execute([
		    'new_bal' => $receiver_new_balance,
		    'acc_num' => $_POST['account_number'],
	    ]);

	    $return = json_encode(array(
		    'success' => true
	    ));
	    die($return);
    }
}
//Unset to stop multiple attempts
unset($_SESSION['csrf_ajax_key'], $_SESSION['csrf_ajax_val']);
header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
exit();