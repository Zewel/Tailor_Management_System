<?php
$con=mysqli_connect("localhost","root","","TMS");
if($con===false)
{
die("Connection failed: " . mysqli_connect_error());
}
			
		$result=$_REQUEST['Catgy'];
		$sql = "SELECT `PCID`,`Component` FROM `productcomponent` WHERE `ProductID` ='$result' ";
		
		$query = mysqli_query($con,$sql);
		$data = array();			
		 while ($row = $query->fetch_assoc()) {
			$data[] = $row;
			/* $data.push ({
				"id"   : $row["PCID"],
				"name" : $row["Component"]
			}); */
			} 
		
		/* $json_data = array(
		
		"data"=> $data   // total data array
		); */

		echo json_encode($data);  // send data as json format
		
		// Mobile Number Search
		//
		//
	
 ?>