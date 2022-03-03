<?php 
	include '../db/connection.php';
	include 'admin_header.php';
  	if(isset($_POST['submit'])){
    	$name = $_POST['name'];
    	$age = $_POST['age'];
    	$gender = $_POST['gender'];
    	$address = $_POST['address'];
    	$aadhaar = $_POST['aadhar'];
    	//$truck_no = $_POST['office'];
   		$phno = $_POST['phno'];
    	$exp = $_POST['pin'];
    	$email = $_POST['email'];
    	$pass = $_POST['pass'];
    	$re_pass = $_POST['repass'];
    	$status = 1;
      $sql_user = "Select username from tbl_login where username = '$email'";
      $res_user = mysqli_query($conn,$sql_user);
      if(mysqli_fetch_array($res_user)>0){
          $err_user = " Email already exists ";
          $status = 0;
      }
    	if(strlen($phno)!=10){
      		$err_phno=" * Invalid Phone Number";
      		$status=0;
    	}
    	if(strlen($pass)<8){
      		$err_pass=" * Password Too Short";
      		$status = 0;
    	}
    	elseif($pass != $re_pass){
      		$err_pass = " * Password not match";
      		$status = 0;
    	}
    	if ($status==1){
    		//echo $name.$age.$gender.$address.$aadhaar.$exp.$phno.$email.$pass;
     		 $sql = "insert into tbl_driver(name,age,gender,address,aadhaar,exp,phno,username,password) values('$name','$age','$gender','$address','$aadhaar','$exp','$phno','$email','$pass')";
     		 $res = mysqli_query($conn,$sql);
      		$sql3 = "SELECT id from tbl_driver ORDER BY id DESC LIMIT 1";
      		$res12 = mysqli_query($conn,$sql3);
      		$row = mysqli_fetch_array($res12);
     		$user_id = $row['id'];
      		$type = 2;
      		$sql4 = "insert into tbl_login(username,password,type,enter_id) values('$email','$pass','$type',$user_id)";
      		$result1 = mysqli_query($conn,$sql4);
      		if($res){
        		?>
        		<script type="text/javascript">
          		alert("Successfully Registered");
          		//window.location.href="admin_driver.php";
       			 </script>
        		<?php
      		}
    	}
  	}
  	else{
   		$name=$age=$gender=$aadhaar=$address=$exp=$off=$phno=$email=$pass=$repass="";
  	}	
  	if(!isset($err_pin)){
    	$err_pin = "";
 	}
  		if(!isset($err_phno)){
   		$err_phno = "";
  	}
  		if(!isset($err_pass)){
   		$err_pass = "";
  }
  if(!isset($err_user)){
      $err_user = "";
  }
?>

<section class="driver_reg_form">
  <form method="post" action="">
    <div class="box">
      <div class="reg_txt_head">Add Driver Details</div>
      <div class="col">
        <div class="span1">
          <table>
            <tr>
              <td class="span1_tr_align">Name</td>
              <td><input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required></td>
            </tr>
            <tr>
              <td class="span1_tr_align">Gender</td>
              <td class="span1_tr_align_right"><input type="radio" name="gender" value="Male" required>Male<input type="radio" name="gender" value="Female" required>Female</td>
            </tr>
            <tr>
              <td class="span1_tr_align">Address</td>
              <td><textarea rows="3" cols="22" name="address" required><?php echo htmlspecialchars($address); ?></textarea></td>
            </tr>
            <tr>
              <td class="span1_tr_align">Email</td>
              <td><input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><div class="admin_txt_red"><?php echo $err_user; ?></div></td>
            </tr>
          </table>
        </div>
        <div class="span1">
          <table>
            <tr>
              <td class="span1_tr_align">Age</td>
              <td><input type="text" name="age" value="<?php echo htmlspecialchars($age); ?>" required></td>
            </tr>
            <tr>
              <td class="span1_tr_align">Aadhaar Number</td>
              <td><input type="text" name="aadhar" value="<?php echo htmlspecialchars($aadhaar); ?>" required></td>
            </tr>
            <tr>
              <td class="span1_tr_align">Phone Number</td>
              <td><input type="text" name="phno" value="<?php echo htmlspecialchars($phno); ?>" required><div class="admin_txt_red"><?php echo $err_phno; ?></div></td>
            </tr>
            <tr>
              <td class="span1_tr_align">Experience</td>
              <td><input type="text" name="pin" value="<?php echo htmlspecialchars($exp); ?>" required><div class="admin_txt_red"><?php echo $err_pin; ?></div></td>
            </tr>
            <tr>
              <td class="span1_tr_align">Password</td>
              <td><input type="Password" name="pass" value="<?php echo htmlspecialchars($pass); ?>" required></td>
            </tr>
             <tr>
              <td class="span1_tr_align">Confirm Password</td>
              <td><input type="Password" name="repass" required><div class="admin_txt_red"><?php echo $err_pass; ?></div></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="register_btn"><button type="submit" class="reg_btn" name="submit">Register</button></div>
    </div>
  </form>
</section>

<?php include 'admin_footer.php'; ?>