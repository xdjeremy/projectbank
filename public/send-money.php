<?php
if(!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['email'])) {
	header("Location: auth/login");
}

//avoid cross site attacks
$_SESSION['csrf_ajax_key'] = sha1(uniqid());
$_SESSION['csrf_ajax_val'] = sha1(uniqid());
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Send Money - Project Bank</title>
    <link rel="icon" type="image/x-icon" href="favicon.png" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/plugins/snackbar/snackbar.min.css">
    <link rel="stylesheet" href="assets/plugins/loaders/custom-loader.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        include '../inc/navbar.php';
        ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php
                include '../inc/header.php';
                ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Send Money</h3>
                    <div class="row mb-3">
                        <div class="col-lg-8 col-xl-8 offset-lg-2 offset-xl-2">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Payment</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" id="send-money-form">
                                                <div class="form-row">
                                                    <div class="col-12">
                                                        <div class="form-group"><label for="amount"><strong>Amount</strong></label><input class="form-control" type="number" name="amount" placeholder="0" id="amount"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="account_number"><strong>Send to Account Number</strong></label><input class="form-control" type="text" name="account_number" placeholder="------------" id="acc_num"></div>
                                                    </div>
                                                </div>
	                                            <input type="hidden" name="<?php echo $_SESSION['csrf_ajax_key']; ?>" value="<?php echo $_SESSION['csrf_ajax_val']; ?>">
                                                <div class="form-group"><button class="btn btn-primary btn-sm" type="submit" id="send-money">Send</button></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include '../inc/footer.php';
            ?>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>

    <script src="assets/plugins/snackbar/snackbar.min.js"></script>
    <script src="assets/plugins/snackbar/custom-snackbar.js"></script>
    <script src="assets/js/send-money.js"></script>
</body>

</html>