<?php
	include '../db/connection.php';
	include 'driver_header.php';
	if(!isset($_SESSION['driver_id'])){
		header("location:../driver_login.php");
	}
	else{
		$dr_id = $_SESSION['driver_id'];
		$sql_gb = "select * from tbl_gb";
		$res_gb = mysqli_query($conn,$sql_gb);
?>
<section id="office_content">
	<div class="container">
		<div class="row">
			<div class="btn-group" role="group" aria-label="Basic example">
  				<button type="button" onclick="comp_1()" class="btn btn-primary btn_comp_view" >Add Complaint</button>
  				<button type="button" onclick="comp_2()" class="btn btn-primary btn_comp_view">View All Registered Complaints</button>
			</div>
			<div class="col-md-12 driver_bg_12 shadow p-3 mb-5 rounded" id="comp_hide">
				<form method="post" action="complaint_submit.php">
					<div class="row">
						<div class="col-md-5 comp_margin">
							Select Office : 
							<select class="comp_inp" name="gb_name">
								<?php 
									while ($row_gb=mysqli_fetch_array($res_gb)) {
										?>
										<option value="<?php echo $row_gb['gb_id']?>"><?php echo $row_gb['gb_name'] ?></option>
										<?php
									}
								?>
							</select>
						</div>
						<div class="col-md-5 comp_margin1">
							Select Topic : 
							<select class="comp_inp" name="issue">
								<option>Bin Issue</option>
								<option>Webiste Issue</option>
								<option>Truck Issue</option>
								<option>Other Issue</option>
							</select>
						</div>
						<div class="col-md-10 comp_margin">
							Description : <textarea rows="4" class="comp_input" name="descrip"></textarea>
						</div>
						<center>
						<button type="submit" class="reg_btn">Submit</button>
					</center>
					</div>
				</form>
			</div>
			<div class="col-md-12 driver_bg_12 shadow p-3 mb-5 rounded" id="view_hide">
				<?php
					$sql1="Select * from tbl_comp where type=2 and enter_id='$dr_id' order by id desc";
					$res = mysqli_query($conn,$sql1);
					$i=1;
				?>
				<div class="table_overflow">
					<table class="table table-hover">
						<thead class="table-dark">
						<tr>
							<th>#</th>
							<th>Office</th>
							<th>Complient</th>
							<th>Description</th>
							<th>Status</th>
						</tr>
					</thead>
						<?php 
							while($row=mysqli_fetch_array($res)){
								?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php 
											$id = $row['gb_id'];
											$sql_g = "select * from tbl_gb where gb_id = '$id'";
											$res_g = mysqli_query($conn,$sql_g);
											$row_g = mysqli_fetch_array($res_g);
											echo $row_g['gb_name'];
										?>
									</td>
									<td><?php echo $row['topic']?></td>
									<td><?php echo $row['descrip']?></td>
									<td><?php 
											if($row['status']==0){
												echo "Complaint Submitted \n Waiting for Reply";
											}
											else{
												?>
												<a href="feedback.php?id=<?php echo $row['id']?>"><button class="admin_edit_btn2" type="button">View details</button></a>
												<?php 
											}
										?>		
									</td>
								</tr>
								<?php
								$i++;
							}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
	}
	include 'driver_footer.php';
?>