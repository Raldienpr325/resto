<?php
include("connection/connect.php");
error_reporting(0); 
session_start();
include_once 'product-action.php';
?>
<?php include('includes/header.php') ?>
  <?php include('includes/navbar.php') ?>
  <div class="header">
    <?php 
        $ress=mysqli_query($db,"select * from restaurant where rs_id='$_GET[res_id]'");
				$rows=mysqli_fetch_array($ress);
		?>
    <div class="row">
      <div class="col-sm-3">
        <img src="admin/menu_img/<?= $rows['image'] ?>" alt="" width="100%">
      </div>
      <div class="col-sm-9">
        <h1>Restaurant <?php echo $rows['title']; ?></h1>
      </div>
    </div>
    
  </div>
  <div class="container">
      <div class="main">
        <div style="text-align: center;">
          <h2>Menu Popular di Restaurant <?= $rows['title']; ?></h2>
          <p>Halal, Sehat, dan Bergizi</p>
        </div>
        <div>
          <div class="row">
            <div class="col-sm-3">
              <div class="card" style="padding: 20px; margin: 20px">
                <p>Pesanan anda</p>
                <?php
                  $item_total = 0;
                  foreach ($_SESSION["cart_item"] as $item){
                  ?>									
                    <div class="title-row">
                      <?php echo $item["title"]; ?><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>" >
                      <i class="fa fa-trash pull-right"></i></a>
                    </div>
                    <div class="form-group row no-gutter">
                      <div class="col-xs-8">
                        <input type="text" class="form-control b-r-0" value=<?php echo "Rp.".$item["price"]; ?> readonly>
                      </div>
                    <div class="col-xs-4">
                      <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>'> </div>
                    </div>
                  <?php
                    $item_total += ($item["price"]*$item["quantity"]); // calculating current price into cart
                  }
                ?>
                <p>TOTAL</p>
                <h3 class="value"><strong><?php echo "Rp. ".$item_total; ?></strong></h3>
                <p>Gratis Ongkir</p>
                <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check"><button>Checkout</button></a>
              </div>
            </div>
            <div class="col-sm-9">
            <?php  // display values and item of food/dishes
									$stmt = $db->prepare("select * from menus where rs_id='$_GET[res_id]'");
									$stmt->execute();
									$products = $stmt->get_result();
									if (!empty($products)) 
									{
									  foreach($products as $product)
										{
										?>
                      <div class="card" style="padding: 20px; margin: 20px;">
                        <form method="post" action='restaurant.php?res_id=<?php echo $_GET['res_id'];?>&action=add&id=<?php echo $product['d_id']; ?>'>
                          <div class="row">
                            <div class="col-sm-3">
                              <?php echo '<img src="admin/Res_img/dishes/'.$product['img'].'" alt="Food logo" width="100%">'; ?>
                            </div>
                            <div class="col-sm-6">
                              <h6><a href="#"><?php echo $product['title']; ?></a></h6>
                              <p> <?php echo $product['slogan']; ?></p>
                            </div>
                            <div class="col-sm-3"> 
										          <span class="price pull-left" >Rp. <?php echo $product['price']; ?></span>
										          <input type="text" name="quantity" value="1" size="2" />
										          <input type="submit" class="btn theme-btn" value="Beli Sekarang" />
										        </div>
                          </div>
                        </form>
                      </div>
								    <?php
									  }
									}
								?>
            </div>
          </div>
        </div>
        
      </div>
  </div>
  <?php include('includes/navbar-bottom.php') ?>
  <?php include('includes/modal-login.php') ?>
<?php include('includes/footer.php') ?>