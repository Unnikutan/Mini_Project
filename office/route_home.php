<?php
	include '../db/connection.php';
	include 'office_header.php';
	if(!isset($_SESSION['off_id'])){
		header("location:../office_login.php");
	}
	else{
		$off_id=$_SESSION['off_id'];
?>
<script src="../leaflet/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <div class="container">
			<div class="row">
				<div class="col-sm-2">
					<a href="route.php" style="color: black">
						<button type="button" class="reg_btn_route">Add Route <i class="bi-distribute-horizontal"></i></button>
	      			</a>
	      		</div>
				<div class="col-sm-2 ">
					<a href="route_edit.php" style="color: black">
						<button type="button" class="reg_btn_route">Edit Route <i class="bi-geo-fill"></i></button>
	      			</a>	
				</div>
				<div class="col-sm-2 ">	
					<a href="route_assign_truck.php" style="color: black">
						<button type="button" class="reg_btn_route">Assign Truck <i class="bi-check-lg"></i></button>
	      			</a>	
				</div>
			</div>
		</div>
    </div>
</section>
<section id="office_content">
	<div class="container">
		<div class="row">
			<div class="col-md-5 office_bg_color shadow p-3 mb-5 rounded">
				<div class="office_txt_head">
  					Todays Route
  				</div>
  				<div class="table_overflow">
				<table class="table table-hover">
					<tr>
						<th>#</th>
						<th>Route_name</th>
						<th>Truck Number</th>
					</tr>
					<?php
					$sql1 = "Select * from tbl_route where gb_id='$off_id'";
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
</section>
<?php
	
	if(isset($_POST['submit'])){
		$route_id = $_POST['id'];
		$sql2 = "select * from tbl_route_details where route_id = '$route_id' ";
		$res2 = mysqli_query($conn,$sql2);
      	$sql_loc="Select * from tbl_office where gb_id = '$off_id'";
      	$res_loc = mysqli_query($conn,$sql_loc);
      	$row_loc = mysqli_fetch_array($res_loc);
		?>
	<script type="text/javascript">
				var map = L.map('office_map2').setView([<?php echo $row_loc['lat']?>,<?php echo $row_loc['lon']?>],16);
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
	else{
	$sql = "Select * from tbl_bins";
	$res = mysqli_query($conn,$sql);
?>

<?php
		}	
	}
	include 'office_footer.php';
?>