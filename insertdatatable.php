<?php
$con=mysqli_connect("localhost","root","","TMS");
if($con===false)
{
die("Connection failed: " . mysqli_connect_error());
}
include "db_connection.php";
session_start();
if(isset($_POST["product_Name"]))
{
		$mobileNo=$_POST['mobile_NO'];
		$CustomerName=$_POST['Customer_Name'];
		$customerAddress=$_POST['customer_Address'];
		$customerMail=$_POST['email_txt'];
		
		$query ='INSERT INTO customerinfo(Name,Address,Mobile,Email)
		VALUES ( "'.$CustomerName.'", "'.$customerAddress.'", "'.$mobileNo.'", "'.$customerMail.'");';
		
		if(mysqli_query($conn,$query))
		{
		$result= mysqli_query($conn,"SELECT MAX(CustomerID)FROM customerinfo");
		$row = mysqli_fetch_row($result);
		$highest_id = $row[0];
		//$_SESSION['OID']="$highest_id";
        $orderDate=$_POST['orderDate'];   
        $deliveryDate=$_POST['deliveryDate']; 
		$creator="1";   
        $delivered="0"; 
		$query="";
	
	
		$query .='INSERT INTO `orderinfo`(`SysDate`, `OrderDate`, `DeliveryDate`, `CustomerID`, `Creator`, `Delivered`)
		VALUES (SysDate(), "'.$orderDate.'", "'.$deliveryDate.'", "'.$highest_id.'", "'.$creator.'", "'.$delivered.'");';

		if(mysqli_query($conn,$query))
		{
		
	$product_Name= $_POST["product_Name"];
	$product_Quantity= $_POST["product_Quantity"];
	$product_Rate= $_POST["product_Rate"];
	$result= mysqli_query($conn,"SELECT MAX(OrderID)FROM orderinfo");
	$row = mysqli_fetch_row($result);
    $highest_oid = $row[0];
	$delivery_Qty= $_POST["delivery_Qty"];

	$query= '';
	for($count=0; $count<count($product_Name); $count++)
	{
		
		$product_Name_clean= mysqli_real_escape_string($conn, $product_Name[$count]);
		$product_Quantity_clean= mysqli_real_escape_string($conn, $product_Quantity[$count]);
		$product_Rate_clean= mysqli_real_escape_string($conn, $product_Rate[$count]);
		$delivery_Qty_clean= mysqli_real_escape_string($conn, $delivery_Qty[$count]);
		if($product_Name_clean !='' && $product_Quantity_clean !='' && $product_Rate_clean !='')
		{
			
			
			$query .= 'INSERT INTO `orderdetails` ( `OrderID`, `ProductID`, `OrderQty`, `DeliveryQty`, `Rate`) 
		VALUES ("'.$highest_oid.'", "'.$product_Name_clean.'", "'.$product_Quantity_clean.'", "'.$delivery_Qty_clean.'", "'.$product_Rate_clean.'");';
		}

	}
	
	
	if($query !='')
	{
		if (mysqli_multi_query($conn, $query))
		{
			/* $query= mysqli_query($con,"SELECT MAX(OrderID) AS 'maxId' FROM orderinfo");
			 $maxId = mysqli_fetch_row($query);
			$highest_id = $maxId[0];
			if ($query) 
			{
			$maxid = $query->maxid; 
			} */
			$result= mysqli_query($conn,"SELECT MAX(ODID)FROM orderdetails");
			$row = mysqli_fetch_row($result);
			$highest_odid = $row[0];
			$component_val= $_POST["component_val"];
			$component_Size= $_POST["component_Size"];

			$query= '';
			for($count=0; $count<count($component_val); $count++)
			{
				
				$Component_Name_clean= mysqli_real_escape_string($conn, $component_val[$count]);
				$Component_Size_clean= mysqli_real_escape_string($conn, $component_Size[$count]);
				
				if($Component_Name_clean !='' && $Component_Size_clean !='' )
				{
					
					$query .= 'INSERT INTO `orderprodetails` ( `ODID`, `PCID`, `Size`)
				VALUES ("'.$highest_odid.'", "'.$Component_Name_clean.'", "'.$Component_Size_clean.'" );';
				}

			}
			if($query !='')
			{
				if(mysqli_multi_query($conn, $query))
				{
					echo 'data Partial insert Successfull';
				}
			}
		}
		else
		{
			echo 'Error';
		}
	}
}
}
}
		

?>