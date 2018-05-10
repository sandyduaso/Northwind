<?php 

	class Product{
		private $con;
		private $table = "nworderdetails";
		private $table1 = "nwproducts";

		public function __construct( $con ){
			$this->con = $con;
		}

		public function getTopProducts(){
			$sql = "SELECT ProductName
					FROM " . $this->table . " a
					JOIN " . $this->table1 . " b
					ON a.ProductID = b.ProductID
					GROUP BY b.ProductID ORDER BY SUM(Quantity) DESC LIMIT 10";
			$query = $this->con->select( $sql, null, "Error getting top products.");
			if ($query) {
				return $query;
			}
		}
	}



 ?>