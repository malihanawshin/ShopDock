<?php
    include('./connect.php');
    $category = $_POST['category'];
	$productType = $_POST['productType'];
	$sql = "SELECT * FROM Vendors WHERE 
			MATCH(Vendors.code_no) AGAINST('$text')
			OR MATCH(tbl_customer.phone_no) AGAINST('$text')
			OR MATCH(tbl_customer.mobile_no) AGAINST('$text')
			OR MATCH(tbl_customer.house_no) AGAINST('$text')" or die("Error".mysqli_error($link));
	$result = $link->query($sql);
	$sendResult = array();
	
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
	   $sendResult[] = array("name"=>$row["name"], "customer_code"=>$row["customer_code"], "address"=>$row["address"],"house_no"=>$row["house_no"], "phone_no"=>$row["phone_no"],"mobile_no"=>$row["mobile_no"]);
	}
	if($sendResult){

    }else{

    }
	echo json_encode($sendResult);
	$link->close();
?>