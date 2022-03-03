<?php 
	include '../db/connection.php';
	include 'office_header.php';
	if(!isset($_SESSION['off_id'])){
		header("location:../office_login.php");
	}
	else{
		$off_id = $_SESSION['off_id'];
		if(isset($_POST['submit'])){
			$name = $_POST['name'];
			$address = $_POST['t1'];
			$lan = $_POST['la'];
			$lon = $_POST['lo'];
			$sql = "insert into tbl_bins(b_name,gb_id,lat,lon,location) values('$name','$off_id','$lan','$lon','$address')";
			$res = mysqli_query($conn,$sql);
			if($res){
				?>
				<script type="text/javascript">
					alert("Bin Successfully Added");
				</script>
				<?php
			}

		}
?>

<section id="office_content">
	<div class="container">
  		<div class="row">
  			<div class="col-md-7 office_bg_color2 shadow p-3 mb-5 rounded">
  				<div class="office_txt_head">
  					Add Bin
  				</div>
  				<form method="post" action="">
  				<div class ="container">
  					<div class="row">
  						<div class="col-md-6">
							<div class="office_form-group label-floating">
								<label class="office_control-label">Name</label>
								<input  required="" type="text"name="name" class="form-control">
							</div>
	            		</div>
	            		<div class="col-md-8">
							<div class="office_form-group label-floating">
								<label class="office_control-label">Address</label>
								<input  required="" type="text"name="t1" class="form-control">
							</div>
	            		</div>
	            		<div class="col-md-6">
							<div class="office_form-group label-floating">
								<label class="office_control-label">Latitude</label>
								<input  required="" type="text"name="la" id="la" class="form-control">
							</div>
	            		</div>
	            		<div class="col-md-6">
							<div class="office_form-group label-floating">
								<label class="office_control-label">Longitude</label>
								<input  required="" type="text" name="lo" id="lo" class="form-control">
							</div>
	            		</div>
	            	</div>
	            	<center>
	            	<button class="reg_btn" name="submit" type="submit">Add</button>
	            	</center>
	            </div>
	        	</form>
  			</div>
  			<div class="col-md-5">
  				<div id="office_map2">
  				</div>
  			</div>
  		</div>
  	</div>
</section>
<?php 
      $sql_loc="Select * from tbl_office where gb_id = '$off_id'";
      $res_loc = mysqli_query($conn,$sql_loc);
      $row_loc = mysqli_fetch_array($res_loc);
    ?>
<script type="text/javascript">
        function myMap() {
            var mapOptions = {
                center: new google.maps.LatLng(<?php echo $row_loc['lat']?>,<?php echo $row_loc['lon']?>),
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var infoWindow = new google.maps.InfoWindow();
            var latlngbounds = new google.maps.LatLngBounds();
            var map = new google.maps.Map(document.getElementById("office_map2"), mapOptions);
            google.maps.event.addListener(map, 'click', function (e) {
                //alert("Latitude: " + e.latLng.lat() + "\r\nLongitude: " + e.latLng.lng());
                document.getElementById("la").value=e.latLng.lat();
                document.getElementById("lo").value=e.latLng.lng();
            });
        }
  
  </script>
<?php
	}
	include 'office_footer.php';
?>