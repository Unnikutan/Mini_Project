<?php
	include '../db/connection.php';
	include 'driver_header.php';
	if(!isset($_SESSION['driver_id'])){
		header("location:../driver_login.php");
	}
	else{
		$dr_id = $_SESSION['driver_id'];
		if(!isset($error_pass)){
			$error_pass="";
		}
		if (isset($_POST['p_submit'])){
			$name = $_POST['name'];
			$age = $_POST['age'];
			$gender = $_POST['gender'];
			$exp = $_POST['exp'];
			$username = $_POST['user'];
			$aadhaar = $_POST['adhar'];
			$phno = $_POST['phno'];
			$address = $_POST['address'];
			$sql1 = "update tbl_driver set name='$name',age='$age',gender='$gender',exp='$exp',username='$username',aadhaar='$aadhaar',phno='$phno',address='$address' where id='$dr_id'";
			$result = mysqli_query($conn,$sql1);
			if($result){
				$sql2 = "update tbl_login set username='$username' where type=2 and enter_id='$dr_id'";
				$result2=mysqli_query($conn,$sql2);
				?>
				<script type="text/javascript">
					alert("Data Updated");
				</script>
				<?php
			}
		}
		if(isset($_POST['pass_submit'])){
			$cur_pass = $_POST['cur_pass'];
			$new_pass = $_POST['new_pass'];
			$re_pass = $_POST['re_pass'];
			$sql4 = "Select password from tbl_driver where id='$dr_id'";
			$res4 = mysqli_query($conn,$sql4);
			$row=mysqli_fetch_array($res4);
			$pass = $row['password'];
			if ($pass != $cur_pass){
				$error_pass = " Current Password doesn't match";
			}
			elseif($new_pass != $re_pass){
				$error_pass = " Password and Confirm password do not match ";
			}
			else{
				$sql_ins = "update tbl_driver set password='$new_pass' where id = '$dr_id'";
				$res_ins = mysqli_query($conn,$sql_ins);
				if($res_ins){
					$sql_lo = "update tbl_login set password='$new_pass' where type=2 and enter_id = '$dr_id'";
					$res_lo = mysqli_query($conn,$sql_lo);
					if($res_lo){
						?>
						<script type="text/javascript">
							alert("Password changed successfully");
						</script>
						<?php
					}
				}
			}
		}
?>
<section id="office_content">
	<div class="container">
		<div class="row">
			<div class="col-md-12 driver_bg_12 shadow p-3 mb-5 rounded">
				<div class="office_txt_head">
  					Personal Profile
  				</div>
  				<div class="col-md-12 driver_align_right">
  					<button class="admin_edit_btn2" id="admin_edit_editbtn"><i class="bi-pencil-square"></i>&nbsp;edit</button>
  				</div>
  				<form id="myform" method="post" action="">
  				<div class="row">
	  				<div class="col-md-6">
	  					<div class="driver_table">
	  						<?php 
	  							$sql = "Select * from tbl_driver where id='$dr_id'";
	  							$res = mysqli_query($conn,$sql);
	  							$row = mysqli_fetch_array($res);
	  						?>
		  					<table>
		  						<tr>
		  							<td> Name </td>
		  							<td> <input type="text" name="name" value="<?php echo $row['name'] ?>" disabled></td>
		  						</tr>
		  						<tr>
		  							<td> Gender </td>
		  							<td> <input type="text" name="gender" value="<?php echo $row['gender'] ?>" disabled></td>
		  						</tr>
		  						<tr>
		  							<td> Experience </td>
		  							<td> <input type="text" name="exp" value="<?php echo $row['exp'] ?>" disabled></td>
		  						</tr>
		  						<tr>
		  							<td> Username </td>
		  							<td><input type="email" name="user" value="<?php echo $row['username'] ?>" disabled></td>
		  						</tr>
		  					</table>
		  				</div>
	  				</div>
	  				<div class="col-md-5">
	  					<div class="driver_table">
	  						<?php 
	  							$sql = "Select * from tbl_driver where id='$dr_id'";
	  							$res = mysqli_query($conn,$sql);
	  							$row = mysqli_fetch_array($res);
	  						?>
		  					<table>
		  						<tr>
		  							<td> Age </td>
		  							<td> <input type="text" name="age" value="<?php echo $row['age'] ?>" disabled></td>
		  						</tr>
		  						<tr>
		  							<td> Aadhaar Number </td>
		  							<td> <input type="text" name="adhar" value="<?php echo $row['aadhaar'] ?>" disabled></td>
		  						</tr>
		  						<tr>
		  							<td> Phone Number </td>
		  							<td><input type="text" name="phno" value="<?php echo $row['phno'] ?>" disabled></td>
		  						</tr>
		  						<tr>
		  							<td> Address</td>
		  							<td><textarea name="address" rows="2" cols="23" disabled><?php echo $row['address'] ?></textarea></td>
		  						</tr>
		  					</table>
		  				</div>
	  				</div>
	  				<center >
	  					<button type="submit" name="p_submit" class="reg_btn" disabled>Save Changes</button>
	  				</center>
  				</div>
  				</form>
  			</div>
  		</div>
  		<div class="row">
			<div class="col-md-12 driver_bg_color shadow p-3 mb-5 rounded">
				<div class="office_txt_head">
  					Personal Profile
  				</div>
  				<div class="container">
  				<div class="row">
	  				<div class="col-md-6">
	  					<div class="driver_table">
	  						<?php 
	  							$sql = "Select * from tbl_truck where driver_id='$dr_id'";
	  							$res = mysqli_query($conn,$sql);
	  							$row=mysqli_num_rows($res);
	  						?>
		  					<table>
		  						<tr>
		  							<td> Number of Trucks given </td>
		  							<td> <?php echo $row ?></td>
		  						</tr>
		  						<tr>
		  							<td> Trucks </td>
		  							<td>
		  							<?php
		  							while($row=mysqli_fetch_array($res)){
		  								 echo $row['truck_no']."<br>";	
		  							}
		  							?>
		  							</td>
		  						</tr>
		  					</table>
		  				</div>
	  				</div>
	  				<div class="col-md-5">
	  					<div class="driver_table">
	  						<?php 
	  							$sql = "Select r.route_id,r.route_name,r.itr,t.truck_no from tbl_route r inner join tbl_truck t on t.truck_no = r.truck_no where t.driver_id = '$dr_id'";
	  							$res = mysqli_query($conn,$sql);
	  						?>
		  					<table>
		  						
		  						</tr>
		  						<tr>
		  							<td> Number of Routes given</td>
		  							<td> <?php 
		  								$row=mysqli_num_rows($res);
		  								echo $row;
		  							?></td>
		  						</tr>
		  						<tr>
		  							<td> Route name </td>
		  							<td><?php
		  							while($row=mysqli_fetch_array($res)){
		  								 echo $row['route_name']."<br>";	
		  							}
		  							?></td>
		  						</tr>
		  					</table>
		  				</div>
	  				</div>
  				</div>
  				</div>

  			</div>
  		</div>
  		<div class="row">
  			<form method="post" action="profile.php#password_change" id="password_change">
			<div class="col-md-12 driver_bg_color shadow p-3 mb-5 rounded">
				<div class="office_txt_head">
  					Change Password
  				</div>
  				<center>
  					<div class="driver_table">
  					<table>
  						<tr>
  							<td>Current Password</td>
  							<td><input type="password" name="cur_pass" required></td>
  						</tr>
  						<tr>
  							<td>New Password</td>
  							<td><input type="password" name="new_pass" required></td>
  						</tr>
  						<tr>
  							<td>Confirm Password</td>
  							<td><input type="password" name="re_pass" required></td>
  						</tr>
  					</table>
  					<?php echo $error_pass; ?>
  					</div>
  					<button type="submit" name="pass_submit" class="reg_btn">Change Password</button>
  				</center>
  			</div>
  			</form>
  		</div>
  	</div>
  </section>
<?php
	}
	include 'driver_footer.php';
?>