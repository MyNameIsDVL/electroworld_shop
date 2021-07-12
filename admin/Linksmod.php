<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php');
?>


<style>
    #b1 {
        margin-bottom: 10px;
    }
    #b2 {
        margin-bottom: 10px;
        margin-left: 5px;
    }
    #b3 {
      margin-bottom: 10px;
      margin-left: 5px;
    }
    #b4 {
      margin-bottom: 10px;
      margin-left: 5px;
    }
    h2 {

    }

    #title {
      color: #222;
      display: block;
      text-align: center;
      font-weight: bold;
    }
    .words {
      display: block;
      text-align: center;
      justify-content: center;
      font-weight: bold;
    }

    .info-background {
      display: block;
      background: grey;
      margin: 10px 10px;
      padding: 5px 5px;
      border-radius: 2px;
      box-shadow: 0 2px 5px 0 rgba(0,0,0,0.5), 0 2px 10px 0 rgba(0,0,0,0.5);
    }
    #foldertext {
      display: block;
      align-content: center;
    }
</style>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dodaj Element</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form action="orderscode.php" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="name" id="firstName" class="form-control" placeholder="Name" required="required">
                  <label for="firstName">Nazwa</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="hidden" id="inputEmail" class="form-control" placeholder="File" required="required">
              <label for="inputEmail">Plik</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <select class="form-control" name="file">
                <?php
                    $dir_path1 = "../files-tmp";
                    $option = '';

                    if (is_dir($dir_path1))
                    {
                        $file = opendir($dir_path1);
                        {
                            if ($file)
                            {
                                while (($file_name = readdir($file)) !== FALSE)
                                {
                                    if ($file_name != '.' && $file_name != '..')
                                    {
                                        $option = $option."<option>$file_name</option>";
                                        
                                    }
                                }
                            }
                        }              
                    }
                    echo $option;
              ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="price" id="inputPrice" class="form-control" placeholder="Cena" required="required">
              <label for="inputPrice">Cena</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <textarea type="text" name="info" id="inputInfo" class="form-control" placeholder="Info" required="required"></textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="brands" id="inputBrands" class="form-control" placeholder="Marka" required="required">
              <label for="inputBrands">Marka</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="type" id="inputType" class="form-control" placeholder="Typ" required="required">
              <label for="inputType">Typ</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="number" name="quantity" id="inputQuantity" class="form-control" placeholder="Ilość" required="required">
              <label for="inputQuantity">Ilość</label>
            </div>
          </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
            <button type="submit" name="addproduct" class="btn btn-primary">Dodaj</button>
        </div>
        </form>
        </div>
        </div>     
    </div>
    </div>


    <!-- Modal add file to folder -->         
          <div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">          
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Dodaj plik do folderu</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="sendtofolder.php" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <div class="form-row">
                          <div class="col-md-6">
                            <div class="form-label-group">
                              <input type="file" name="fieldfile" class="btn btn-secondary" id="fieldfile" class="form-control" required="required" autofocus="autofocus" multiple/>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                          <button type="submit" class="btn btn-primary">Dodaj</button>
                      </div>
                    </form>
                  </div>
              </div>     
            </div>
          </div> 
          
          
    <?php
    $connection = mysqli_connect('localhost', 'root', '', 'adminpanel');
    $connection->query("SET NAMES utf8 COLLATE utf8_polish_ci"); 
    
    $today = getdate();
    $dt = $today['year']."-".$today['mon']."-".$today['mday']." ".$today['hours'].":".$today['minutes'].":".$today['seconds'];
    $name = $_SESSION['username'];
    $permesiAdd = 1;
    $permesiEdit = 1;
    $permesiDel = 1;
    if ($name != 'admin') {
      $query = "SELECT permission from security where username = '$name' and calledfunction = 'DOKUMENTY' and action = 'ADD'";
      $query_run = mysqli_query($connection, $query);
      if (mysqli_num_rows($query_run) > 0)
      {
          while($row = mysqli_fetch_assoc($query_run))
          {
              $permesiAdd = $row['permission'];
          }
      }

      $query = "SELECT permission from security where username = '$name' and calledfunction = 'DOKUMENTY' and action = 'EDIT'";
      $query_run = mysqli_query($connection, $query);
      if (mysqli_num_rows($query_run) > 0)
      {
          while($row = mysqli_fetch_assoc($query_run))
          {
              $permesiEdit = $row['permission'];
          }
      }

      $query = "SELECT permission from security where username = '$name' and calledfunction = 'DOKUMENTY' and action = 'DEL'";
      $query_run = mysqli_query($connection, $query);
      if (mysqli_num_rows($query_run) > 0)
      {
          while($row = mysqli_fetch_assoc($query_run))
          {
              $permesiDel = $row['permission'];
          }
      }
    }
    $_SESSION['status'] = $dt.$name.(string)$permesiAdd.(string)$permesiEdit.(string)$permesiDel;
    ?>

    <!-- Modal showin list of files in folder -->
