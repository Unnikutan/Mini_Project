<?php
	include '../db/connection.php';
	include 'office_header.php';
	if(!isset($_SESSION['off_id'])){
		header("location:../office_login.php");
	}
	else{
    $off_id = $_SESSION['off_id'];
    $sql1 = "Select * from tbl_gb where gb_id = '$off_id'";
    $res1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_fetch_array($res1);
?>
<section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2><?php echo $row1['gb_name']?> Office</h2>
        </div>

  </div>
</section>

<section id='office_content'>
	<div class="container">
	<div class="row">
  	<div class="col-sm-3">
   		<div class="card shadow p-3 mb-5 rounded">
    	<div class="card-body">
    		<div class="office_col_head"><i class="bi-trash2-fill"></i></div>
        	<h5 class="card-title">Bins</h5>
        	<p class="card-text office_center">
            <?php 
              $sql2="select * from tbl_bins where gb_id = '$off_id'";
              $res2 = mysqli_query($conn,$sql2);
              $row2 = mysqli_num_rows($res2);
              echo $row2;
            ?>
          </p>
      	</div>
    	</div>
  	</div>
  	<div class="col-sm-3">
   		<div class="card shadow p-3 mb-5 rounded">
    	<div class="card-body">
    		<div class="office_col_head2"><i class="bi-person-fill"></i></div>
        	<h5 class="card-title">Users</h5>
        	<p class="card-text office_center">
            <?php 
              $sql_user="select * from tbl_user where gb_id = '$off_id'";
              $res_user = mysqli_query($conn,$sql_user);
              $row_user = mysqli_num_rows($res_user);
              echo $row_user;
            ?>
          </p>
      	</div>
    	</div>
  	</div>
  	<div class="col-sm-3">
   		<div class="card shadow p-3 mb-5 rounded">
    	<div class="card-body">
    		<div class="office_col_head3"><i class="bi-truck"></i></div>
        	<h5 class="card-title">Trucks</h5>
        	<p class="card-text office_center">
            <?php 
              $sql2="select * from tbl_truck where gb_id = '$off_id'";
              $res2 = mysqli_query($conn,$sql2);
              $row2 = mysqli_num_rows($res2);
              echo $row2;
            ?>
          </p>
      	</div>
    	</div>
  	</div>
  	<div class="col-sm-3">
   		<div class="card shadow p-3 mb-5 rounded">
    	<div class="card-body">
    		<div class="office_col_head4"><i class="bi-exclamation-circle-fill"></i></div>
        	<h5 class="card-title">Complaint</h5>
        	<p class="card-text office_center">
           <?php 
              $sql2="select * from tbl_comp where gb_id = '$off_id'";
              $res2 = mysqli_query($conn,$sql2);
              $row2 = mysqli_num_rows($res2);
              echo $row2;
            ?> 
          </p>
      	</div>
    	</div>
  	</div>
  	</div>
  	</div>
  	<div class="container">
  		<div class="row">
  			<div class="col-md-7 office_bg_color shadow p-3 mb-5 rounded">
  				<div class="office_txt_head">
  					Users
  				</div>
          <div class="table_overflow">
		  		<table class="table table-striped table-hover">
  					<thead class="table-dark">
		  			<tr>
  						<th>#</th>
  						<th>Name</th>
  						<th>Email</th>
  					</tr>
  					</thead>
            <?php
            $i=1; 
            while ($row_user = mysqli_fetch_array($res_user)) {
              ?>
              <tr>
                <td><?php echo $i?></td>
                <td><?php echo $row_user['name']?></td>
                <td><?php echo $row_user['email']?></td>
              </tr>
            <?php
            $i++;
            }
            ?>
  				</table>
        </div>
  			</div>
  			<div class="col-md-5">
  				<div id="office_map">
  				</div>
  			</div>
  		</div>
  	</div>
	<script type="text/javascript">
    <?php 
      $sql="Select * from tbl_office where gb_id = '$off_id'";
      $res = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($res);
    ?>
        function myMap() {
            var mapOptions = {
                center: new google.maps.LatLng(<?php echo $row['lat']?>,<?php echo $row['lon']?>),
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var infoWindow = new google.maps.InfoWindow();
            var latlngbounds = new google.maps.LatLngBounds();
            var map = new google.maps.Map(document.getElementById("office_map"), mapOptions);
            //google.maps.event.addListener(map, 'click', function (e) {
                //alert("Latitude: " + e.latLng.lat() + "\r\nLongitude: " + e.latLng.lng());
                //document.getElementById("la").value=e.latLng.lat();
                //document.getElementById("lo").value=e.latLng.lng();
            //});
        }
  
  </script>
</section>

<?php
	}
	include 'office_footer.php';
?>