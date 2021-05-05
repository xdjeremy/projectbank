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

    if ($account->acc_balance < $_POST['amount']){
        $return = json_encode(array(
            'success' => false,
            'msg' => 'Insufficient funds'
        ));
        die($return);
    }

    //check if account number is valid

    $stmt = $dbh->prepare('SELECT * FROM accunt WHERE client_num = ? ORDER BY id DESC LIMIT 1');
    $stmt->execute([$_POST['account_number']]);
    $client = $stmt->fetch(PDO::FETCH_OBJ);

    if ($account->acc_balance < $_POST['amount']){
        $return = json_encode(array(
            'success' => false,
            'msg' => 'Insufficient funds'
        ));
        die($return);
    } else {
        $return = json_encode(array(
            'success' => true,
            'msg' => 'Insufficient funds'
        ));
        die($return);
    }
}
//Unset to stop multiple attempts
unset($_SESSION['csrf_ajax_key'], $_SESSION['csrf_ajax_val']);
header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
exit();