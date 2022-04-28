<?php
    include('./connect.php');
    $vendorName = $_POST['vendorName'];
	$categoryId = $_POST['categoryId'];
	$address = $_POST['address'];
    $phone = $_POST['phone'];
	$website = $_POST['website'];
	$priceRange = $_POST['priceRange'];
    $vendorType = $_POST['vendorType'];
	$description = $_POST['description'];
	$workingHours = $_POST['workingHours'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $targetDir = "vendor-images/"; 
    $fileName = $_FILES['file']['name']; 
    if($fileName){
        $targetFilePath = $targetDir . $fileName; 
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
            $query = "INSERT INTO Vendors(VendorId, VendorName, CategoryId, Address, Phone, Website, PriceRange, VendorTypeId, Image, Description, WorkingHours, Latitude, Logitude) VALUES(null, '".$vendorName."', '".$categoryId."', '".$address."', '".$phone."', '".$website."', '".$priceRange."', '".$vendorType."', '".$fileName."', '".$description."', '".$workingHours."', '".$latitude."', '".$longitude."')";
    
            $result = $link->query($query);
            if(!$result){
                $return_value = array(
                    'code' => 403,
                    'message' => mysqli_error()
                );
                echo json_encode($return_value);
            }else{
                $return_value = array(
                    'code' => 200,
                    'message' => "data inserted"
                );
                echo json_encode($return_value);
            }
            $link->close();
        }
    }
?>