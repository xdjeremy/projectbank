<?php
if (!isset($_SESSION)) {
    session_start();
}
if (
//    Check required variables are set
    isset($_SESSION['csrf_ajax_key']) &&
    isset($_SESSION['csrf_ajax_val']) &&
    isset($_POST[$_SESSION['csrf_ajax_key']]) &&
    isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&

//    Check is AJAX
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' &&

//    Check is POST
    $_SERVER['REQUEST_METHOD'] === 'POST' &&

//    Check POST'ed keys match the session keys
    $_SESSION['csrf_ajax_val'] == $_POST[$_SESSION['csrf_ajax_key']]
) {
    include_once ('../../../inc/database.php');

    $userFirstName = $_POST['first_name'];
    $userLastName = $_POST['last_name'];
    $userAddress = $_POST['address'];
    $userPhone = $_POST['phonenumber'];
    $userEmail = $_POST['email'];
    $userAccountType = $_POST['accounttype'];
    $userPassword = $_POST['password'];
    $userPasswordRepeat = $_POST['password_repeat'];
    $userIp = (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR']);

    $email_lookup = $dbh->prepare('SELECT * FROM client WHERE client_email = ?');
    $email_lookup->execute([$userEmail]);

    if ($email_lookup->rowCount() >= 1) {
        $return = json_encode(array(
            'success' => false,
            'msg' => 'Email is already taken'
        ));
        die($return);
    } elseif (strlen($userPassword) <= 6) {
        $return = json_encode(array(
            'success' => false,
            'msg' => 'Password must be longer than 6 characters'
        ));
        die($return);
    } elseif ($userPassword != $userPasswordRepeat) {
        $return = json_encode(array(
            'success' => false,
            'msg' => 'Password doesn\'t match'
        ));
        die($return);
    } else {
        $pass_encrypted = password_hash($userPassword, PASSWORD_BCRYPT);
        $currentDate = date('Y-m-d H:i:s');

        $stmt = $dbh->prepare('INSERT INTO client (client_fname, client_lname, client_address, client_phone, client_email, client_pass, client_type_code) VALUES (:fname, :lname, :address, :phone, :email, :password, :typecode)');
        $stmt->execute([
            'fname' => $userFirstName,
            'lname' => $userLastName,
            'address' => $userAddress,
            'phone' => $userPhone,
            'email' => $userEmail,
            'password' => $pass_encrypted,
            'typecode' => $userAccountType
        ]);

        //UNSET CSRF TOKEN to stop multiple attempts
        unset($_SESSION['csrf_ajax_val'], $_SESSION['csrf_ajax_key']);

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