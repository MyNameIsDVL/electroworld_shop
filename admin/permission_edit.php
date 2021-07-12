<?php 
include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php');
?>


<div id="wrapper">

<!-- Sidebar -->
<ul class="sidebar navbar-nav">
  <li class="nav-item active">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Panel</span>
    </a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-folder"></i>
      <span>Pages</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <a class="dropdown-item" href="../index.php">Strona główna</a>
    </div>
  </li>
</ul>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Edycja Praw</a>
      </li>
      <li class="breadcrumb-item active">Podgląd</li>
    </ol>

    


<div class="modal-body">

<?php
    $connection = mysqli_connect("localhost", "root", "", "adminpanel");
    $connection->query("SET NAMES utf8 COLLATE utf8_polish_ci");

    if (isset($_POST['edit_btn']))
    {
        $id = $_POST['edit_id'];
        
        $query = "SELECT * from security where id='$id'";
        $query_run = mysqli_query($connection, $query);
    
        foreach ($query_run as $row)
        {
            ?>

            

      <form action="code_perm.php" method="post">
          <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="edit_username" value="<?php echo $row['username']; ?>" id="firstName" class="form-control" disabled>
                  <label for="firstName">Nazwa użytkownika</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="edit_calledfunction" value="<?php echo $row['calledfunction']; ?>" id="inputPassword" class="form-control" disabled>
                  <label for="inputPassword">Funkcja</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="edit_action" value="<?php echo $row['action']; ?>" id="inputPassword" class="form-control" disabled>
                  <label for="inputPassword">Akcja</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="edit_permission" value="<?php echo $row['permission']; ?>" id="inputPassword" class="form-control" placeholder="Flaga" required="required">
                  <label for="inputPassword">Flaga</label>
                </div>
              </div>
            </div>
          </div>
        

          <div class="modal-footer">
            <a href="permission.php" class="btn btn-danger">Anuluj</a>
            <button type="submit" name="updatebtnperm" class="btn btn-primary">Zapisz</button>
        </div>
        </form>

          <?php
        }
    }
?>

        
        
        

        </div>


  </div>
  <!-- /.container-fluid -->

  

</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->








<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>