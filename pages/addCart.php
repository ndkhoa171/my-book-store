<?php
	session_start();
	if(isset($_POST["id"]) && isset($_POST["num"])){
		include("../extension/connection.php");
		$id = $_POST["id"];
		$quan =	$_POST["num"];
		$detail = "SELECT * FROM products where productID = ".$id;
		$photo = "SELECT * FROM photos where productID = ".$id;
		$result_de = mysqli_query($conn,$detail);
		$result_pho = mysqli_query($conn,$photo);
		$row2 = mysqli_fetch_row($result_pho);
		$row = mysqli_fetch_row($result_de);

		if(!isset($_SESSION["cart"])){
			$cart =array();
			$cart[$id] = array(
				'id'=> $id,
				'name' => $row[1],
				'num' => $quan,
				'price' => $row[3],
				'image' => $row2[2]
			);
		}else{
			$cart = $_SESSION["cart"];
			if(array_key_exists($id, $cart)){
				$cart[$id] = array(
					'id'=> $id,
					'name' => $row[1],
					'num' => (int)$cart[$id]['num'] + $quan,
					'price' => $row[3],
					'image' => $row2[2]
				);
			}else{
				$cart[$id] = array(
					'id'=> $id,
					'name' => $row[1],
					'num' => $quan,
					'price' => $row[3],
					'image' => $row2[2]
				);
			}
		}
		$_SESSION["cart"] = $cart;
		$numCart = 0;
		foreach ($cart as $key => $value) {
			$numCart++;
		}
		echo $numCart;
	}
?>