<?php 

	class TotalCount{

		private $con;
		private $table = 'nworders';
		private $table2 = 'nwsuppliers';
		private $table3 = 'nwproducts';
		private $table4 = 'nwemployees';

		public function __construct( $con ){
			$this->con = $con;
		}

		public function getTotalOrders(){
			$total_orders = 0;
			$sql = "SELECT COUNT(OrderID) as totalorders FROM " . $this->table;
			$query = $this->con->select( $sql, null, "Error getting total orders." );
			if ($query) {
				$row = $query->fetch();
				$total_orders = $row['totalorders'];
			}
			return $total_orders;
		}

		public function getTotalSuppliers(){
			$total_suppliers = 0;
			$sql = "SELECT COUNT(SupplierID) as totalsuppliers FROM " . $this->table2;
			$query = $this->con->select( $sql, null, "Error getting total suppliers.");
			if ($query) {
				$row = $query->fetch();
				$total_suppliers = $row['totalsuppliers'];
			}
			return $total_suppliers;
		}

		public function getTotalProducts(){
			$total_products = 0;
			$sql = "SELECT COUNT(ProductID) as totalproducts FROM " . $this->table3;
			$query = $this->con->select( $sql, null, "Error getting total products.");
			if ($query) {
				$row = $query->fetch();
				$total_products = $row['totalproducts'];
			}
			return $total_products;
		}

		public function getTotalEmployees(){
			$total_employees = 0;
			$sql = "SELECT COUNT(EmployeeID) as totalemployees FROM " . $this->table4;
			$query = $this->con->select( $sql, null, "Error getting total employees.");
			if ($query) {
				$row = $query->fetch();
				$total_employees = $row['totalemployees'];
			}
			return $total_employees;
		}
	}

 ?>