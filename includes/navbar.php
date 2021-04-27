<header>
    <ul class="navbar">
      <li><a href="index.php">Home</a></li>
      <li><a href="list-restaurant.php">Restaurant</a></li>
      <li><a href="public/about.html">About</a></li>
      <li style="float:right"><a href="#" id="light" class="right">Dark Mode : : <span id="status"></span></a></li>
      <?php
        if(empty($_SESSION["user_id"])) // if user is not login
        {
          ?>
          <li style="float:right"><a class="active" href="register.php">Register</a></li>
          <li style="float:right"><a onclick="document.getElementById('idLoginForm').style.display='block'">Login</a></li>
          <?php
        }
        else
        {
          ?>
          <li style="float:right"><a class="active" href="logout.php">logout</a></li>
          <li style="float:right"><a href="pesanan.php">Pesanan Anda</a></li>
          <?php
        }
      ?>
    </ul>
  </header>