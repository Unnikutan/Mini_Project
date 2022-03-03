<?php
	include '../db/connection.php';
	include 'admin_header.php';
?>
<section id="admin_user_content">
	<div class="admin_user_block">
		<div class="admin_user_head">
			<div class="admin_driver_head_span2">
				<a href="admin_add_driver.php"><button class="admin_driver_btn">+ Add New Driver</button></a>
			</div>
			<div class="admin_driver_head_span1" id>
				Drivers
			</div>
			<div class="admin_user_head_span2">
				<input type="text" name="search" id="search" onkeyup="myfuntion()" class="admin_user_search_input" placeholder="Search"><button type="button" class="admin_user_btn_search"><i class="bi-search admin_user_btn_icon"></i></button>
			</div>
		</div>
		<div class="admin_user_display" id="admin_user_display">
			<?php
				$sql = "select * from tbl_driver";
				$res = mysqli_query($conn,$sql);
				while($row=mysqli_fetch_array($res)){
			?>
			<a href="admin_driver_edit.php?id=<?php echo $row['id']; ?>"><div class="admin_user_each" id="admin_user_each"> 
				<div class="admin_user_each_img"></div>
					<div class="admin_user_each_details">
						<div class="admin_user_txt" name="admin_user_name"><b><?php echo $row['name']; ?></b></div>
						<div class="admin_user_txt2">Age : <?php echo $row['age'];?></div>
						<div class="admin_user_txt2"> Experience : <?php echo $row['exp'];?></div>
					</div>
				</div>
			</a>
			<?php
			}
			?>
		</div>
	</div>
</section>
<?php include 'admin_footer.php'; ?>