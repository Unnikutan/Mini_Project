<?php
	include '../db/connection.php';
	include 'user_header.php';
	if(!isset($_SESSION['user_id'])){
		header("location:../user_login.php");
	}
	else{
		$user_id = $_SESSION['user_id'];
		$sql = "Select * from tbl_user where u_id = '$user_id' ";
		$res = mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($res);
		$gb_id = $row['gb_id'];
		$sql_route = "select * from tbl_route where gb_id = '$gb_id'";
		$res_route = mysqli_query($conn,$sql_route);
		$count_route = mysqli_num_rows($res_route);
		$sql_bins = "select * from tbl_bins where gb_id = '$gb_id'";
		$res_bins = mysqli_query($conn,$sql_bins);
		$count_bins = mysqli_num_rows($res_bins);
		$sql_tr = "select * from tbl_truck where gb_id = '$gb_id'";
		$res_tr = mysqli_query($conn,$sql_tr);
		$count_tr = mysqli_num_rows($res_tr);
?>
<section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Welcome <?php 
  							echo $row['name'];
  						?></h2>
        </div>

  </div>
</section>
<section class="about" data-aos="fade-up">
      <div class="container">

        <div class="row">
          <div class="col-lg-6">
            <img src="../assets/img/handshake.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <h3>Thanks you for being the part of the Garbage Management System</h3>
            <p class="fst-italic">
              Garabage Management System aims at a great change in the way the garbage are collected and treated. This is the first step inorder to achieve that.
            </p>
            <ul>
              <li><i class="bi bi-check2-circle"></i> The user interface now provided just only gives the user to view the bins in their local offices.</li>
              <li><i class="bi bi-check2-circle"></i> The users can intertact with government by givin complaints and getting feedback from them.</li>
              <li><i class="bi bi-check2-circle"></i>Colloboration of both offices and users are needed to develop a new change in the way of treating garbage in our locality.</li>
            </ul>
          </div>
        </div>

      </div>
    </section>
     <section class="pricing section-bg" data-aos="fade-up">
      <div class="container">

        <div class="section-title">
          <h2>Office Features</h2>
          <p>All the office functional features are currently not available to usser. Soon will be upgraded to a new version where the whole system functions are also be decided by users too..</p>
        </div>

        <div class="row no-gutters">

          <div class="col-lg-4 box">
            <h3>Routes</h3>
            <h4><?php echo $count_route ?></h4>
            <ul>
              <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
              <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
              <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
              <li class="na"><i class="bx bx-x"></i> <span>Pharetra massa massa ultricies</span></li>
              <li class="na"><i class="bx bx-x"></i> <span>Massa ultricies mi quis hendrerit</span></li>
            </ul>
            <a href="#" class="get-started-btn">Get Started</a>
          </div>

          <div class="col-lg-4 box featured">
            <h3>Bins</h3>
            <h4><?php echo $count_bins ?></h4>
            <ul>
              <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
              <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
              <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
              <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
              <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
            </ul>
            <a href="#" class="get-started-btn">View More</a>
          </div>

          <div class="col-lg-4 box">
            <h3>Trucks</h3>
            <h4><?php echo $count_tr ?></h4>
            <ul>
              <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
              <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
              <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
              <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
              <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
            </ul>
            <a href="#" class="get-started-btn">Get Started</a>
          </div>

        </div>

      </div>
    </section>
<?php
	}
	include 'user_footer.php';
?>