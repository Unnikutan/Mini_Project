<?php
	include '../db/connection.php';
	$dr_id = $_SESSION['driver_id'];
	$type = 2;
	$gb_name = $_POST['gb_name'];
	$descrip = $_POST['descrip'];
	$issue = $_POST['issue'];
	$status = 0;
	$sql = "INSERT INTO tbl_comp(type,enter_id,gb_id,topic,descrip,status) VALUES('$type','$dr_id','$gb_name','$issue','$descrip','$status')";
	$res = mysqli_query($conn,$sql);
	if ($res){
		?>
		<script type="text/javascript">
			alert("Compliant Successfully Submitted");
			window.location.href="complaints.php";
		</script>
		<?php
	}
?>