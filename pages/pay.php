<?php
session_start();
if(isset($_GET['Button_Pay']))
{
    if(!isset($_SESSION["customerid"]))
    {
        header("location:../Login/index.php");
    }
    else {
        if(isset($_SESSION["cart"])){
            include '../extension/connection.php';
            $date = getdate();
            $date_Now=$date['year'].'-'.$date['mon'].'-'.$date['mday'];
            $cusID= $_SESSION["customerid"];
            $inserOrder="INSERT into orders(CustomerID,Create_At,Create_Update,StatusID) 
                        values('$cusID','$date_Now','$date_Now',1)";
            $insO=mysqli_query($conn,$inserOrder); // thêm vào đơn hàng mới

            // Lấy ra mã order vừa thêm vào
            $sql_Order = "SELECT * FROM Orders ";
            $query_Order=mysqli_query($conn,$sql_Order); // Lấy danh sách Order
            if($query_Order)
            {
                $count_Row= mysqli_num_rows($query_Order); // Lấy số lượng Order
                $count_Row-=1; 
                $sql_Order.=" LIMIT $count_Row,1"; // Lấy ra Order cuối cùng
                $query_Order_Last=mysqli_query($conn,$sql_Order);
                $Order_Last=mysqli_fetch_array($query_Order_Last); //Order mới thêm vào
            }
            $orderID= $Order_Last['OrderID'];
            
            $total = 0;
            foreach ($_SESSION["cart"] as $key => $value) {
                $total += $value["price"] * $value["num"] ;
                $idProduct= $value["id"];
                $quantity = $value["num"];
                $price=$value["price"];
                $total_orderdetail= $quantity*$price;
                $inserOrderDetail="INSERT into orderdetails(OrderID,ProductID_fk,Quantity,UnitPrice,Discount,Total) 
                        values('$orderID','$idProduct','$quantity','$price','0','$total_orderdetail')";
                $inOD = mysqli_query($conn,$inserOrderDetail);
                
                $updateProduct="UPDATE products SET products.UnitsInStock = (products.UnitsInStock - $quantity), products.UnitsOnOrder=(products.UnitsOnOrder + $quantity) 
                WHERE (products.ProductID = $idProduct)";
                $upProduct=mysqli_query($conn,$updateProduct);

            }

            $updateOrder="UPDATE orders SET orders.TotalPrice = $total WHERE (orders.OrderID = $orderID)";
            $updO=mysqli_query($conn,$updateOrder);
            unset($_SESSION['cart']);
            ?>
                <script>
                    location.assign("../index.php");
                    alert("Bạn đã đặt hàng thành công");
                </script>
            <?php
        }
    }
}

?>