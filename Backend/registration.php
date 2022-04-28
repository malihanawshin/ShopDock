<?php
    include('./connect.php');
    $userName = $_POST['userName'];
	$password = $_POST['password'];
	$email = $_POST['email'];
    $query = "INSERT INTO Users(UserId, UserName, Password, Email) VALUES(null, '".$userName."', '".md5($password)."', '".$email."')";
    
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
?>