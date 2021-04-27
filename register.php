<?php
include("connection/connect.php");
error_reporting(0); 
session_start();
if(isset($_POST['submit'] ))
{
    if(empty($_POST['firstname']) ||
      empty($_POST['lastname'])|| 
      empty($_POST['email']) ||  
      empty($_POST['phone'])||
      empty($_POST['password'])||
      empty($_POST['cpassword']) ||
      empty($_POST['cpassword']))
    {
      $message = "All fields must be Required!";
    }
    else
    {
    $check_username= mysqli_query($db, "SELECT username FROM users where username = '".$_POST['username']."' ");
    $check_email = mysqli_query($db, "SELECT email FROM users where email = '".$_POST['email']."' ");

	if($_POST['password'] != $_POST['cpassword']){  //matching passwords
    $message = "Password not match";
  }
	elseif(strlen($_POST['password']) < 6)  //cal password length
	{
		$message = "Password Must be >=6";
	}
	elseif(strlen($_POST['phone']) < 10)  //cal phone length
	{
		$message = "invalid phone number!";
	}

    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
    {
      $message = "Invalid email address please type a valid email!";
    }
	elseif(mysqli_num_rows($check_username) > 0)  //check username
  {
    $message = 'username Already exists!';
  }
	elseif(mysqli_num_rows($check_email) > 0) //check email
  {
    $message = 'Email Already exists!';
  }
  else{
    $mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address) VALUES('".$_POST['username']."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['email']."','".$_POST['phone']."','".md5($_POST['password'])."','".$_POST['address']."')";
    mysqli_query($db, $mql);
    $success = "Account Created successfully! <p>You will be redirected in <span id='counter'>5</span> second(s).</p>
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
	  header("refresh:5;url=index.php"); // redireted once inserted success
    }
  }
}

?>
<?php include('includes/header.php') ?>
  <?php include('includes/navbar.php') ?>
  <div class="container">
    <div class="container card">
      <span style="color:red;"><?php echo $message; ?></span>
       <span style="color:green;">
        <?php echo $success; ?>
      </span>
    </div>
  </div>
  <div class="container">
      <div class="main">
      <div style="text-align: center;">
        <h2>Menu pendaftaran</h2>
        <p>Silahkan masukkan data anda dengan benar</p>
      </div>
      <form action="" method="post">
        <div class="row">
          <div class="form-group col-sm-12">
            <label for="exampleInputEmail1">Nama Pengguna</label>
            <input class="form-control" type="text" name="username" id="example-text-input" placeholder="Nama Pengguna ...."> 
          </div>
          <div class="form-group col-sm-6">
            <label for="exampleInputEmail1">Nama Depan</label>
            <input class="form-control" type="text" name="firstname" id="example-text-input" placeholder="Nama Depan ...."> 
          </div>
          <div class="form-group col-sm-6">
            <label for="exampleInputEmail1">Nama Belakang</label>
            <input class="form-control" type="text" name="lastname" id="example-text-input-2" placeholder="Nama Belakang ...."> 
          </div>
          <div class="form-group col-sm-6">
            <label for="exampleInputEmail1">Alamat Email</label>
            <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Email ...."> <small id="emailHelp" class="form-text text-muted">Kami tidak akan membagikan email anda kepada orang lain.</small> 
          </div>
          <div class="form-group col-sm-6">
            <label for="exampleInputEmail1">Phone number</label>
            <input class="form-control" type="text" name="phone" id="example-tel-input-3" placeholder="Phone"> <small class="form-text text-muted">Kami tidak akan membagikan No hp anda kepada orang lain.</small> 
          </div>
          <div class="form-group col-sm-6">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password ...."> 
          </div>
          <div class="form-group col-sm-6">
            <label for="exampleInputPassword1">Konfirmasi Password</label>
            <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" placeholder="Password ...."> 
          </div>
          <div class="form-group col-sm-12">
            <label for="exampleTextarea">Alamat</label>
            <textarea class="form-control" id="exampleTextarea"  name="address" rows="3"></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <p> <input type="submit" value="Daftar" name="submit"> </p>
          </div>
        </div>
      </form>
  </div>
  <?php include('includes/navbar-bottom.php') ?>
  <?php include('includes/modal-login.php') ?>
<?php include('includes/footer.php') ?>