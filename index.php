<?php 
	require_once('Class/Initialize.php');
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	
 	<link rel="stylesheet" type="text/css" href="assets/bootstrap.min.css">
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 	<title>Northwind</title>
 
 </head>
 <body>


 	<div class="container-fluid">
 		<div id="header"></div>
 		<div class="row col-lg-12">
 			<label id="dash">Dashboard</label>
 		</div>
 		<div class="row">
			<div class="col-lg-3">
				<div class="block" id="block-1">
					<p>Orders</p>
					<h2><?php echo $totcount->getTotalOrders(); ?></h2>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="block" id="block-2">
					<p>Suppliers</p>
					<h2><?php echo $totcount->getTotalSuppliers(); ?></h2>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="block" id="block-3">
					<p>Products</p>
					<h2><?php echo $totcount->getTotalProducts(); ?></h2>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="block" id="block-4">
					<p>Total Employee</p>
					<h2><?php echo $totcount->getTotalEmployees(); ?></h2>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-5">
				<div class="blocks" id="blocks-1">
					<p>Orders Per Year</p>
					<label id="slect">Select Year :</label>
					<select id="year" name="year">
						<option value="1996">1996</option>
						<option value="1997">1997</option>
						<option value="1998">1998</option>
					</select>
					<div class="x_content">
						<canvas id="lineChart"></canvas>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="blocks" id="blocks-1">
					<p>Top 10 Countries with most Orders</p>
					<div class="x_content">
						<canvas id="pieChart"></canvas>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="blocks" id="blocks-1">
					<p>Best Sellers</p>
					<div class="table-responsived">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Product Name</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$n=0;
									$query = $product->getTopProducts();
									foreach ( $query as $data ) {
										$n++;
										echo "<tr>
												<td>".$n."</td>
												<td>".$data['ProductName']."</td>
											  </tr>";
									}

								 ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
 	</div>



 
	<script src="assets/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/bootstrap.min.js"></script>
    <!-- Chart.js -->
    <script src="assets/Chart.min.js"></script>

    <script type="text/javascript">
    	Chart.defaults.global.legend = {
        enabled: false
      	};	
    	var ctx = document.getElementById("lineChart");
        var lineChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: [],
            datasets: [ {
              label: "Orders Per Month",
              backgroundColor: "rgba(38, 185, 154, 0.31)",
              borderColor: "rgba(38, 185, 154, 0.7)",
              pointBorderColor: "rgba(38, 185, 154, 0.7)",
              pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
              pointHoverBackgroundColor: "#fff",
              pointHoverBorderColor: "rgba(220,220,220,1)",
              pointBorderWidth: 1,
              data: []
            }]
          },
        });

        $(document).ready(function(){
        		$("#year").on("change",function(){
        			var yr = $("#year").val();
        			$.ajax({
        				url:"support/support.php",
        				method:"POST",
        				data:"yearpercent="+yr,
        				cache: false,
        				success: function(data){
        					var month=[];
        					var order=[];
        					var rs = jQuery.parseJSON(data);
        					for (var i in rs) {
        						month.push(rs[i].month);
        						order.push(rs[i].percent);
        					}
        					// alert(month+order);

        					    	var ctx = document.getElementById("lineChart");
							        var lineChart = new Chart(ctx, {
							          type: 'line',
							          data: {
							            labels: month,
							            datasets: [ {
							              label: "Orders Per Month",
							              backgroundColor: "rgba(38, 185, 154, 0.31)",
							              borderColor: "rgba(38, 185, 154, 0.7)",
							              pointBorderColor: "rgba(38, 185, 154, 0.7)",
							              pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
							              pointHoverBackgroundColor: "#fff",
							              pointHoverBorderColor: "rgba(220,220,220,1)",
							              pointBorderWidth: 1,
							              data: order
							            }]
							          },
							        });        					
        				}
        			})
        		});
        });
		    	
      	
    	$.ajax({
			type:"POST",
			url:"support/support.php",
			data:"countryorder=1",
			cache:false,
			success:function(data){
			// Pie chart
			var ctx = document.getElementById("pieChart");
			var data = {
			    datasets: [{
			      data: jQuery.parseJSON( data ),
			      backgroundColor: [
			        "#335271",
			        "#9a59b5",
			        "#bec3c7",
			        "#26ba99",
			        "#3598db",
			        "#6299da",
			        "#4350d1",
			        "#3313e0",
			        "#fca024",
			        "#570cba"
			      ],
			      label: 'My dataset' // for legend
			    }],
			    labels: <?php echo $country_names; ?>
			  };
			  var pieChart = new Chart(ctx, {
			    data: data,
			    type: 'pie',
			    otpions: {
			    legend: false
			    }
			  });	
			}
		})
    </script>
 
 </body>
 </html>