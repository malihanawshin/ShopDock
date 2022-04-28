<?php
   include('./connect.php');
    $userName = $_POST['userName'];
    $password = $_POST['password'];
	
	//Create query
	$query = "SELECT * FROM users WHERE UserName = '" .$userName. "' and Password = '" . md5($password). "'";
    $result = $link->query($query);
    if($result->num_rows > 0){
        $return_value = array(
            'code' => 200,
            'message' => "login successful."
        );
        echo json_encode($return_value);
    }else{
        $return_value = array(
            'code' => 401,
            'message' => "login failed."
        );
        echo json_encode($return_value);
    }
    $link->close();
?>