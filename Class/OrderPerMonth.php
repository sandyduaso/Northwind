<?php 

	class OrderPerMonth{
		
		private $con;
		private $table = 'nworders';
		
		public function __construct( $con ){
			$this->con = $con;
		}

		public function getYearPercentage( $year ){
			
			$data = array();
			$sql = "SELECT DATE_FORMAT(OrderDate, '%M') AS months,COUNT(OrderID) AS percentage FROM " . $this->table . " WHERE YEAR(OrderDate)=? GROUP BY MONTH(OrderDate)";
			$query = $this->con->select( $sql, array($year), "Error getting percentage.");

			if ( $query ){
				foreach ($query as $key) {
					array_push($data, array('month' => $key['months'], 'percent' => $key['percentage']));
				}
			}

			return json_encode( $data );
		}





		

		// public function getMonth( $year ){

		// 	$month = array();
		// 	$sql = "SELECT DATE_FORMAT(OrderDate, '%M') AS months,COUNT(OrderID) AS percentage FROM " . $this->table . " WHERE YEAR(OrderDate)=? GROUP BY MONTH(OrderDate)";
		// 	$query = $this->con->select( $sql, $year, "Error getting months.");

		// 	if ( $query ){
		// 		foreach ($query as $key) {
		// 			//array_push($months, array('month' => $key['months'], 'percent' => $key['percentage']);
		// 		}
		// 	}

		// 	return json_encode( $months );
		// }


	}

 ?>