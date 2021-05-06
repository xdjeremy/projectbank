<?php
if (!isset($_SESSION)) {
	session_start();
}
?>
<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
	<div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
			<div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-coins"></i></div>
			<div class="sidebar-brand-text mx-3"><span>Project Bank</span></div>
		</a>
		<hr class="sidebar-divider my-0">
		<ul class="navbar-nav text-light" id="accordionSidebar">
			<li class="nav-item"><a class="nav-link" href="summary"><i class="fa fa-suitcase"></i><span>&nbsp;Account Summary</span></a></li>
			<li class="nav-item"><a class="nav-link" href="transactions"><i class="icon ion-arrow-swap"></i><span>&nbsp;Payments &amp; Transfers</span></a></li>
			<li class="nav-item"><a class="nav-link" href="send-money"><i class="icon ion-android-send"></i><span>&nbsp;Send Money</span></a></li>
			<?php

			if ($_SESSION['admin'] == 1) {
				echo '
				<!--<li class="nav-item"><a class="nav-link" href="transactions.html"><i class="fas fa-user-friends"></i><span>&nbsp;Accounts</span></a></li>-->
				<li class="nav-item"><a class="nav-link" href="transactions.html"><i class="far fa-question-circle"></i><span>&nbsp;Waiting for Apporoval</span></a></li>
				';
			}
			?>
		</ul>
		<div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
	</div>
</nav>