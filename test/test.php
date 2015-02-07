<?php 

	require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
		
	use Cantook\Platform;
	use Cantook\Publication;
	use Cantook\Transaction;

	$platform = new Platform("https://edigita.cantook.net", "test", "test", 310);
	$publication = new Publication("9788874028047", "epub", 2.99, "none");
	$response = $platform->callService("simulation", $publication);
	
	var_dump($response);
?>