<?php
session_start();

$connection = mysqli_connect('localhost', 'root', '', 'panel');
$connection->query("SET NAMES utf8 COLLATE utf8_polish_ci"); 
    
$name = $_SESSION['username'];

$permesi = '';

    if ($name == 'admin')
    {
        echo 'admin';
    }
    else 
    {
        $query = "SELECT permission from security where username = '$name' and calledfunction = 'DOKUMENTY' and action = 'ADD'";
        $query_run = mysqli_query($connection, $query);
        if (mysqli_num_rows($query_run) > 0)
        {
            while($row = mysqli_fetch_assoc($query_run))
            {
                $permesi = $row['permission'];  
            }
            
        }
    }
        

    /*
    if ($name == 'admin') {
      //$permesi = 1;
      echo 'Jesteś adminem';

      if (isset($_POST['addbtncheck']))
        {
            echo "<script type='text/javascript'>
            $(document).ready(function(){
            $('#fileModal').modal('show');
            });
            </script>";
        ?>
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
        }
    }
    else {
      $query = "SELECT permission from security where username = '$name' and calledfunction = 'DOKUMENTY' and action = 'ADD'";
      $query_run = mysqli_query($connection, $query);
      if (mysqli_num_rows($query_run) > 0)
      {
          while($row = mysqli_fetch_assoc($query_run))
          {
              $permesi = $row['permission'];           
          }
          
      }     
    }
    

    if ($permesi == 0)
    {
        echo 'Nie masz praw do tej funkcji';
    }
    else
    {
        if (isset($_POST['addbtncheck']))
        {
            echo "<script type='text/javascript'>
            $(document).ready(function(){
            $('#fileModal').modal('show');
            });
            </script>";
        ?>
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
        }
    }
*/
?>