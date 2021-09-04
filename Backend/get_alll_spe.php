<?php
header( 'content-type: text/html; charset=utf-8' );
require_once 'config.php';
// array for JSON response
$response = array();
$con= mysqli_connect($server,$user,$mp,$database,$port);
// get all profils from  table
$result = mysqli_query($con,"SELECT *FROM specialite") or die(mysqli_error());
// check for empty result
if (mysqli_num_rows($result) > 0) {
	 // success
    $response["success"] = 1;
    // looping through all results
    // profil node
    $response["specialite"] = array();
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $un_specialite = array();
		
		$un_specialite["id_sp"] = $row["id_sp"];
$un_specialite["nom"] = $row["nom"];
       // $un_specialite["image_spe"] = $row["image_spe"];
       
        // push single un_profil into final response array
        array_push($response["specialite"], $un_specialite);
    }
    
} else {
    // no profil found
    $response["success"] = 0;
    $response["message"] = "No profils found";

}
// echo result
   echo json_encode($response);
	
?>