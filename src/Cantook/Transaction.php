<?php 

	namespace Cantook;

	class Transaction {
		private $data = array();
		private $fields = array("customer_id", "transaction_id", "credit_card_prefix", "sale_state", "country", "aggregator", "uname");

		public function __construct($customer_id, $transaction_id, $uname) {
			$this->customer_id = $customer_id;
			$this->transaction_id = $transaction_id;
			$this->uname = $uname;
		}
		
		public function __get($property) {
			if (array_key_exists($property, $this->data)) return $this->data[$property];
			return null;
		}

		public function __set($property, $value) {
			if (in_array($property, $this->fields)) $this->data[$property] = $value;
			return $this;
		}
		
		public function toArray() {
			return $this->data;
		}
	}
?>