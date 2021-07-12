<?php 
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php');

?>


<style>

textarea {
  height:auto;
  max-width:600px;
  color:#999;
  margin: 20px auto;
  display: block;
  box-shadow: 0 2px 5px 0 rgba(0,0,0,0.5), 0 2px 10px 0 rgba(0,0,0,0.5);
  font-weight:400;
  font-size:30px;
  font-family:'Ubuntu', Helvetica, Arial, sans-serif;
  width:100%;
  background: #222;
  border-radius:3px;
  line-height:2em;
  border-style: double;
  border-color: blue;
  padding:30px;
  -webkit-transition: height 2s ease;
-moz-transition: height 2s ease;
-ms-transition: height 2s ease;
-o-transition: height 2s ease;
transition: height 2s ease;
}

* {
  -webkit-font-smoothing:antialiased !important;
}

.notebtnc {
    position: absolute;
    width: 150px;
    height: 50px;
    text-align: center;
    margin: 0 50%;
    border-radius: 10px;
    background: blue;
    border-style: double;
    border-color: #222;
    color: white;
    font-size: 18px;
    font-weight: bold;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.5), 0 2px 10px 0 rgba(0,0,0,0.5);

}
.notebtnc:hover {
    background: orange;
    color:black;
    width: 180px;
}
   
</style>



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
            <h6 class="dropdown-header">Tools:</h6>
            <a class="dropdown-item" href="#">Help</a>
            <a class="dropdown-item" href="#">Styles</a>
            <a class="dropdown-item" href="#">NotePad</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Back:</h6>
            <a class="dropdown-item" href="../Shop/index.html">MainPage</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-table"></i>
          <span>Orders Table</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ordersmod.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Orders Moder</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Panel</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">Users!</div>

                <?php
                  require 'dbconfig.php';

                  $query = "SELECT id from register order by id";
                  $query_run = mysqli_query($connection, $query);

                  $row = mysqli_num_rows($query_run);

                  echo '<h3> '.$row.' </h3>';
                ?>

              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5">Notes!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5">Orders table!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">Events!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>
    </div>
    <!-- /.content-wrapper -->

<form action="note.php" method="post">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:300,400' rel='stylesheet' type='text/css'>
<div ng-app="myApp">
<div ng-controller="AppCtrl">
<textarea id="TextArea" name="area" ng-model="loremIpsum" ng-keyup="autoExpand($event)" placeholder="Note here....">
</textarea>
 <button type="submit" class="notebtnc" name="notebtn">Save Note</button>
  </div>
</div>
</form>

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Check your notes</a>
          </li>
          <li class="breadcrumb-item active">Notes</li>
        </ol>


          <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Note Table</div>
      <div class="card-body">

<?php
    if (isset($_SESSION['success']) && $_SESSION['success'] !="")
    {
        echo("{$_SESSION['success']}"."<br />");
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['status']) && $_SESSION['status'] !='')
    {
        echo("{$_SESSION['status']}"."<br />");
        unset($_SESSION['status']);
    }
?>


        <div class="table-responsive">

            <?php
                $connection = mysqli_connect('localhost', 'root', '', 'adminpanel');

                $query = "SELECT * from notes";
                $query_run = mysqli_query($connection, $query);
            ?>

          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Note</th>
                <th>Edit</th>
                <th>Delete</th>
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
                <td><?php echo $row['note']; ?></td>
                <td>
                    <button type="submit" class="btn btn-success">Edit</button>
                </td>
                <td>
                    <button type="submit" class="btn btn-danger">Delete</button>
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
      <div class="card-footer small text-muted">Updated
      
      </div>
    </div>

  </div>
  <!-- /#wrapper -->

 

  
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
  
