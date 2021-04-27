<?php


session_start();
error_reporting(0);
include("../connection/connect.php");

if(isset($_POST['submit'] ))
{
    if(empty($_POST['uname']) ||
        empty($_POST['fname'])|| 
        empty($_POST['lname']) ||  
        empty($_POST['email'])||
        empty($_POST['password'])||
        empty($_POST['phone']) ||
        empty($_POST['address']))
    {
     $error = '<div class="alert alert-danger alert-dismissible fade show">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <strong>All fields Required!</strong>
     </div>';
 }
 else
 {

   $check_username= mysqli_query($db, "SELECT username FROM users where username = '".$_POST['uname']."' ");
   $check_email = mysqli_query($db, "SELECT email FROM users where email = '".$_POST['email']."' ");




    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
    {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>invalid email!</strong>
        </div>';
    }
    elseif(strlen($_POST['password']) < 6)
    {
      $error = '<div class="alert alert-danger alert-dismissible fade show">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Password must be >=6!</strong>
      </div>';
  }

  elseif(strlen($_POST['phone']) < 10)
  {
      $error = '<div class="alert alert-danger alert-dismissible fade show">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>invalid phone!</strong>
      </div>';
  }
  elseif(mysqli_num_rows($check_username) > 0)
  {
   $error = '<div class="alert alert-danger alert-dismissible fade show">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>Username already exist!</strong>
   </div>';
}
elseif(mysqli_num_rows($check_email) > 0)
{
   $error = '<div class="alert alert-danger alert-dismissible fade show">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <strong>email already exist!</strong>
   </div>';
}
else{

	
	$mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address) VALUES('".$_POST['uname']."','".$_POST['fname']."','".$_POST['lname']."','".$_POST['email']."','".$_POST['phone']."','".md5($_POST['password'])."','".$_POST['address']."')";
	mysqli_query($db, $mql);
 $success = 	'<div class="alert alert-success alert-dismissible fade show">
 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 <strong>Congrass!</strong> New User Added Successfully.</br></div>';

}
}

}

?>
<?php include('includes/header.php') ?>
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
         <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
     </div>
     <div id="main-wrapper">
     <?php include('includes/navbar.php') ?>
     <?php include('includes/sidebar.php') ?>
    <div class="page-wrapper" style="height:1200px;">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Pelanggan</h3> </div>

            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">



                  <div class="container-fluid">
                    <!-- Start Page Content -->


                    <?php  echo var_dump($_POST);
                    echo $error;
                    echo $success; ?>




                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Tambahkan Pelanggan</h4>
                            </div>
                            <div class="card-body">
                                <form action='' method='post'  enctype="multipart/form-data">
                                    <div class="form-body">

                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nama Pengguna</label>
                                                    <input type="text" name="uname" class="form-control" placeholder="nama pengguna ....">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Nama Depan</label>
                                                    <input type="text" name="fname" class="form-control form-control-danger" placeholder="nama depan ....">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row p-t-0">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nama Belakang </label>
                                                    <input type="text" name="lname" class="form-control" placeholder="nama belakang ....">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Alamat Email</label>
                                                    <input type="text" name="email" class="form-control form-control-danger" placeholder="email@gmail.com">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Password</label>
                                                    <input type="text" name="password" class="form-control form-control-danger" placeholder="password ....">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">No Hp</label>
                                                    <input type="text" name="phone" class="form-control form-control-danger" placeholder="+62 ....">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <h3 class="box-title m-t-0"> Alamat</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">

                                                    <textarea name="address" type="text" style="height:100px;" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>


                                        <!--/span-->
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" name="submit" class="btn btn-success" value="Simpan"> 
                                    <a href="dashboard.php" class="btn btn-inverse">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End PAge Content -->
        </div>
        <!-- End Container fluid  -->
        <!-- footer -->
        <footer class="footer"> © 2021 All rights reserved. </footer>
        <!-- End footer -->
    </div>
    <!-- End Page wrapper  -->
</div>
<?php include('includes/footer.php') ?>