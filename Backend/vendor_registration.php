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
    $latLng = $_POST['latLng'];
	$password = $_POST['password'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $targetDir = "vendor-images/"; 
    $fileNames = array_filter($_FILES['files']['name']); 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    $uploadedFiles = "";
    if(!empty($fileNames)){ 
        foreach($_FILES['files']['name'] as $key=>$val){ 
            $fileName = basename($fileNames[$key]); 
            $targetFilePath = $targetDir . $fileName; 

            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    $uploadedFiles .= "'" .$fileName."',";
                }
            }

        }
        $uploadedFiles = substr($uploadedFiles, 0, strlen($uploadedFiles) - 1);
    }
    if(strlen($uploadedFiles) > 0){ 
        $query = "INSERT INTO Vendors(VendorId, VendorName, CategoryId, Address, Phone, Website, PriceRange, VendorTypeId, Image, Description, WorkingHours, LatLng) VALUES(null, '".$vendorName."', '".$categoryId."', '".$address."', '".$phone."', '".$website."', '".$priceRange."', '".$vendorType."', '".$uploadedFiles."', '".$description."', '".$workingHours."', '".$latLng."')";
    
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
    }else{ 
        $return_value = array(
            'code' => 400,
            'message' => "Image upload failed"
        );
        echo json_encode($return_value);
    }
    $link->close();
?>