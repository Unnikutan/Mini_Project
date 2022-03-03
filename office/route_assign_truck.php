<?php
	include '../db/connection.php';
	include 'office_header.php';
	if(!isset($_SESSION['off_id'])){
		header("location:../office_login.php");
	}
	else{
		$gb_id = $_SESSION['off_id'];
		$sql = "SELECT * FROM tbl_route where gb_id = '$gb_id'";
		$res = mysqli_query($conn,$sql);
?>
<script src="../leaflet/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<section id="office_content">
	<div class="container">
		<div class="row">
			<div class="col-md-12 office_bg_color shadow p-3 mb-5 rounded">
				<div class="office_txt_head">
  					Assign Truck to Routes
  				</div>
  				<center>
  				<?php 
  					if (isset($_POST['find'])){
  						$route_id = $_POST['route_id'];
  						$sql2 = "SELECT * FROM tbl_route where route_id='$route_id'";
  						$result = mysqli_query($conn,$sql2);
  						$row2 = mysqli_fetch_array($result);
  					?>
   				<table>
   					<form method="post" action="route_update.php">
   					<input type="text" name="route_id" value="<?php echo $row2['route_id']?>"hidden>
  					<tr>
  						<th> Route </th>
  						<td><?php echo $row2['route_name'] ?></td>
  					</tr>
  					<tr>
  						<th>Current Truck</th>
  						<td><?php 
  							if($row2['truck_no']){ 
  								echo $row2['truck_no'];
  							} 
  							else{
  								echo "NOT ASSIGNED";
  							}
  							?>
  						</td>
  					</tr>
  					<tr>
  						<th> Select Truck</th>
  						<?php 
  							$sql3 = "Select * from tbl_truck where gb_id='$gb_id'";
  							$res2 = mysqli_query($conn,$sql3);
  						?>
  						<td>
  							<select name="truck_select" required>
  								<?php 
  								while($row3=mysqli_fetch_array($res2)){ ?>
  								<option><?php echo $row3['truck_no']?></option>
  							<?php } ?>
  							</select>
  						</td>
  					</tr>
  					<tr>
  						<th> Date</th>
  						<td> <input type="Date" name="date" required></td>
  					</tr>
  					<tr>
  						<th> Trip Schedule</th>
  						<td> <input type="radio" name="trip" value="0"> Everyday <br><input type="radio" name="trip" value="1"> MON - WED - FRI<br><input type="radio" name="trip" value="2"> TUE - THU - SAT</td>
  					</tr>
  				</table>
  				<button type="submit" name="submit" class="reg_btn">Submit</button>
  				<a href="route_assign_truck.php"><button type="button" name="submit" class="reg_btn">Back</button></a>
  			</form>
  			<?php } 
  					else{
  			?>
  				<form method="post" action="">
  				<table>
  					<tr>
  						<th> Select Route</th>
  						<td><select name="route_id">
  							<?php 
  							while($row=mysqli_fetch_array($res)){
  							?>
  							<option value="<?php echo $row['route_id']?>"><?php echo $row['route_name'];?></option>
  						<?php } ?>
  						</select></td>
  					</tr>
  				</table>
  				<button type="submit" name="find" class="reg_btn">Select</button>
  			</form>
  			<?php } ?>
  			</center>
  			</div>
  		</div>
  	</div>
</section>


<?php
	}
	include 'office_footer.php';
?>