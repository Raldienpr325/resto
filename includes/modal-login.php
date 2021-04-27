<?php
  if(isset($_POST['submit']))
  {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if(!empty($_POST["submit"])) 
    {
      $loginquery ="SELECT * FROM users WHERE username='$username' && password='".md5($password)."'";
      $result=mysqli_query($db, $loginquery);
      $row=mysqli_fetch_array($result);
      if(is_array($row)) 
      {
        $_SESSION["user_id"] = $row['u_id']; 
        header("refresh:1;url=index.php"); 
      } 
      else
      {
        $message = "Invalid Username or Password!";
      }
    }
  }
?>
<div id="idLoginForm" class="modal">
    <form class="modal-content animate" action="" method="post">
      <div class="imgcontainer">
        <span onclick="document.getElementById('idLoginForm').style.display='none'" class="close"
          title="Close Modal">&times;</span>
      </div>

      <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <button type="submit">Login</button>
        <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
      </div>

      <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('idLoginForm').style.display='none'"
          class="cancelbtn">Cancel</button>
      </div>
    </form>
  </div>