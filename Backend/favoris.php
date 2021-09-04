<?php

require_once 'config.php';
$con= mysqli_connect($server,$user,$mp,$database,$port);
$sql = "INSERT INTO favoris(id_user,id_med)VALUES ('".$_GET["id_med"]."','".$_GET["id_user"]."')";
if (mysqli_query($con, $sql)) {
	
               
			   $response["success"] = 1;
            } else {
               echo "Error: " . $sql . "" . mysqli_error($con);
			   $response["success"] = 0;
            }
echo json_encode($response);
?>