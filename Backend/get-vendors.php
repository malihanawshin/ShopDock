<?php
   include('./connect.php');
	
	//Create query
	$query = "SELECT * FROM Vendors ORDER BY 1 DESC";
    $result = $link->query($query);
    $sendResult = array();
	
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
	   $sendResult[] = array("VendorName"=>$row["VendorName"], "Address"=>$row["Address"], "Phone"=>$row["Phone"],"Website"=>$row["Website"], "PriceRange"=>$row["PriceRange"],"Image"=>$row["Image"],"Description"=>$row["Description"] ,"WorkingHours"=>$row["WorkingHours"]);
	}
    $return_value = array();
	if($sendResult){
        $return_value = array(
            'code' => 200,
            'message' => $sendResult
        );
    }else{
        $return_value = array(
            'code' => 401,
            'message' => "Vendor data retrieve failed"
        );
    }
	echo json_encode($return_value);
	$link->close();
?>