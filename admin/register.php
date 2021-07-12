<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php');

    if ($_SESSION['username'])
    {
        $currentuser = $_SESSION['username'];
        if ($currentuser != "admin") {
          header('Location: linksmod.php');
        }
    }
?>


<style>
    #b1 {
        margin-bottom: 10px;
    }
    h2 {

    }
</style>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dodaj użytkownika</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form action="code.php" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="username" id="firstName" class="form-control" placeholder="Nazwa użytkownika" required="required" autofocus="autofocus">
                  <label for="firstName">Nazwa użytkownika</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Hasło" required="required">
                  <label for="inputPassword">Hasło</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" name="confirmpassword" id="confirmPassword" class="form-control" placeholder="Potwierdź hasło" required="required">
                  <label for="confirmPassword">Potwierdź hasło</label>
                </div>
              </div>
            </div>
          </div>
        
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required="required">
                  <label for="inputEmail">Email</label>
                </div>
              </div>
              </div>
              </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Dodaj</button>
        </div>
        </form>
        </div>
        </div>     
    </div>
    </div>


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
      <span>Strony:</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <a class="dropdown-item" href="indexshop.php">Sklep</a>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="permission.php">
      <i class="fas fa-fw fa-table"></i>
      <span>Tabela Praw</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="linksmod.php">
      <i class="fas fa-fw fa-table"></i>
      <span>Tabela - Produkty</span></a>
  </li>
</ul>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Tabela Adminów</a>
      </li>
      <li class="breadcrumb-item active">Podgląd</li>
    </ol>

    
    <!-- Button trigger modal -->
<button type="button" id="b1" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Dodaj użytkownika
</button>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Table z adminami</div>
      <div class="card-body">

<?php
    if (isset($_SESSION['success']) && $_SESSION['success'] !="")
    {
        echo '<h2 class="bg-primary text-white"> '.$_SESSION['success'].' </h2>';
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['status']) && $_SESSION['status'] !='')
    {
        echo '<h2 class="bg-danger text-white"> '.$_SESSION['status'].' </h2>';
        unset($_SESSION['status']);
    }
?>


        <div class="table-responsive">

            <?php
                $connection = mysqli_connect('localhost', 'root', '', 'adminpanel');
                $connection->query("SET NAMES utf8 COLLATE utf8_polish_ci");

                $query = "SELECT * from register";
                $query_run = mysqli_query($connection, $query);
            ?>

          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Id</th>
                <th>Użytkownik</th>
                <th>Email</th>
                <th>Hasło</th>
                <th>Edytuj</th>
                <th>Usuń</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    if (mysqli_num_rows($query_run) > 0)
                    {
                        while($row = mysqli_fetch_assoc($query_run))
                        {
                            ?>

                            
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td>
                  <form action="register_edit.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="edit_btn" class="btn btn-success">Edytuj</button>
                  </form>
                </td>
                <td>
                  <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="deletebtn" class="btn btn-danger">Usuń</button>
                  </form>       
                </td>
              </tr> 
              
              <?php
                        }
                    }
                    else{
                        echo "No record found";
                    }
                ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Ostatnia modyfikacja 21-06-2019
      
      </div>
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