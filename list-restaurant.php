<?php
include("connection/connect.php");
error_reporting(0); 
session_start();
?>
<?php include('includes/header.php') ?>
  <?php include('includes/navbar.php') ?>
  <div class="header">
    <h1>Menu Makanan</h1>
    <p>Aneka Masakan Nasi Kotak & Tumpeng</p>
  </div>
  <div class="container">
      <div class="main">
      <div style="text-align: center;">
        <h2>Menu Popular di RestoKu</h2>
        <p>Halal, Sehat, dan Bergizi</p>
      </div>
        
        <?php $ress= mysqli_query($db,"select * from restaurant");
									      while($rows=mysqli_fetch_array($ress))
										  {
                        ?>
                          <div class="row card" style="padding: 20px; margin: 20px;">
                            <div class="col-sm-9">
                              <div class="row">
                                <div class="col-sm-4">
                                  <div class="entry-logo">
                                    <a class="img-fluid" href="restaurant.php?res_id=<?= $rows['rs_id'] ?>" > <img src="admin/menu_img/<?= $rows['image'] ?>" alt="Restauran logo"></a>
                                  </div>
                                </div>
                                <div class="col-sm-8">
                                  <p style="margin-top: 30px;"><?= $rows['title'] ?></p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <a href="restaurant.php?res_id=<?= $rows['rs_id'] ?>"><button>Lihat Masakan</button></a>
                            </div>
                          </div>
                        <?php
										  }
						?>
      </div>
  </div>
  <?php include('includes/navbar-bottom.php') ?>
  <?php include('includes/modal-login.php') ?>
<?php include('includes/footer.php') ?>