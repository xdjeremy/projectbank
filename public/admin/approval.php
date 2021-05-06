<?php

if (!isset($_SESSION)) {
	session_start();
}

if ($_SESSION['admin'] != 1) {
	header('Location: ../summary');
}

// ADD ADMIN ACCESS ONLY

include_once ('../../inc/database.php');

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Approval - Project Bank</title>
	<link rel="icon" type="image/x-icon" href="../favicon.png" />
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-coins"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Project Bank</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="../summary"><i class="fa fa-suitcase"></i><span>&nbsp;Account Summary</span></a></li>
                    <li class="nav-item"><a class="nav-link " href="../transactions"><i class="icon ion-arrow-swap"></i><span>&nbsp;Payments &amp; Transfers</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="../send-money"><i class="icon ion-android-send"></i><span>&nbsp;Send Money</span></a></li>
<!--                    <li class="nav-item"><a class="nav-link active" href="transactions.html"><i class="fas fa-user-friends"></i><span>&nbsp;Accounts</span></a></li>-->
                    <li class="nav-item"><a class="nav-link " href="#"><i class="far fa-question-circle"></i><span>&nbsp;Waiting for Approval</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
	            <?php
	            include '../../inc/header.php';
	            ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Approve New Accounts</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Accounts Pending</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="approval">
                                    <thead>
                                        <tr>
                                            <th>Client Number</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Type</th>
                                            <th>Approve</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $stmt = $dbh->prepare('SELECT * FROM client WHERE active = 0');
                                    $stmt->execute();

                                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                                    	echo "<tr>";
	                                    echo "<td>" . $row->client_num . "</td>";
	                                    echo "<td>" . $row->client_fname . " " . $row->client_lname . "</td>";
	                                    echo "<td>" . $row->client_email . "</td>";
	                                    echo "<td>" . $row->client_type_code . "</td>";
	                                    echo "<td><button id='" . $row->client_num . "' class='btn btn-primary btn-sm approve'>Approve</button></td>";
	                                    echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	        <?php
	        include '../../inc/footer.php';
	        ?>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="../assets/js/theme.js"></script>

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="js/approve.js"></script>

</body>

</html>