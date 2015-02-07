<?php 	
	namespace Cantook;
	use Httpful;
		
	class Platform {
		private $platform = null;
		private $username = null;
		private $password = null;
		private $organisation_id = null;

		public function __construct($platform, $username, $password, $organisation_id) {
			$this->platform = $platform;
			$this->username = $username;
			$this->password = $password;
			$this->organisation_id = $organisation_id;
		}
		
		public function __get($property) {
			if (property_exists($this, $property)) return $this->$property;
		}

		public function __set($property, $value) {
			if (property_exists($this, $property)) $this->$property = $value;
			return $this;
		}
		
		public function callService($service, $publication, $transaction = null) {
			$data = array("organisation_id" => $this->organisation_id);
			if(isset($publication)) $data = array_merge($data, $publication->toArray());
			if(isset($transaction)) $data = array_merge($data, $transaction->toArray());
			
			//parameters in url
			$filter = array_flip(Config::$services[$service]["parameters"]);
			$parameters = array_intersect_key($data, $filter);
			
			//prepare url
			$filter = Config::$services[$service]["parameters_in_url"];
			$parameters_in_url = array_intersect_key($data, $filter);
			ksort($parameters_in_url);
			ksort($filter);
			$url = str_replace($filter, $parameters_in_url, Config::$services[$service]["url"]);
			
			//request
			return $this->makeRequest($url, Config::$services[$service]["method"], $parameters);
		}
		
		private function makeRequest($url, $method, $parameters) {
			//http://phphttpclient.com/docs/class-Httpful.Request.html
			$query = http_build_query($parameters);
			$response = Httpful\Request::put($this->platform.$url."?".$query)  	// Build a PUT request...
				->method($method)
				->authenticateWith($this->username, $this->password)  			// authenticate with basic auth...
				->expects("plain")
				->send();                                   					// and finally, fire that thing off!
			
			$message = ($response->code != 200) ? json_decode($response->body)[0] : $response->body;
			
			return array("url" => $response->request->uri, "code" => $response->code, "response" => $message);
		}
	}
?>