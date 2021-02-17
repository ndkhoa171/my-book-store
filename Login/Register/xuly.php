<?php
session_start();
if(isset($_POST["name"]) && isset($_POST["address"]) && isset($_POST["username"]))
{
   $ketqua = 0;

$conn = mysqli_connect('localhost', 'root', '', 'mybookstore') ;
  if($conn){
    mysqli_query($conn,"SET NAMES 'utf8'");
  }
  else {
    //echo "Bạn đã kết nối thất bại".mysqli_connect_error();
  }

header('Content-Type: text/html; charset=utf-8');


	$username = $_POST['username'];
	$sql = "SELECT * FROM accounts WHERE accountID = '$username'";
  //echo $sql;
    $result = mysqli_query($conn, $sql);  
    if (mysqli_num_rows($result) > 0)
    { 
        $ketqua = 1;
        //return;
    }
    else{
      $pass = hash('ripemd160',$_POST['xacnhan']);
    	$insertAcc = "INSERT INTO accounts
            VALUES ('$username','$pass','customer')";
      $inAcc = mysqli_query($conn,$insertAcc);
      
      // Insert Customer
      $sql_Customer = "SELECT * FROM customers ";
      $query_Customer=mysqli_query($conn,$sql_Customer); // Lấy danh sách Customer
      if($query_Customer)
      {
          $count_Row= mysqli_num_rows($query_Customer); // Lấy số lượng Customer
          $count_Row-=1; 
          $sql_Customer.=" LIMIT $count_Row,1"; // Lấy ra Customer cuối cùng
          $query_Customer_Last=mysqli_query($conn,$sql_Customer);
          $Customer=mysqli_fetch_array($query_Customer_Last);
          $ID_Customer =(int)substr($Customer['CustomerID'], 2); 
          $ID_Customer_New =$ID_Customer+1; 
          $ID_Customer_New="KH".$ID_Customer_New;
      }
      else {
          $ID_Customer_New="KH1";
      }
      $date = getdate();
      $date_Now=$date['year'].'-'.$date['mon'].'-'.$date['mday'];
      // $insertCustomer="INSERT into customers(CustomerID,CustomerName,Email,City,Birthdate,AccountID,CreateAt) 
      //                   values('$ID_Customer','$_POST['name']','$_POST['email']','$_POST['address']','$_POST['birth']','$username','$date_Now')";
      $CustomerName=$_POST['name'];
      $Email =$_POST['email'];
      $Birdate=$_POST['birth'];
      $Address=$_POST['address'];
    	$insertCustomer="INSERT into customers(CustomerID,CustomerName,Email,City,Birthdate,AccountID,CreateAt) 
                        values('$ID_Customer_New','$CustomerName','$Email','$Address','$Birdate','$username','$date_Now')";
    	
    	$inCus = mysqli_query($conn,$insertCustomer);
    	if(!$inAcc )
    	{
        //echo "Thêm thất bại";
        $ketqua = 3;
    	}
    	else
        {
        //echo "Thêm thành công;";
        $ketqua = 2;
        $message = "Đăng ký thành công";
        //echo "<script type='text/javascript'>alert('$message');</script>";
        }
        
    }
    echo $ketqua;
}
?>