<div class="modal fade" id="filedir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Folder: files</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group" id="foldertext">
                  <?php
                    $dir_path = "../images";
                    if (is_dir($dir_path))
                    {
                      $files = opendir($dir_path);
                      {
                        if ($files)
                        {
                          while (($files_name = readdir($files)) !== FALSE)
                          {
                            if ($files_name != '.' && $files_name != '..')
                            {
                              echo $files_name."<br>";
                            }
                          }
                        }
                      }
                
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
        </div>
        </form>
        </div>
        </div>     
    </div>
    </div>

  
<!-- Modal Report generator -->
<div class="modal fade" id="docgener" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Generuj raport</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form action="docgener.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group" id="foldertext">
                <input type="text" name="gener" id="generi" class="form-control" placeholder="Nazwa pliku" required="required">
                <label for="generi">Sortuj pliki do raportu</label>
              </div>
              </div>
            </div>
          </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
            <button type="submit" name="btngenerpdf" class="btn btn-primary">Generuj</button>
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
    <a class="nav-link" href="#">
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
      <a class="dropdown-item" href="../Shop/orders.php">Sklep</a>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" <?php if ($name != 'admin'){ ?> href="" <?php   }else{ ?> href="register.php" <?php } ?>>
      <i class="fas fa-fw fa-table"></i>
      <span>Tabela Adminów</span></a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-folder"></i>
      <span>Modyfikuj Strony:</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <a class="dropdown-item" href="">Sklep - str1</a>
      <a class="dropdown-item" href="">Sklep - str2</a>
      <a class="dropdown-item" href="techhelper.php">Pomoc Techniczna</a>
    </div>
  </li>
</ul>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Produkty</a>
      </li>
      <li class="breadcrumb-item active">Podgląd</li>
    </ol>

    <!-- Breadcrumbs-->
    <ol class="info-background">
      <h1 id="title">Uwaga!</h1>
      <p class="words">Wszelkie problemy proszę zgłaszać do:<br>
      husm116@gmail.com<br>
      Tytuł: Panel Admina. Treść: opis problemu/błędu</p>
    </ol>

    
    <!-- Button trigger modal -->

  <button type="button" id="b1" name="addbtncheck" <?php if ($permesiAdd == '0'){ ?> disabled <?php   } ?> class="btn btn-primary" data-toggle="modal" data-target="#fileModal">
    Dodaj plik
  </button>
  <button type="button" id="b2" <?php if ($permesiAdd == '0'){ ?> disabled <?php   } ?> class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Zatwierdź plik
  </button>
  <button type="button" id="b3" class="btn btn-primary" class="view_files" data-toggle="modal" data-target="#filedir">
    Lista aktywnych plików
  </button>
  <button type="button" id="b4" class="btn btn-primary" class="view_files" data-toggle="modal" data-target="#docgener">
    Generuj raport
  </button>


    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Tabela główna - Produkty</div>
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

                $query = "SELECT * from tbl_shop_product";
                $query_run = mysqli_query($connection, $query);
            ?>

          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nazwa</th>
                <th>Obrazek</th>
                <th>Cena</th>
                <th>Info</th>
                <th>Marka</th>
                <th>Typ</th>
                <th>Ilość</th>
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
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['image']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['info']; ?></td>
                <td><?php echo $row['brands']; ?></td>
                <td><?php echo $row['type']; ?></td>
                <td><?php echo $row['quan']; ?></td>
                <td>
                  <form action="links_edit.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="edit_btn" class="btn btn-success" <?php if ($permesiEdit == '0'){ ?> disabled <?php   } ?>>Edytuj</button>
                  </form>
                </td>
                <td>
                  <form action="orderscode.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="deletebtn" class="btn btn-danger" <?php if ($permesiDel == '0'){ ?> disabled <?php   } ?>>Usuń</button>
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
      <div class="card-footer small text-muted">Modyfikowane 20-06-2019
      
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




