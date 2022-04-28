<?php
    include('./connect.php');
    $category = $_POST['category'];
	$productType = $_POST['productType'];
    $distance = (int)$_POST['distance'];
    $userLatLong = $_POST['userLatlng'];
    $comparator = $_POST["comparator"];
    $userLatitude = "";
    $userLongitude = "";
    $checkDistance = FALSE;
    if (!isset($category)) {
        $category = 1;
    }
    if (!isset($productType)) {
        $productType = 1;
    }
    if (isset($userLatLong)) {
        $checkDistance = TRUE;
        $userLatLong = explode(",", $userLatLong);
        $userLatitude = $userLatLong[0];
        $userLongitude = $userLatLong[1];
    }
    $categories = explode(",", $category);
    $productTypes = explode(",", $productType);
    $categoryQuery = "(";
    $productQuery = "(";
    for($x = 0; $x < $categories.count; $x++){
        if($x + 1 == $categories.count){
            $categoryQuery .= "CategoryId LIKE ('% ".$categories[$x]."%'))";
        }else{
            $categoryQuery .= "CategoryId LIKE ('% ".$categories[$x]."%') AND ";
        }
    }
    for($x = 0; $x < $productTypes.count; $x++){
        if($x + 1 == $productTypes.count){
            $productQuery .= "VendorTypeId LIKE ('% ".$productTypes[$x]."%'))";
        }else{
            $productQuery .= "VendorTypeId LIKE ('% ".$productTypes[$x]."%') AND ";
        }
    }
    $sql = "";
    if($checkDistance){
        if($comparator == "more"){
            $sql = "SELECT * FROM Vendors WHERE ".$categoryQuery." OR ".$productQuery. " AND ST_Distance_Sphere(POINT('".$userLongitude."', '".$userLatitude."'), POINT('".Longitude."', '".Latitude."')) >=".$distance;
        }else{
            $sql = "SELECT * FROM Vendors WHERE ".$categoryQuery." OR ".$productQuery. " AND ST_Distance_Sphere(POINT('".$userLongitude."', '".$userLatitude."'), POINT('".Longitude."', '".Latitude."')) <=".$distance;
        }
    }else{
        $sql = "SELECT * FROM Vendors WHERE ".$categoryQuery." OR ".$productQuery;
    }
	$result = $link->query($sql);
	$sendResult = array();
	
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
	   $sendResult[] = array("VendorName"=>$row["VendorName"], "Address"=>$row["Address"], "Phone"=>$row["Phone"],"Website"=>$row["Website"], "PriceRange"=>$row["PriceRange"],"Image"=>$row["Image"],"Description"=>$row["Description"] ,"WorkingHours"=>$row["WorkingHours"],"LatLong"=>$row["LatLong"]);
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
            'message' => "search failed"
        );
    }
	echo json_encode($return_value);
	$link->close();
?>