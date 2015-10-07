<?php
	namespace Cantook;
	use Httpful;

	class Config {
		public static $services = array(
			//simulation
			"simulation" => array(
				"method" => Httpful\Http::GET,
				"url" => "/api/organisations/%organisation_id%/publications/%isbn%/sales/new",
				"parameters_in_url" => array(
					"organisation_id" => "%organisation_id%",
					"isbn" => "%isbn%"
				),
				"parameters" => array(
					"format", "cost", "protection", "country", "cost_without_taxes", "price_type", "currency"
				)
			),
	
			//sale
			"sale" => array(
				"method" => Httpful\Http::POST,
				"url" => "/api/organisations/%organisation_id%/publications/%isbn%/sales",
				"parameters_in_url" => array(
					"organisation_id" => "%organisation_id%",
					"isbn" => "%isbn%"
				),
				"parameters" => array(
					"format", "cost", "protection", "customer_id", "transaction_id", "credit_card_prefix", "sale_state", "country", "aggregator", "uname", "currency"
				)
			),
	
			//download
			"download" => array(
				"method" => Httpful\Http::GET,
				"url" => "/api/organisations/%organisation_id%/customers/%customer_id%/transactions/%transaction_id%/publications/%isbn%/download_links/%format%",
				"parameters_in_url" => array(
					"organisation_id" => "%organisation_id%",
					"customer_id" => "%customer_id%",
					"transaction_id" => "%transaction_id%",
					"isbn" => "%isbn%",
					"format" => "%format%"
				),
				"parameters" => array(
					"uname"
				)
			)
		);
	}
?>