<?php 
include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php');
?>


<div id="wrapper">

<!-- Sidebar -->
<ul class="sidebar navbar-nav">
  <li class="nav-item active">
    <a class="nav-link" href="linksmod.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Panel</span>
    </a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-folder"></i>
      <span>Strony</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      
    </div>
  </li>
</ul>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Edycja</a>
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
        
        $query = "SELECT * from tbl_shop_product where id='$id'";
        $query_run = mysqli_query($connection, $query);
    
        foreach ($query_run as $row)
        {
            ?>

            

      <form action="orderscode.php" method="post">
          <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="edit_name" value="<?php echo $row['name']; ?>" id="firstName" class="form-control" placeholder="Nazwa" required="required" autofocus="autofocus">
                  <label for="firstName">Nazwa</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="edit_file" value="<?php echo $row['image']; ?>" id="inputEmail" class="form-control" placeholder="File"  disabled>
              <label for="inputEmail">File</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="edit_price" value="<?php echo $row['price']; ?>" id="inputPrice" class="form-control" placeholder="Cena" required="required">
              <label for="inputPrice">Cena</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <textarea type="text" name="edit_info" id="inputInfo" class="form-control" placeholder="Info" required="required"><?php echo $row['info']; ?></textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="edit_brands" value="<?php echo $row['brands']; ?>" id="inputBrands" class="form-control" placeholder="Marka" required="required">
              <label for="inputBrands">Marka</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="edit_type" value="<?php echo $row['type']; ?>" id="inputType" class="form-control" placeholder="Typ" required="required">
              <label for="inputType">Typ</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="edit_quantity" value="<?php echo $row['quan']; ?>" id="inputQuantity" class="form-control" placeholder="Ilość" required="required">
              <label for="inputQuantity">Ilość</label>
            </div>
          </div>

          <div class="modal-footer">
            <a href="linksmod.php" class="btn btn-danger">Anuluj</a>
            <button type="submit" name="updatebtn" class="btn btn-primary">Zapisz</button>
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