<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

if (isset($_POST['submit']))           //if upload btn is pressed
{
  if (empty($_POST['c_name']) || empty($_POST['res_name'])) {
    $error =  '<div class="alert alert-danger alert-dismissible fade show">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>All fields Must be Fillup!</strong>
      </div>';
  } else {
    if (!empty($_FILES['file']['name'])) {
      $fname = $_FILES['file']['name'];
      $temp = $_FILES['file']['tmp_name'];
      $fsize = $_FILES['file']['size'];
      $extension = explode('.', $fname);
      $extension = strtolower(end($extension));
      $fnew = uniqid() . '.' . $extension;
      $store = "Res_img/" . basename($fnew);                      // the path to store the upload image
      if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {
        if ($fsize >= 1000000) {
          $error =  '<div class="alert alert-danger alert-dismissible fade show">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Max Image Size is 1024kb!</strong> Try different Image.
                      </div>';
        } else {
          $res_name = $_POST['res_name'];
          $sql = "update restaurant set c_id='".$_POST['c_name']."', title='".$res_name."' ,image='".$fnew."' where rs_id='".$_GET['res_upd']."' ";  // store the submited data ino the database :images                       mysqli_query($db, $sql); 
          mysqli_query($db, $sql);
          move_uploaded_file($temp, $store);
          $success =  '<div class="alert alert-success alert-dismissible fade show">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Record Updated!</strong>.
                          </div>';
        }
      } elseif ($extension == '') {
        $error =  '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>select image</strong>
                        </div>';
      } else {
        $error =  '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>invalid extension!</strong>png, jpg, Gif are accepted.
                        </div>';
      }
    } else {
      $res_name = $_POST['res_name'];
      $sql = "update restaurant set c_id='".$_POST['c_name']."', title='".$res_name."' where rs_id='".$_GET['res_upd']."' ";  // store the submited data ino the database :images                       mysqli_query($db, $sql); 
      mysqli_query($db, $sql);
      $success =  '<div class="alert alert-success alert-dismissible fade show">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Record Updated!</strong>.
                          </div>';
    }
  }
}

?>

<?php include('includes/header.php') ?>
  <div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
  </div>
  <!-- Main wrapper  -->
  <div id="main-wrapper">
    <?php include('includes/navbar.php') ?>
    <?php include('includes/sidebar.php') ?>
  <div class="page-wrapper" style="height:1200px;">
    <!-- Bread crumb -->
    <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Menu</h3>
      </div>
      <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
      <!-- Start Page Content -->


      <?php echo $error;
      echo $success; ?>




      <div class="col-lg-12">
        <div class="card card-outline-primary">

          <h4 class="m-b-0 ">Edit Menu</h4>

          <div class="card-body">
            <form action='' method='post' enctype="multipart/form-data">
              <div class="form-body">
                <?php $ssql = "select * from restaurant where rs_id='$_GET[res_upd]'";
                $res = mysqli_query($db, $ssql);
                $row = mysqli_fetch_array($res); ?>
                <hr>
                <div class="row p-t-20">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Nama Menu</label>
                      <input type="text" name="res_name" value="<?php echo $row['title'];  ?>" class="form-control" placeholder="John doe">
                    </div>
                  </div>


                  <div class="col-md-6">
                    <label class="control-label">Gambar</label>
                    <p>Pilih file lagi untuk update gambar</p>
                    <div class="form-group has-danger">
                      <img src="Res_img/<?= $row['image'] ?>" alt="">
                      <input type="file" name="file" id="lastName" class="form-control form-control-danger" placeholder="12n">
                    </div>
                  </div>
                  <!--/span-->

                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Pilih Kategori</label>
                      <select name="c_name" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                        <option>--Select Category--</option>
                        <?php $ssql = "select * from res_category";
                        $res = mysqli_query($db, $ssql);
                        while ($rows = mysqli_fetch_array($res)) {
                        ?>
                          <option value="<?= $rows['c_id'] ?>" <?php if ($row['c_id'] == $rows['c_id']) {
                                                                  echo "selected";
                                                                }; ?>><?= $rows['c_name'] ?></option>
                        <?php
                        }

                        ?>
                      </select>
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

  <!-- End footer -->
  </div>
  <!-- End Page wrapper  -->
  </div>
<?php include('includes/footer.php') ?>