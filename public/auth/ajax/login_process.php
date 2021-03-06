<?php
if (!isset($_SESSION)) {
    session_start();
}

if (
    //Check required variables are set
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
    include_once ('../../../inc/database.php');

    $user_ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR']);

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $dbh->prepare('SELECT * FROM client WHERE client_email = ?');
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_OBJ);
    if ($stmt->rowCount() < 1) {
        $return = json_encode(array(
            'success' => false,
            'msg' => 'Incorrect email or password.'
        ));
        die($return);
    } else if (password_verify($password, $user->client_pass)) {

        if ($user->active == 0) {
            $return = json_encode(array(
                'success' => false,
                'msg' => 'Account needs to be activated by Admin.'
            ));
            die($return);
        }

        $_SESSION['client_num'] = $user->client_num;
        $_SESSION['client_fname'] = $user->client_fname;
        $_SESSION['client_lname'] = $user->client_lname;
        $_SESSION['email'] = $user->client_email;

        $stmt = $dbh->prepare('SELECT * FROM account WHERE client_num = ? ORDER BY id DESC LIMIT 1');
        $stmt->execute([$user->client_num]);
        $acc = $stmt->fetch(PDO::FETCH_OBJ);

        //set session for acc_num
        $_SESSION['acc_num'] = $acc->acc_num;

        //check if admin
	    $stmt = $dbh->prepare('SELECT * FROM admin WHERE client_id = ?');
	    $stmt->execute([$user->client_num]);
	    if ($stmt->rowCount() >= 1) {
	    	$_SESSION['admin'] = 1;
	    } else {
	    	$_SESSION['admin'] = 0;
	    }

        $date = date("Y-m-d H:i:s");
        $stmt = $dbh->prepare('INSERT INTO login (client_num, date_time, IP_address) VALUES (:client_num, :datetime, :ip)');
        $stmt->execute([
            'client_num' => $_SESSION['client_num'],
            'datetime' => $date,
            'ip' => $user_ip
        ]);

        $return = json_encode(array(
            'success' => true
        ));
        die($return);
    } else {
        // Incorrect password
        $return = json_encode(array(
            'success' => false,
            'msg' => 'Incorrect email or password.'
        ));
        die($return);
    }
}
//Unset to stop multiple attempts
unset($_SESSION['csrf_ajax_key'], $_SESSION['csrf_ajax_val']);
header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
exit();