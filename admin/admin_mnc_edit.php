<?php
	include '../db/connection.php';
	include 'admin_header.php';
	if(isset($_POST['admin_gb_save'])){
		$id = $_SESSION['id'];
		$mpc = $_POST["pc"];
		//$pos = $_POST["position"];
		$mlocation = $_POST["loc"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$sql2 = " update tbl_gb set person='$mpc',address='$mlocation',username='$username',password='$password'";
		$result = mysqli_query($conn,$sql2);
		if ($result){
			?>
			<script type="text/javascript">
				alert("Successfully updated");
			</script>
			<?php
		}
	}
	if ($_SERVER['REQUEST_METHOD']==='GET'){
		if(isset($_GET['id'])){
		$gb_id = $_GET['id'];
		}
	}
	else{
		if(isset($_POST['off_submit'])){
			$gb_id = $_POST['select_office'];

		}
	}
	?>
<section id="admin_municipality_content">
	<div class="admin_edit_sel">
		<form method="post" action="">
		<table>
			<tr>
				<td><div div class="admin_edit_txt">Select Office </div></td>
				<td>
					<select class="admin_input_select" name="select_office">
						<?php
							$sql = "select gb_id,gb_name from tbl_gb";
							$res = mysqli_query($conn,$sql);
							while($row=mysqli_fetch_array($res)){
						?>
						<option value="<?php echo $row['gb_id']; ?>"><?php echo $row['gb_name']; ?></option>
						<?php
							}
						?>
					</select>
				</td>
			</tr>
		</table>
		<button type="submit" class="admin_edit_btn" id="admin_edit_submit" name="off_submit">Submit</button>
		</form>
	</div>
<?php
	if(isset($gb_id)){
		$_SESSION['id']=$gb_id;
	 ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".admin_edit_content").show();
			});
		</script>
		<?php
		$sql1 = "select * from tbl_gb where gb_id = '$gb_id'";
		$res1 = mysqli_query($conn,$sql1);
		$row1 = mysqli_fetch_array($res1);
?>
	<div class="admin_edit_content">
		<div class="admin_edit_head"><div class="admin_edit_txt2">Municipality Details</div><a href="admin_off_remove.php?id=<?php echo $row1['gb_id']; ?>"><button class="admin_edit_btn2 admin_icon_span_right" id="admin_edit_remove"> <i class="bi-trash-fill"></i> remove</button></a></div>
		<div class="admin_add_mnc_form">
			<div class="admin_mnc_span">
				<table>
					<tr>
						<td class="admin_edit_tr_td">Office</td>
						<td><?php echo $row1['gb_name']; ?> </td>
					</tr>
					<tr>
						<td class="admin_edit_tr_td">Total number of Bins</td>
						<td>
							<?php 
								$bin = "select * from tbl_bins where gb_id = '$gb_id'";
								$res_bin = mysqli_query($conn,$bin);
								$row_bin = mysqli_num_rows($res_bin);
								echo $row_bin;
							?>
						</td>
					</tr>
					<tr>
						<td class="admin_edit_tr_td">Number of drivers working</td>
						<td><?php 
								$bin = "select count(truck_no) as tr,gb_id from tbl_truck group by driver_id having gb_id = '$gb_id'";
								$res_bin = mysqli_query($conn,$bin);
								$row_bin = mysqli_num_rows($res_bin);
								echo $row_bin;
							?></td>
					</tr>
				</table>
			</div>
			<div class="admin_mnc_span">
				<table>
					<tr>
						<td class="admin_edit_tr_td">Thaluk</td>
						<td>Punalur</td>
					</tr>
					<tr>
						<td class="admin_edit_tr_td">Number of Trucks</td>
						<td><?php 
								$bin = "select * from tbl_truck where gb_id = '$gb_id'";
								$res_bin = mysqli_query($conn,$bin);
								$row_bin = mysqli_num_rows($res_bin);
								echo $row_bin;
							?>		
						</td>
					</tr>
					<tr>
						<td class="admin_edit_tr_td">Total number of complaints</td>
						<td><?php 
								$bin = "select * from tbl_comp where gb_id = '$gb_id'";
								$res_bin = mysqli_query($conn,$bin);
								$row_bin = mysqli_num_rows($res_bin);
								echo $row_bin;
							?>	
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="admin_add_mnc_form">
			<div class="admin_edit_align_right"><button class="admin_edit_btn2" id="admin_edit_editbtn"><i class="bi-pencil-square"></i>&nbsp;edit</button></div>
			<form id="myform" method="post" action="">
			<div class="admin_mnc_span">
				<table>
					<tr>
						<td>Person in charge</td>
						<td><input type="text" name="pc" value="<?php echo $row1['person']; ?>" disabled></td>
					</tr>
					<tr>
						<td>Username</td>
						<td><input type="text" name="username" value="<?php echo $row1['username']; ?>" disabled></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="text" name="password" value="<?php echo $row1['password']; ?>" disabled></td>
					</tr>
				</table>
			</div>
			<div class="admin_mnc_span">
				<table>
					<tr>
						<td>Location</td>
						<td><textarea name="loc" rows="5" cols="40" disabled><?php echo $row1['address']; ?></textarea></td>
					</tr>
				</table>
			</div>
			<div>
				<button type="submit" class="admin_edit_btn" name="admin_gb_save" id="admin_gb_save" disabled>Save Changes</button>
				<button type="reset" class="admin_edit_btn_5">Cancel</button>
			</div>
			</form>
		</div>
	</div>
	<?php
	}
	?>
</section>

<?php include 'admin_footer.php'; ?>