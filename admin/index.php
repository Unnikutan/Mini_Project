<?php 
	include '../db/connection.php';
	include 'admin_header.php';
	$sql = "Select * from tbl_gb";
	$res = mysqli_query($conn,$sql);
	$sql1 = "Select * from tbl_user";
	$res1 = mysqli_query($conn,$sql1);
	$sql2 = "Select * from tbl_driver";
	$res2 = mysqli_query($conn,$sql2);
	$sql3 = "Select * from tbl_truck";
	$res3 = mysqli_query($conn,$sql3);
	?>

<section id="admin_content">
	<div id="row_border_1" class="admin_welcome"><button id = "btn_row1" class="admin_btn2" onclick="admin_display(1)"><i id="icon_1" class="bi bi-caret-down-fill admin_icon"></i>Garbage Management Offices</button></div>
	<div class="admin_row_1" id="admin_row1">
		<div class="admin_span1">
			<div class="admin_txt1">
				Total Count
			</div>
			<div class="admin_txt2">
				<?php 
					$count = mysqli_num_rows($res);
					echo $count;
				?>
			</div>
		</div>
		<div class="admin_span2">
			<div class="admin_table">
				<table>
					<tr class="tr1">
						<th>#</th>
						<th>Office Name</th>
						<th>No:of bins</th>
					</tr>
					<?php 
						$i = 1;
						while($row=mysqli_fetch_array($res)){
							$id = $row['gb_id'];
							$sql_re = "select * from tbl_bins where gb_id='$id'";
							$res_re = mysqli_query($conn,$sql_re);
							$count_re = mysqli_num_rows($res_re);
							?>
					<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $row['gb_name'] ?></td>
						<td style="padding-left: 8%;"><?php echo $count_re ?></td>
					</tr>
							<?php
							$i++;
						}
					?>
				</table>
			</div>
			<div class="admin_btn_align">
				<a href="admin_municipality.php"><button class="admin_btn1">View More</button></a>
				<a href="admin_municipality.php"><button class="admin_btn1">Add Municipality</button></a>
			</div>
		</div>
	</div>
	<div id="row_border_2" class="admin_welcome brd"><button class="admin_btn2" onclick="admin_display(2)"><i id="icon_2" class="bi bi-caret-right-fill admin_icon"></i>User</button></div>
	<div class="admin_row_1" id="admin_row2" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
		<div class="admin_span1">
			<div class="admin_txt1">
				Total Count
			</div>
			<div class="admin_txt2">
				<?php 
					$count = mysqli_num_rows($res1);
					echo $count;
				?>
			</div>
		</div>
		<div class="admin_span2">
			<div class="admin_table">
				<table>
					<tr class="tr1">
						<th>#</th>
						<th>Name</th>
						<th>Office</th>
					</tr>
					<?php 
						$i = 1;
						while($row1=mysqli_fetch_array($res1)){
							$id = $row1['gb_id'];
							$sql_re = "select * from tbl_gb where gb_id='$id'";
							$res_re = mysqli_query($conn,$sql_re);
							$count_re = mysqli_fetch_array($res_re);
							?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $row1['name'] ?></td>
								<td><?php echo $count_re['gb_name']; ?></td>
							</tr>
						<?php
						$i++;
						}
						?>
				</table>
			</div>
			<div class="admin_btn_align">
				<a href="admin_user.php"><button class="admin_btn1">View More</button></a>
			</div>
		</div>
	</div>
	<div id="row_border_3" class="admin_welcome brd"><button class="admin_btn2" onclick="admin_display(3)"><i id="icon_3" class="bi bi-caret-right-fill admin_icon"></i>Driver</button></div>
	<div class="admin_row_1" id="admin_row3">
		<div class="admin_span1">
			<div class="admin_txt1">
				Total Count
			</div>
			<div class="admin_txt2">
				<?php 
					$count = mysqli_num_rows($res2);
					echo $count;
				?>
			</div>
		</div>
		<div class="admin_span2">
			<div class="admin_table">
				<table>
					<tr class="tr1">
						<th>#</th>
						<th>Driver Name</th>
						<th>Experience</th>
					</tr>
					<?php 
						$i = 1;
						while($row2=mysqli_fetch_array($res2)){
							?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $row2['name'] ?></td>
								<td style="padding-left: 8%;"><?php echo $row2['exp'] ?></td>				
							</tr>
						<?php
						$i++;
						}
						?>
					
				</table>
			</div>
			<div class="admin_btn_align">
				<a href="admin_driver.php"><button class="admin_btn1">View More</button></a>
				<a href="admin_driver.php"><button class="admin_btn1">Add Driver</button></a>
			</div>
		</div>
	</div>
	<div id="row_border_4" class="admin_welcome brd"><button class="admin_btn2" onclick="admin_display(4)"><i id="icon_4" class="bi bi-caret-right-fill admin_icon"></i>Truck</button></div>
	<div class="admin_row_1" id="admin_row4">
		<div class="admin_span1">
			<div class="admin_txt1">
				Total Count
			</div>
			<div class="admin_txt2">
				<?php 
					$count = mysqli_num_rows($res3);
					echo $count;
				?>
			</div>
		</div>
		<div class="admin_span2">
			<div class="admin_table">
				<table>
					<tr class="tr1">
						<th>No</th>
						<th>Office Name</th>
						<th>No:of trucks</th>
					</tr>
					<?php 
						$i=1;
						$sql = "Select * from tbl_gb";
						$res = mysqli_query($conn,$sql);
						while($row=mysqli_fetch_array($res)){
							$id = $row['gb_id'];
							$sql_re = "SELECT count(truck_no) as tr,gb_id FROM tbl_truck GROUP BY gb_id HAVING gb_id='$id'";
							$res_re = mysqli_query($conn,$sql_re);
							$row_re = mysqli_fetch_array($res_re);
							if($row_re){
								$tr = $row_re['tr'];
							}
							else{
								$tr = 0;
							}
							?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $row['gb_name'] ?></td>
								<td><?php echo $tr ?></td>
							</tr>
							<?php
							$i++;
						}
					?>
				</table>
			</div>
			<div class="admin_btn_align">
				<a href="admin_truck.php"><button class="admin_btn1">View More</button></a>
				<a href="admin_truck.php"><button class="admin_btn1">Add Truck</button></a>
			</div>
		</div>
	</div>
</section>


	<?php
	include 'admin_footer.php';
	?>
