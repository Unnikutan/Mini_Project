<?php
	include '../db/connection.php';
	include 'admin_header.php';
	if(isset($_POST["submit"])){
		$mname = $_POST["name"];
		$mpc = $_POST["pc"];
		$pos = $_POST["position"];
		$mlocation = $_POST["loc"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$repass = $_POST["re-pass"];
		$query1 = "select * from tbl_gb where username = '$username'";
		$res = mysqli_query($conn,$query1);
		if (mysqli_num_rows($res)>0){
			$err_user = "* username already exist";
			?>
			<script type="text/javascript">
				$(document).ready(function(){
					$(".admin_add_mnc").show();
				});
			</script>
			<?php
		}
		elseif ($password!=$repass) {
			$err_repass = "* Password does not match";
			?>
			<script type="text/javascript">
				$(document).ready(function(){
					$(".admin_add_mnc").show();
				});
			</script>
			<?php
		}
		else{
			$sql ="insert into tbl_gb(gb_name,person,position,address,username,password) values('$mname','$mpc','$pos','$mlocation','$username','$password')";
			$result = mysqli_query($conn,$sql);
			$resql = "SELECT gb_id from tbl_gb ORDER BY gb_id DESC LIMIT 1";
			$res_resql = mysqli_query($conn,$resql);
			$row_resql = mysqli_fetch_array($res_resql);
			$enter_id = $row_resql['gb_id'];
			$type = 3;
			$qu = "insert into tbl_login(username,password,type,enter_id) values('$username','$password','$type','$enter_id')";
			$result_qu=mysqli_query($conn,$qu);
			$last = "update tbl_office set gb_id = '$enter_id' where name = '$mname'";
			$ls = mysqli_query($conn,$last);
			if ($result){
				if($result_qu)
				?>
				<script type="text/javascript">
					alert("\n\t Municipality Registered");
				</script>
				<?php
			} 
		}
	}
	if(!isset($err_user)){
		$err_user="";
	}
	if (!isset($err_pass)) {
		$err_pass="";
	}
	if(!isset($err_repass)){
		$err_repass="";
	}
?>
<section id="admin_municipality_content">
	<div class="admin_row_2">
		<button id ="admin_add_muni"class="admin_btn3">Add new office</button>
		<a class="admin_btn3_right" href="admin_mnc_edit.php"><button class="admin_btn4">Edit</button></a>
	</div>
	<div class="admin_add_mnc">
		<form method="post" action="">
			<div class="admin_add_mnc_form">
				<div class="admin_mnc_span">
				<table>
					<tr>
						<td>Select Office</td>
						<td>
							<?php
								$s="select * from tbl_office where gb_id is NULL";
								$r = mysqli_query($conn,$s);
							?>
							<select class="admin_input_select" name="name" required>
								<?php
								while($ro = mysqli_fetch_array($r)){
									?>
									<option><?php echo $ro['name']?></option>
								<?php }
								?>
								
							</select>
						</td>
					</tr>
					<tr>
						<td>Person in charge</td>
						<td><input class="admin_input" type="text" name="pc" required></td>
					</tr>
					<tr>
						<td>Position in Panchayat / Municipality</td>
						<td><input class="admin_input" type="text" name="position" required></td>
					</tr>
					<tr>
						<td>Building Address</td>
						<td><textarea class="admin_input" rows="2" cols="22" name="loc" required></textarea></td>
					</tr>
				</table>
				</div>
				<div class="admin_mnc_span">
				<table>
					<tr>
						<td>Username</td>
						<td><input class="admin_input" type="text" name="username" required><div class="admin_txt_red"><?php echo $err_user; ?></div></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input class="admin_input" type="Password" name="password" required></td>
					</tr>
					<tr>
						<td>Confirm Password</td>
						<td><input class="admin_input" type="Password" name="re-pass" required><div class="admin_txt_red"><?php echo $err_repass; ?></div></td>
					</tr>
				</table>
					<div class="admin_mnc_btn">
						<button type="submit" name="submit">Submit</button>
						<button type="Reset">Reset</button>
						<button id="admin_back_btn1" type="button">Back</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="admin_mnc_head brd">
		List of Garbage Management Stations
	</div>
	<div class="admin_mnc_details">
		<table>
			<tr>
				<th>No</th>
				<th class="wd">Name</th>
				<th class="wd">Location</th>
				<th>Number of bins </th>
			</tr>
			<?php
				$sql3="select * from tbl_gb ";
				$result2 = mysqli_query($conn,$sql3);
				if(mysqli_num_rows($result2)>0){
				$i = 1;
				while($row1 = mysqli_fetch_array($result2)){
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><a href="admin_mnc_edit.php?id=<?php echo $row1['gb_id'];?>"><?php echo $row1['gb_name'];?></a></td>
				<td><?php echo $row1['address']; ?></td>
				<td><div class="cnr"></div></td>
			</tr>
			<?php
			$i++;
			}
		}
		?>
		</table>
		<?php
		if(mysqli_num_rows($result2)==0){
			?>
			<div class="admin_no_data_align">No data</div>
			<?php
		}
		?>
	</div>
</section>
<?php
	include 'admin_footer.php';
?>