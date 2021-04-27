<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

?>
<?php include('includes/header.php') ?>
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
         <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
     </div>
     <!-- Main wrapper  -->
     <div id="main-wrapper">
        <?php include('includes/navbar.php') ?>
        <?php include('includes/sidebar.php') ?>
<!-- Page wrapper  -->
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Menu Masakan</h3> </div>

        </div>
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">

                 <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Menu Masakan</h4>
                        <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>

                        <div class="table-responsive m-t-40">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Restaurant</th>
                                        <th>Masakan</th>
                                        <th>Keterangan</th>
                                        <th>Harga</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Restaurant</th>
                                        <th>Masakan</th>
                                        <th>Keterangan</th>
                                        <th>Harga</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>


                                    <?php
                                    $sql="SELECT * FROM menus order by d_id desc";
                                    $query=mysqli_query($db,$sql);

                                    if(!mysqli_num_rows($query) > 0 )
                                    {
                                     echo '<td colspan="11"><center>No Menu Data!</center></td>';
                                 }
                                 else
                                 {				
                                   while($rows=mysqli_fetch_array($query))
                                   {
                                    $mql="select * from restaurant where rs_id='".$rows['rs_id']."'";
                                    $newquery=mysqli_query($db,$mql);
                                    $fetch=mysqli_fetch_array($newquery);


                                    echo '<tr><td>'.$fetch['title'].'</td>

                                    <td>'.$rows['title'].'</td>
                                    <td>'.$rows['slogan'].'</td>
                                    <td>Rp.'.$rows['price'].'</td>


                                    <td><div class="col-md-3 col-lg-8 m-b-10">
                                    <center><img src="menu_img/dishes/'.$rows['img'].'" class="img-responsive  radius" style="max-height:100px;max-width:150px;" /></center>
                                    </div></td>


                                    <td><a href="delete_menu.php?menu_del='.$rows['d_id'].'" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
                                    <a href="update_menu.php?menu_upd='.$rows['d_id'].'" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i></a>
                                    </td></tr>';



                                }	
                            }


                            ?>






                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

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