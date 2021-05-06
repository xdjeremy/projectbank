<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['email'])) {
    header('Location: ../summary');
    exit();
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
    <title>Register - Project Bank</title>
	<link rel="icon" type="image/x-icon" href="../favicon.png" />
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="../assets/plugins/snackbar/snackbar.min.css">
    <link rel="stylesheet" href="../assets/plugins/loaders/custom-loader.css">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image" style="background-image: url('../assets/img/banking.jpg');"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Open an Account!</h4>
                            </div>
                            <form class="user" method="post" id="register-form">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="text" id="first_name" placeholder="First Name" name="first_name" required></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="text" id="last_name" placeholder="Last Name" name="last_name" required></div>
                                </div>
                                <div class="form-group"><input class="form-control form-control-user" type="text" name="address" id="address" placeholder="Address" required></div>
                                <div class="form-group"><input class="form-control form-control-user" type="number" name="phonenumber" id="phonenumber" placeholder="Phone Number" required></div>
                                <div class="form-group"><input class="form-control form-control-user" type="email" id="email" aria-describedby="emailHelp" placeholder="Email Address" name="email" required></div>
                                <div class="form-group"><select class="form-control" name="accounttype" id="accounttype">
                                        <option value="1" id="personal" selected="">Personal</option>
                                        <option value="2" id="business">Business</option>
                                    </select></div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="password" id="password" placeholder="Password" name="password" required></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="password" id="password_repeat" placeholder="Repeat Password" name="password_repeat"required></div>
                                </div><button class="btn btn-primary btn-block text-white btn-user" type="submit" id="register">Register Account</button>
                                <input type="hidden" name="<?php echo $_SESSION['csrf_ajax_key']; ?>" value="<?php echo $_SESSION['csrf_ajax_val']; ?>">
                                <hr>
                            </form>
                            <div class="text-center"><a class="small" href="login.php">Already have an account? Login!</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="../assets/js/theme.js"></script>

    <script src="../assets/plugins/snackbar/snackbar.min.js"></script>
    <script src="../assets/plugins/snackbar/custom-snackbar.js"></script>


    <script src="js/register-engage.js"></script>

</body>

</html>