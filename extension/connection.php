<?php 
  $conn = mysqli_connect('localhost', 'root', '', 'mybookstore') ;
  if($conn){
    mysqli_query($conn,"SET NAMES 'utf8'");
  }
  else {
    echo "Bạn đã kết nối thất bại".mysqli_connect_error();
  }
?>