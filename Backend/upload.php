<?php
include('./connect.php');
$targetDir = "vendor-images/"; 
$fileNames = array_filter($_FILES['files']['name']); 
$allowTypes = array('jpg','png','jpeg','gif'); 
$uploadedFiles = "";
$name = $_POST['name'];
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
    $return_value = array(
        'code' => 200,
        'message' => $name
    );
    echo json_encode($return_value);
}else{ 
    $return_value = array(
        'code' => 400,
        'message' => $targetDir
    );
    echo json_encode($return_value);
}
?>