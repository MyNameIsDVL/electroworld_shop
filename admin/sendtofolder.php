<?php

session_start();

   if(isset($_FILES['fieldfile'])){
      $file = $_FILES['fieldfile'];
      print_r($file);
      
      // file properties
      $file_name = $file['name'];
      $file_tmp = $file['tmp_name'];
      $file_size = $file['size'];
      $file_error = $file['error'];

      $file_ext = explode('.', $file_name);
      $file_ext = strtolower(end($file_ext));

      $allowed = array('pdf', 'jpg', 'txt', 'png');


      if(in_array($file_ext, $allowed)) {
          if ($file_error === 0) {
              if ($file_size <= 14194304) {
                  
                  $file_destination = '../files-tmp/' . $file_name;

                  if (move_uploaded_file($file_tmp, $file_destination)) {
                    $_SESSION['success'] = "Transfer zakonczony.";
                    header('Location: linksmod.php');
                  }
                  else {
                    $_SESSION['status'] = "Niepowodzenie.";
                    header('Location: linksmod.php');
                  }
              }
          }
      }
   }
   

   
   
   
?>