<?php
include("connection/connect.php");
error_reporting(0); 
session_start();
?>
<?php include('includes/header.php') ?>
  <?php include('includes/navbar.php') ?>
  <div class="header">
    <h1>RestoKu</h1>
    <p>Mencari Restoran ternama dengan mudah</p>
  </div>
  <div class="container">
      <div class="main">
      <div style="text-align: center;">
        <h2>Menu Popular di RestoKu</h2>
        <p>Halal, Sehat, dan Bergizi</p>
      </div>
        <div class="row">
        <?php 
						// fetch records from database to display popular first 3 dishes from table
						$query_res= mysqli_query($db,"select * from menus LIMIT 3"); 
									      while($r=mysqli_fetch_array($query_res))
										  {
												?>
                        <div class="col-lg-4">
                          <div class="card">
                            <img src="admin/menu_img/food/<?= $r['img'] ?>" alt="">
                            <div class="container">
                              <h4><b><?= $r['title'] ?></b></h4> 
                              <p><?= $r['slogan'] ?></p> 
                              <a href="food.php?res_id='.$r['rs_id'].'"><button>Rp <?= $r['price'] ?></button></a>
                            </div>
                          </div>
                        </div>
                        <?php
										  }
					
						?> 
        </div>
      </div>
  </div>
  <?php include('includes/navbar-bottom.php') ?>
  <?php include('includes/modal-login.php') ?>
<?php include('includes/footer.php') ?>