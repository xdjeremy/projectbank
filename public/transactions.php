<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['email'])) {
	header("Location: auth/login");
}

include_once '../inc/database.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>
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
            <div id="content">
                <?php
                include "../inc/header.php";
                ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Transactions</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Payments &amp; Transfers</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Transaction type</th>
                                            <th>Payee / Payer</th>
                                            <th>Amount</th>
                                            <th>Running balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $stmt = $dbh->prepare('SELECT * FROM transaction WHERE acc_num = ? ORDER BY id DESC LIMIT 50');
                                    $stmt->execute([$_SESSION["acc_num"]]);

                                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {

                                        echo "<tr>";
                                        echo "<td>" . date('F d y', strtotime($row->date)) . "</td>";
                                        echo "<td>Online Payment</td>";
                                        echo "<td>" . $row->payee . "</td>";
                                        echo "<td>$row->amount</td>";
                                        echo "<td>$row->acc_balance</td>";
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