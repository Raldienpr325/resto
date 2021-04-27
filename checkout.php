<?php
include("connection/connect.php");
error_reporting(0);
session_start();

include_once 'product-action.php';
if (empty($_SESSION["user_id"])) {
  header('location:login.php');
} else {
  foreach ($_SESSION["cart_item"] as $item) {
    $item_total += ($item["price"] * $item["quantity"]);
  }
  if ($_POST['submit']) {
    $SQL = "insert into users_orders(u_id,title,quantity,price) values('" . $_SESSION["user_id"] . "','" . $item["title"] . "','" . $item["quantity"] . "','" . $item_total . "')";
    mysqli_query($db, $SQL);
    $success = "Order sukses! <p>Anda akan diarahkan ke menu pesanan dalam <span id='counter'>5</span> detik.</p>
    <script type='text/javascript'>
    function countdown() {
      var i = document.getElementById('counter');
      if (parseInt(i.innerHTML)<=0) {
        location.href = 'login.php';
      }
    i.innerHTML = parseInt(i.innerHTML)-1;
    }
    setInterval(function(){ countdown(); },1000);
    </script>'";
	  header("refresh:5;url=pesanan.php"); // redireted once inserted success
  }
}
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
      <span style="color:green;">
				<?php echo $success; ?>
			</span>
    </div>
    <form method="post" action="#">
      <div class="row">
        <div class="col-sm-12">
          <div>
            <div>
              <table class="table">
                <tbody>
                  <tr>
                    <td>Total Pesanan</td>
                    <td> <?php echo "Rp." . $item_total; ?></td>
                  </tr>
                  <tr>
                    <td>Pengiriman &amp; Penanganan</td>
                    <td>gratis pengiriman</td>
                  </tr>
                  <tr>
                    <td class="text-color"><strong>Total</strong></td>
                    <td class="text-color"><strong> <?php echo "Rp." . $item_total; ?></strong></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!--cart summary-->
          <div style="text-align: center">
            <p class="text-xs-center"> <input type="submit" onclick="return confirm('Apakah Kamu Yakin?');" name="submit" class="btn btn-outline-success btn-block" value="Pesan Sekarang"> </p>
          </div>
    </form>
  </div>
</div>

</div>
</div>
</form>
</div>
</div>
<?php include('includes/navbar-bottom.php') ?>
<?php include('includes/modal-login.php') ?>
<?php include('includes/footer.php') ?>