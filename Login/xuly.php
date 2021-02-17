<?php
$conn = mysqli_connect('localhost', 'root', '', 'mybookstore') ;
  if($conn){
    mysqli_query($conn,"SET NAMES 'utf8'");
  }
  else {
    echo "Bạn đã kết nối thất bại".mysqli_connect_error();
  }
if (isset($_POST['login']))
{
	 $username = $_POST['username'];
   $pass =hash('ripemd160', $_POST['password']);
	 $sql = "SELECT * FROM accounts join customers on accounts.AccountID=customers.AccountID  WHERE accounts.accountID = '$username' and password = '$pass'";
   $result = mysqli_query($conn, $sql);  
    if (mysqli_num_rows($result) > 0)
    {   
        while($row = mysqli_fetch_array($result)){
          $role = $row['Role'];
          $customerID = $row['CustomerID'];
          $cusName = $row['CustomerName'];
          header("location:../index.php?role=$role&customerid=$customerID&customerName=$cusName");
        }
    }
    else
        header("location:../Login/index.php?saipass=1&user=$username");
}
?>