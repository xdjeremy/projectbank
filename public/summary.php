<?php

if (!isset($_SESSION)) {
	session_start();
}

if (!isset($_SESSION['email'])) {
	header("Location: auth/login");
}

include_once "../inc/database.php";

$stmt = $dbh->prepare('SELECT * FROM account WHERE client_num = ? ORDER BY id DESC LIMIT 1');
$stmt->execute([$_SESSION['client_num']]);
$account = $stmt->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Summary - Project Bank</title>
	<link rel="icon" type="image/x-icon" href="favicon.png" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
	    <?php
	    include "../inc/navbar.php";
	    ?>
        <div class="d-flex flex-column" id="content-wrapper">
	        <?php
	        include '../inc/header.php';
	        ?>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Account Summary</h3>
                    </div>
                    <div class="row">
                        <div class="col lg-6">
                            <div class="card text-white bg-primary shadow my-3">
                                <div class="card-body">
                                    <p class="m-0">Savings</p>
                                    <p class="text-white-50 small m-0"><?php echo $account->acc_num; ?></p>
                                </div>
                            </div>
                        </div>
	                    <div class="col-lg-6 col-xl-4">
		                    <div class="card shadow border-left-primary py-2">
			                    <div class="card-body">
				                    <div class="row align-items-center no-gutters">
					                    <div class="col mr-2">
						                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>AVAILABLE BALANCE</span></div>
						                    <div class="text-dark font-weight-bold h5 mb-0"><span>₱ <?php echo $account->acc_balance; ?></span></div>
					                    </div>
					                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
				                    </div>
			                    </div>
		                    </div>
	                    </div>
                    </div>
                    <div class="row">
<!--                        <div class="col-lg-7 col-xl-8">-->
<!--                            <div class="card shadow mb-4">-->
<!--                                <div class="card-header d-flex justify-content-between align-items-center">-->
<!--                                    <h6 class="text-primary font-weight-bold m-0">Earnings Overview</h6>-->
<!--                                    <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>-->
<!--                                        <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">-->
<!--                                            <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>-->
<!--                                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="card-body">-->
<!--                                    <div class="chart-area"><canvas data-bss-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Jan&quot;,&quot;Feb&quot;,&quot;Mar&quot;,&quot;Apr&quot;,&quot;May&quot;,&quot;Jun&quot;,&quot;Jul&quot;,&quot;Aug&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Earnings&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;0&quot;,&quot;10000&quot;,&quot;5000&quot;,&quot;15000&quot;,&quot;10000&quot;,&quot;20000&quot;,&quot;15000&quot;,&quot;25000&quot;],&quot;backgroundColor&quot;:&quot;rgba(78, 115, 223, 0.05)&quot;,&quot;borderColor&quot;:&quot;rgba(78, 115, 223, 1)&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;],&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;padding&quot;:20}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;]},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;padding&quot;:20}}]}}}"></canvas></div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
        <?php
        include '../inc/footer.php';
        ?>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>