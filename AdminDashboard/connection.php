<?php 
  $conn = mysqli_connect('localhost', 'root', '', 'mybookstore') ;
  if($conn){
    mysqli_query($conn,"SET NAMES 'utf8'");
  }
?>