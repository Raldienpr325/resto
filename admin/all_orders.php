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
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Pesanan</h3> </div>
                </div>
                <!-- End Bread crumb -->
                <!-- Container fluid  -->
                <div class="container-fluid">
                    <!-- Start Page Content -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Daftar Pesanan Pelanggan</h4>
                                    <div class="table-responsive m-t-40">
                                        <table id="myTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nama Pelanggan</th>		
                                                    <th>Nama Masakan</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Alamat</th>
                                                    <th>Status</th>									
                                                    <th>Tanggal Pesanan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                             <?php
                                             $sql="SELECT users.*, users_orders.* FROM users INNER JOIN users_orders ON users.u_id=users_orders.u_id ";
                                             $query=mysqli_query($db,$sql);

                                             if(!mysqli_num_rows($query) > 0 )
                                             {
                                                 echo '<td colspan="8"><center>No Orders-Data!</center></td>';
                                             }
                                             else
                                             {				
                                               while($rows=mysqli_fetch_array($query))
                                               {

                                                ?>
                                                <?php
                                                echo ' <tr>
                                                <td>'.$rows['username'].'</td>
                                                <td>'.$rows['title'].'</td>
                                                <td>'.$rows['quantity'].'</td>
                                                <td>Rp.'.$rows['price'].'</td>
                                                <td>'.$rows['address'].'</td>';
                                                ?>
                                                <?php 
                                                $status=$rows['status'];
                                                if($status=="" or $status=="NULL")
                                                {
                                                 ?>
                                                 <td> <button type="button" class="btn btn-info" style="font-weight:bold;"><span class="fa fa-bars"  aria-hidden="true" >Proses</button></td>
                                                   <?php 
                                               }
                                               if($status=="in process")
                                                { ?>
                                                 <td> <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin"  aria-hidden="true" ></span>On a Way!</button></td> 
                                                 <?php
                                             }
                                             if($status=="closed")
                                             {
                                                 ?>
                                                 <td> <button type="button" class="btn btn-success" ><span  class="fa fa-check-circle" aria-hidden="true">Delivered</button></td> 
                                                     <?php 
                                                 } 
                                                 ?>
                                                 <?php
                                                 if($status=="rejected")
                                                 {
                                                     ?>
                                                     <td> <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i>cancelled</button></td> 
                                                     <?php 
                                                 } 
                                                 ?>
                                                 <?php																									
                                                 echo '	<td>'.$rows['date'].'</td>';
                                                 ?>
                                                 <td>
                                                  <a href="delete_orders.php?order_del=<?php echo $rows['o_id'];?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
                                                  <?php
                                                  echo '<a href="view_order.php?user_upd='.$rows['o_id'].'" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i></a>
                                                  </td>
                                                  </tr>';



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
<footer class="footer"> © 2021 All rights reserved. Template designed by <a href="https://colorlib.com">Colorlib</a></footer>
<!-- End footer -->
</div>
<!-- End Page wrapper  -->
</div>
<?php include('includes/footer.php') ?>