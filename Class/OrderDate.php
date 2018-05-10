<?php 

	class OrderDate{
		
		private $con;
		private $table = 'nworders';
		
		public function __construct( $con ){
			$this->con = $con;
		}


	}

 ?>