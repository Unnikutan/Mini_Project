<?php
	include '../db/connection.php';
	include 'driver_header.php';
	if(!isset($_SESSION['driver_id'])){
		header("location:../driver_login.php");
	}
	else{
		$dr_id = $_SESSION['driver_id'];
		$sql = "Select * from tbl_driver where id = '$dr_id' ";
		$res = mysqli_query($conn,$sql);

?>
<script src="../leaflet/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Welcome <?php 
  							$row=mysqli_fetch_array($res);
  							echo $row['name'];
  						?></h2>
        </div>

  </div>
</section>
<section id="office_content">
	<div class="container">
  		<div class="row">
		  	<div class="col-sm-4">
		   		<div class="card shadow p-3 mb-5 rounded">
		    		<div class="card-body">
		    			<div class="office_col_head"><i class="bi-trash2-fill"></i></div>
		        		<h5 class="card-title"><u>Working Hours</u></h5>
		        		<p class="card-text office_center">
		        			MONDAY - FRIDAY : 10am - 6pm<br>
		        			SATURDAY : 10am - 8pm<br>
		        			SUNDAY : Leave if no route
		          		</p>
		      		</div>
		    	</div>
  			</div>
  			<div class="col-sm-4">
		   		<div class="card shadow p-3 mb-5 rounded">
		    		<div class="card-body">
		    			<div class="office_col_head"><i class="bi-truck"></i></div>
		        		<h5 class="card-title"><u>Trucks Assigned</u></h5>
		        		<p class="card-text office_center">
				            <?php 
				              	$mql = "Select * from tbl_truck where driver_id='$dr_id'";
								$mes = mysqli_query($conn,$mql);
				              	$row2 = mysqli_num_rows($mes);
				              	?>
				              	No : of Trucks :
				              	<?php echo $row2?>
				              	<br>
				              	Truck Numbers : 
				              	<?php 
				              		while($mow = mysqli_fetch_array($mes)){
				              			echo $mow['truck_no']."<br>";
				              		}
				              	?>
		          		</p>
		      		</div>
		    	</div>
  			</div>
  			<div class="col-sm-4">
		   		<div class="card shadow p-3 mb-5 rounded">
		    		<div class="card-body">
		    			<div class="office_col_head"><i class="bi-trash2-fill"></i></div>
		        		<h5 class="card-title"><u>Salary</u></h5>
		        		<p class="card-text office_center">
		        			Basic : 10000<br>
		        			Bonus : 5000 for over duty <br>
		        			Total : 15000
		          		</p>
		      		</div>
		    	</div>
  			</div>
  		</div>
  	</div>
  	<br>
  	<br>
  	<div class="container">
  		<div class="row">
  				<div class="col-md-5 office_bg_color shadow p-3 mb-5 rounded">
					<div class="office_txt_head">
  						Todays route for you
  					</div>
  					<div class="table_overflow">
						<table class="table table-hover">
							<tr>
								<th>#</th>
								<th>Route_name</th>
								<th>Truck Number</th>
							</tr>
							<?php
							$sql1 = "Select r.route_id,r.route_name,r.itr,t.truck_no from tbl_route r inner join tbl_truck t on t.truck_no = r.truck_no where t.driver_id = '$dr_id'";
							$res1 = mysqli_query($conn,$sql1);
							$i=1;
							$date = date("w");
							if ($date == 1 || $date == 3 || $date == 5){
								$value = 1;
								}
							elseif ($date == 2 || $date == 4 || $date == 6) {
								$value = 2;
							}
							while($row1=mysqli_fetch_array($res1)){
								if($row1['itr']==0||$row1['itr']==$value){
							?>
							<form method="post" action="">
							<input type="text" name="id" value="<?php echo $row1['route_id'];?>" hidden>
							<tr>
								<td><?php echo $i; ?></td>
								<td><Button name='submit' type='submit'><?php echo $row1['route_name']; ?></Button></td>
								<td><?php echo $row1['truck_no'] ?></td>
							</tr>
							</form>
							<?php
								$i++;
								}
								elseif($row1['itr']==0||$row1['itr']==$value){
								?>
								<form method="post" action="">
								<input type="text" name="id" value="<?php echo $row1['route_id'];?>" hidden>
								<tr>
									<td><?php echo $i; ?></td>
									<td><Button name='submit' type='submit'><?php echo $row1['route_name']; ?></Button></td>
									<td><?php echo $row1['truck_no'] ?></td>
								</tr>
								</form>
								<?php
									$i++;
									}
								}
							?>
						</table>
					</div>
  				</div>
  				<div class="col-md-7">
  					<div id="office_map2">
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  </section>
  <?php
  if(isset($_POST['submit'])){
		$route_id = $_POST['id'];
		$sql2 = "select * from tbl_route_details where route_id = '$route_id' ";
		$res2 = mysqli_query($conn,$sql2);
		?>
	<script type="text/javascript">
				var map = L.map('office_map2').setView([8.908283252994574,77.05554988036177],16);
				L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=rnildL47RCqVyg8E4kOb',{
				attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
				}).addTo(map);
				L.Routing.control({
 	 			waypoints: [
 	 			<?php
 	 			while($len=mysqli_fetch_array($res2)) {
	 	 			$bin_id = $len['bins'];
	 	 			$sql4 = "select * from tbl_bins where bin_id='$bin_id'";
	 	 			$result = mysqli_query($conn,$sql4);
	 	 			$val = mysqli_fetch_array($result);
	 	 			?>
	 	 			L.latLng(<?php echo $val['lat']?>, <?php echo $val['lon']?>),
 	 			<?php } ?>
  					]	
				}).addTo(map);
	</script>
	<?php
	}
	?>
<?php
	}
	include 'driver_footer.php';
?>