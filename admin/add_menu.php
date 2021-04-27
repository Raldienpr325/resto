<?php
include("../connection/connect.php");
error_reporting(0);
session_start();




if (isset($_POST['submit']))           //if upload btn is pressed
{







    if (empty($_POST['d_name']) || empty($_POST['about']) || $_POST['price'] == '' || $_POST['res_name'] == '') {
        $error =     '<div class="alert alert-danger alert-dismissible fade show">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <strong>All fields Must be Fillup!</strong>
     </div>';
    } else {

        $fname = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        $fsize = $_FILES['file']['size'];
        $extension = explode('.', $fname);
        $extension = strtolower(end($extension));
        $fnew = uniqid() . '.' . $extension;
        $store = "menu_img/dishes/" . basename($fnew);                      // the path to store the upload image
        if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {
            if ($fsize >= 1000000) {
                $error =     '<div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Max Image Size is 1024kb!</strong> Try different Image.
                                    </div>';
            } else {
                $sql = "INSERT INTO menus(rs_id,title,slogan,price,img) VALUE('" . $_POST['res_name'] . "','" . $_POST['d_name'] . "','" . $_POST['about'] . "','" . $_POST['price'] . "','" . $fnew . "')";  // store the submited data ino the database :images
                mysqli_query($db, $sql);
                move_uploaded_file($temp, $store);
                $success =     '<div class="alert alert-success alert-dismissible fade show">
                                               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                               <strong>Congrass!</strong> New Menu Added Successfully.
                                               </div>';
            }
        } elseif ($extension == '') {
            $error =     '<div class="alert alert-danger alert-dismissible fade show">
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          <strong>select image</strong>
                                          </div>';
        } else {
            $error =     '<div class="alert alert-danger alert-dismissible fade show">
                                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                         <strong>invalid extension!</strong>png, jpg, Gif are accepted.
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
                    <h3 class="text-primary">Masakan</h3>
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
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Tambah Masakan Untuk Menu</h4>
                        </div>
                        <div class="card-body">
                            <form action='' method='post' enctype="multipart/form-data">
                                <div class="form-body">

                                    <hr>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Nama Masakan</label>
                                                <input type="text" name="d_name" class="form-control" placeholder="nama masakan ....">
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Keterangan</label>
                                                <input type="text" name="about" class="form-control form-control-danger" placeholder="keterangan ....">
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row p-t-0">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Harga </label>
                                                <input type="text" name="price" class="form-control" placeholder="Rp. ">
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Gambar</label>
                                                <input type="file" name="file" id="lastName" class="form-control form-control-danger" placeholder="12n">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->

                                    <!--/span-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Pilih Restaurant</label>
                                                <select name="res_name" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                                    <option>--Pilih Restaurant--</option>
                                                    <?php $ssql = "select * from restaurant";
                                                    $res = mysqli_query($db, $ssql);
                                                    while ($row = mysqli_fetch_array($res)) {
                                                        echo ' <option value="' . $row['rs_id'] . '">Restaurant ' . $row['title'] . '</option>';;
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>



                                    </div>

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
    
<?php include('includes/footer.php') ?>