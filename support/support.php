<?php 

	require_once('../Class/Connection.php');
	$con = new Connection;

	if (isset($_POST['countryorder'])) {
		require_once('../Class/Order.php');
		$order = new Order( $con );
		echo $order->getCountryOrders();
	}elseif( isset($_POST['yearpercent'])){
		require_once('../Class/OrderPerMonth.php');
		$yearpercent = new OrderPerMonth( $con );
		echo $yearpercent->getYearPercentage($_POST['yearpercent']);
	}

 ?>