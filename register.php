<?php
  include 'db/connection.php';
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $aadhaar = $_POST['aadhar'];
    $off = $_POST['office'];
    $phno = $_POST['phno'];
    $pin = $_POST['pin'];
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
    if(strlen($pin)!=6){
      $err_pin = " * Invalid pin ";
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
      $sql = "insert into tbl_user(name,age,gender,address,aadhaar,pin,phno,gb_id,email,password) value('$name','$age','$gender','$address','$aadhaar','$pin','$phno','$off','$email','$pass')";
      $res = mysqli_query($conn,$sql);
      $sql3 = "SELECT u_id from tbl_user ORDER BY u_id DESC LIMIT 1";
      $res12 = mysqli_query($conn,$sql3);
      $row = mysqli_fetch_array($res12);
      $user_id = $row['u_id'];
      $type = 1;
      $sql4 = "insert into tbl_login(username,password,type,enter_id) values('$email','$pass','$type',$user_id)";
      $result1 = mysqli_query($conn,$sql4);
      if($res){
        ?>
        <script type="text/javascript">
          alert("Successfully Registered");
          window.location.href="user_login.php";
        </script>
        <?php
      }
    }
  }
  else{
    $name=$age=$gender=$aadhaar=$address=$pin=$off=$phno=$email=$pass=$repass="";
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
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Garbage Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/css/layout.css">
  
  <!-- =======================================================
  * Template Name: Moderna - v4.8.0
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

<section class="reg_form">
  <form method="post" action="">
    <div class="box">
      <div class="reg_txt_head">Registration Form</div>
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
              <td class="span1_tr_align">Place</td>
              <td>
                <select class="reg_select" name="office"> 
                 <?php 
                    $sql2 = "SELECT gb_id,gb_name from tbl_gb";
                    $result2 = mysqli_query($conn,$sql2); 
                  while ($row2 = mysqli_fetch_array($result2)) {
                  ?>
                  <option value="<?php echo $row2['gb_id'];?>"><?php echo $row2['gb_name']; ?></option>
                  <?php
                }
              ?> 
                </select>
              </td>
            </tr>
            <tr>
              <td class="span1_tr_align">Email</td>
              <td><input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><div class="admin_txt_red"><?php echo $err_user; ?></td>
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
              <td class="span1_tr_align">pin</td>
              <td><input type="text" name="pin" value="<?php echo htmlspecialchars($pin); ?>" required><div class="admin_txt_red"><?php echo $err_pin; ?></div></td>
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