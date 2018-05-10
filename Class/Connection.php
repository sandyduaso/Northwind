<?php 

	class Connection{

		private $server = 'localhost';
		private $dbuser = 'root';
		private $dbpass = '';
		private $db = 'northwind';
		private $dsn;
		private $conn;
		private $error_msg;
		private $query;
		
		public function __construct(){
			$this->setDSN();
			$this->setConnection();
		}

		public function setDSN(){
			$this->dsn = 'mysql:host='.$this->server.';dbname='.$this->db;

		}

		public function setConnection(){
			$options = array(
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION

			);

			try {
				$this->conn = new PDO( $this->dsn, $this->dbuser, $this->dbpass, $options);
			} catch (PDOException $e) {
				die('Error Getting Coneection Becase ' .$e->getMessage());
			}

		}

		public function select( $prepared_sql, $values, $error_msg ){
			$this->error_msg = $error_msg;
			$this->query = $this->conn->prepare( $prepared_sql );
			$this->executeQuery( $values );
			return $this->query;
		}

		public function executeQuery( $values ){
			$this->query->execute( $values ) or die( $this->error_msg );
		}

	}


 ?>