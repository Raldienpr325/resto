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
        if (isset($_FILES['file']['name'])) {
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
                    $sql = "update menus set rs_id='".$_POST['res_name']."',title='".$_POST['d_name']."',slogan='".$_POST['about']."',price='".$_POST['price']."',img='".$fnew."' where d_id='".$_GET['menu_upd']."'";  // update the submited data ino the database :images
                    mysqli_query($db, $sql);
                    move_uploaded_file($temp, $store);

                    $success =     '<div class="alert alert-success alert-dismissible fade show">
                                               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                               <strong>Record</strong>Updated.
                                               </div>';
                }
            }
        } else {
            $sql = "update menus set rs_id='".$_POST['res_name']."', title='".$_POST['d_name']."', slogan='".$_POST['about']."',price='".$_POST['price']."' where d_id='".$_GET['menu_upd']."'";  // update the submited data ino the database :images
            mysqli_query($db, $sql);
            $success =     '<div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Record</strong>Updated.
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
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Edit Masakan</li>
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
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Edit Masakan Untuk Menu</h4>
                        </div>
                        <div class="card-body">
                            <form action='' method='post' enctype="multipart/form-data">
                                <div class="form-body">
                                    <?php $qml = "select * from menus where d_id='$_GET[menu_upd]'";
                                    $rest = mysqli_query($db, $qml);
                                    $roww = mysqli_fetch_array($rest);
                                    ?>
                                    <hr>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Nama Masakan</label>
                                                <input type="text" name="d_name" value="<?php echo $roww['title']; ?>" class="form-control" placeholder="nama masakan ....">
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Keterangan</label>
                                                <input type="text" name="about" value="<?php echo $roww['slogan']; ?>" class="form-control form-control-danger" placeholder="keterangan ....">
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row p-t-0">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Harga </label>
                                                <input type="text" name="price" value="<?php echo $roww['price']; ?>" class="form-control" placeholder="Rp.">
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <label class="control-label">Gambar</label>
                                            <p>Pilih file lagi untuk update gambar</p>
                                            <div class="form-group has-danger">
                                                <img src="menu_img/dishes/<?= $roww['img'] ?>" alt="">
                                                <input type="file" name="file" id="lastName" class="form-control form-control-danger" placeholder="12n">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->

                                    <!--/span-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Pilih Kategori</label>
                                                <select name="res_name" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                                    <option>--Pilih Menu--</option>
                                                    <?php $ssql = "select * from restaurant";
                                                    $res = mysqli_query($db, $ssql);
                                                    while ($row = mysqli_fetch_array($res)) {
                                                    ?>
                                                        <option value="<?= $row['rs_id'] ?>" <?php if ($roww['rs_id'] == $row['rs_id']) {
                                                                                                    echo "selected";
                                                                                                }; ?>><?= $row['title'] ?></option>
                                                    <?php
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
    <!-- End Container fluid  -->
    <!-- footer -->

    <!-- End footer -->
    </div>
    <!-- End Page wrapper  -->
    </div>
<?php include('includes/footer.php') ?>