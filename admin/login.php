<?php 
session_start();
include('includes/header.php'); 
?>




<div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>

      <?php
    
    if (isset($_SESSION['status']) && $_SESSION['status'] !='')
    {
        echo '<h2 class="bg-danger text-white"> '.$_SESSION['status'].' </h2>';
        unset($_SESSION['status']);
    }
?>

      <div class="card-body">
        <form action="code.php" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="text" id="inputName" class="form-control" placeholder="User" required="required">
              <label for="inputName">User</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <div class="form-group">
          </div>
          <button type="submit" name="login_btn" class="btn btn-primary btn-block">Login</button>
        </form>
      </div>
    </div>
  </div>




<?php
include('includes/scripts.php');
?>