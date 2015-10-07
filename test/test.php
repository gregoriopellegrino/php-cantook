<?php 

	require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
		
	use Cantook\Platform;
	use Cantook\Publication;
	use Cantook\Transaction;

	$platform = new Platform("https://edigita.cantook.net", "username", "password", 310, "ita");
	$publication = new Publication("9788874028047", "epub", 2.99, "none", "EUR");
	$response = $platform->callService("simulation", $publication);
	
	echo "simulation: ";
	var_dump($response);

	$transaction = new Transaction("01234", "01234", "Gregorio Pellegrino");
	$transaction->sale_state = "test";
	$response = $platform->callService("sale", $publication, $transaction);

	echo "sale: ";
	var_dump($response);
	
	$response = $platform->callService("download", $publication, $transaction);
	
	echo "download: ";
	var_dump($response);
?>