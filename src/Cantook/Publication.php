<?php 

	namespace Cantook;

	class Publication {
		private $data = array();
		private $fields = array("isbn", "format", "cost", "protection", "cost_without_taxes", "price_type", "currency");

		public function __construct($isbn, $format, $cost, $protection) {
			$this->isbn = $isbn;
			$this->format = $format;
			$this->cost = $cost;
			$this->protection = $protection;
		}
		
		public function __get($property) {
			if (array_key_exists($property, $this->data)) return $this->data[$property];
			return null;
		}

		public function __set($property, $value) {
			if (in_array($property, $this->fields)) {
				switch ($property) {
					case "cost":
						$value = (int) ($value * 100);
						break;
					case "cost_without_taxes":
						$value = (int) ($value * 100);
						break;
				}
				
				$this->data[$property] = $value;
			}
			return $this;
		}	
		
		public function toArray() {
			return $this->data;
		}	
	}
?>