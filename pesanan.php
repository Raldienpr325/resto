<?php
include("connection/connect.php");
error_reporting(0);
session_start();
?>
<?php include('includes/header.php') ?>
<?php include('includes/navbar.php') ?>
<div class="header">
  <h1>Pesanan Saya</h1>
</div>
<div class="container">
  <div class="main">
    <table>
      <thead>
        <tr>
          <th>Makanan</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Status</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query_res = mysqli_query($db, "select * from users_orders where u_id='" . $_SESSION['user_id'] . "'");
        if (!mysqli_num_rows($query_res) > 0) {
          echo '<td colspan="6"><center>Anda belum melakukan pemesanan. </center></td>';
        } else {
          while ($row = mysqli_fetch_array($query_res)) {
        ?>
            <tr>
              <td data-column="Item"> <?php echo $row['title']; ?></td>
              <td data-column="Quantity"> <?php echo $row['quantity']; ?></td>
              <td data-column="price">Rp. <?php echo $row['price']; ?></td>
              <td data-column="status">
                <?php
                $status = $row['status'];
                if ($status == "" or $status == "NULL") {
                ?>
                  <button type="button" class="btn btn-info" style="font-weight:bold;">Proses</button>
                <?php
                }
                if ($status == "in process") { ?>
                  <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span>On a Way!</button>
                <?php
                }
                if ($status == "closed") {
                ?>
                  <button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true">Delivered</button>
                <?php
                }
                ?>
                <?php
                if ($status == "rejected") {
                ?>
                  <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i>cancelled</button>
                <?php
                }
                ?>
              </td>
              <td data-column="Date"> <?php echo $row['date']; ?></td>
              <td data-column="Action"> <a href="delete_orders.php?order_del=<?php echo $row['o_id']; ?>" onclick="return confirm('Are you sure you want to cancel your order?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10">Hapus</a>
              </td>
            </tr>
        <?php }
        } ?>
      </tbody>
    </table>
  </div>
</div>
<?php include('includes/navbar-bottom.php') ?>
<?php include('includes/modal-login.php') ?>
<?php include('includes/footer.php') ?>