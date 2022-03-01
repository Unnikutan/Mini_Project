<?php
	include 'db/connection.php';
	if (isset($_POST['submit'])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$sql = "select * from tbl_login where username='$username' and password = '$password'";
		$result = mysqli_query($conn,$sql);
		if (mysqli_num_rows($result)==1) {
		$row = mysqli_fetch_array($result);
		if ($row['type']==0){
			header("location:admin/index.php");
			$_SESSION['admin']=1;
		}
		elseif ($row['type']==1) {
			echo "HELLO";
		 	header("location:user/index.php");
		 	$_SESSION['user_id']=$row['enter_id'];
		}
		elseif ($row['type']==2) {
			header("location:driver/index.php");
			$_SESSION['driver_id']=$row['enter_id'];
		}
		else{
			header("location:office/index.php");
			$_SESSION['off_id']=$row['enter_id'];
		}
		}
		else{
			$err="* Invalid Username and Password";
			include 'office_login.php';
		}
	}
	else{
		header("location:office_login.php");
	}
?>