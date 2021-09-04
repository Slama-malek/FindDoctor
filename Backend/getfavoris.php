<?php

require_once 'config.php';
$con= mysqli_connect($server,$user,$mp,$database,$port);
$sql = "select count(*) as nbf from favoris where id_med='".$_GET["id_med"]."'";
$result = mysqli_query($con,$sql)or die(mysqli_error());
$nb=mysqli_num_rows($result) ;
$row = mysqli_fetch_array($result);
$nbf=$row["nbf"];
if($nb>0){
	
               
			   $response["success"] = 1;
			   $response["nbfavoris"] = $nbf;
			   
			   
            } else {
               echo "Error: " . $sql . "" . mysqli_error($con);
			   $response["success"] = 0;
            }
echo json_encode($response);
?>