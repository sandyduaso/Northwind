<?php 

	require_once 'Connection.php';
	require_once 'TotalCount.php';
	require_once 'Product.php';
	require_once 'Order.php';
	require_once 'OrderPerMonth.php';

	$con = new Connection;
	$totcount = new TotalCount( $con );
	$product = new Product( $con );
	$order = new Order( $con );
	$opm = new OrderPerMonth( $con );

	$country_names = $order->getCountryName();
	

 ?>