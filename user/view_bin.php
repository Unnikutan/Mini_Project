<?php
	include '../db/connection.php';
	include 'user_header.php';
	if(!isset($_SESSION['user_id'])){
		header("location:../user_login.php");
	}
	else{
		$user_id = $_SESSION['user_id'];
		$query = "Select gb_id from tbl_user where u_id = '$user_id'";
		$res_query = mysqli_query($conn,$query);
		$row_query = mysqli_fetch_array($res_query);
		$off_id = $row_query['gb_id'];
?>
<script src="../leaflet/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<section id="office_content">
	<div class="container">
		<div class="row">
			<div class="col-md-5 office_bg_color shadow p-3 mb-5 rounded">
				<div class="office_txt_head">
  					Bins
  				</div>
  				<div class="table_overflow">
				<table class="table table-hover">
					<tr>
						<th>#</th>
						<th>Bin</th>
						<th>Status</th>
						<th></th>
					</tr>
					<?php
					$sql1 = "Select * from tbl_bins where gb_id = '$off_id'";
					$res1 = mysqli_query($conn,$sql1);
					$i=1;
					while($row1=mysqli_fetch_array($res1)){
					?>
					<form method="post" action="">
					<input type="text" name="id" value="<?php echo $row1['bin_id'];?>" hidden>
					<tr>
						<td><?php echo $i; ?></td>
						<td><Button name='submit' type='submit'><?php echo $row1['b_name']; ?></Button></td>
						<td><a href="bin_status.php?id=<?php echo $row1['bin_id'] ?>"><button type="button">View Status</button></a></td>
						<td><a href="bin_remove.php?id=<?php echo $row1['bin_id'] ?>"><button class="btn_bin_clear" type="button" onclick="return confirm('Are you sure want to delete')"><i class="bi-trash-fill"></i></button></td>
					</tr>
					</form>
					<?php
						$i++;
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
		$bin_id = $_POST['id'];
		echo $bin_id;
		$sql2 = "select * from tbl_bins where bin_id = '$bin_id' ";
		$res2 = mysqli_query($conn,$sql2);
		$row2 = mysqli_fetch_array($res2);
		?>
<script type="text/javascript">
	var map = L.map('office_map2').setView([<?php echo $row2['lat']; ?>, <?php echo $row2['lon']; ?>],20);
	L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=rnildL47RCqVyg8E4kOb',{
		attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
	}).addTo(map);
	var marker = L.marker([<?php echo $row2['lat']; ?>, <?php echo $row2['lon']; ?>]).addTo(map);
</script>
	<?php
	}
	else{
	$sql = "Select * from tbl_bins where gb_id='$off_id'";
	$res = mysqli_query($conn,$sql);
?>
<?php 
      $sql_loc="Select * from tbl_office where gb_id = '$off_id'";
      $res_loc = mysqli_query($conn,$sql_loc);
      $row_loc = mysqli_fetch_array($res_loc);
    ?>
<script type="text/javascript">
	var map = L.map('office_map2').setView([<?php echo $row_loc['lat']?>,<?php echo $row_loc['lon']?>],16);
	L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=rnildL47RCqVyg8E4kOb',{
		attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
	}).addTo(map);
	<?php
	while($row=mysqli_fetch_array($res)){?>
	var marker = L.marker([<?php echo $row['lat']; ?>, <?php echo $row['lon']; ?>]).addTo(map);
	marker.bindPopup("<?php echo $row['b_name']; ?>");
	<?php
	}
	?>	
	</script>
<?php
		}	
	}
	include 'office_footer.php';
?>