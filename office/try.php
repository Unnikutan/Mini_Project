<?php 
	include '../db/connection.php';
	$sql = "Select * from tbl_route";
	$res = mysqli_query($conn,$sql);
	$date = date("w");
	if ($date == 1 || 3 || 5){
		$value = 1;
	}
	while($row=mysqli_fetch_array($res)){
		if ($row['itr']==$value){
			echo "Successfull";
		}
	}
	
	echo $date;
?>