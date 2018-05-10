<?php 

	class Order{
		private $con;
		private $table = 'nworders';
		public function __construct( $con ){
			$this->con = $con;	
		}

		public function getCountryName(){
			$countryname = array();
			$sql = "SELECT ShipCountry FROM " . $this->table . " GROUP BY ShipCountry ORDER BY COUNT(OrderID) DESC LIMIT 10";
			$query = $this->con->select( $sql, null, "Error getting country names," );
			if ($query) {
				foreach ($query as $key) {
					array_push($countryname,$key['ShipCountry']);
				}
			}
			return json_encode($countryname);
		}

		public function getCountryOrders(){
			$countryorder = array();
			$sql = "SELECT COUNT(OrderID) as orders FROM " . $this->table . " GROUP BY ShipCountry ORDER BY orders DESC LIMIT 10";
			$query = $this->con->select( $sql, null, "Error getting country orders." );
			if ($query) {
				foreach ($query as $key) {
					array_push($countryorder,$key['orders']);
				}
			}
			return json_encode($countryorder);
		}
	}

 ?>