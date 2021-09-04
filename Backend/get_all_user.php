<?php
require_once 'config.php';
// array for JSON response
$response = array();
$con= mysqli_connect($server,$user,$mp,$database,$port);
// get all profils from  table
$usertype="medecin";
$result = mysqli_query($con,"SELECT *FROM personne where usertype='$usertype'") or die(mysqli_error());
// check for empty result
if (mysqli_num_rows($result) > 0) {
	 // success
    $response["success"] = 1;
    // looping through all results
    // profil node
    $response["medecin"] = array();
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $un_medecin = array();
		$un_medecin["id_pers"] = $row["id_pers"];
        $un_medecin["nom_prenom"] = $row["nom_prenom"];
        
        $un_medecin["adresse"] = $row["adresse"];
		$un_medecin["specialite"] = $row["specialite"];
		$un_medecin["email"] = $row["email"];
		$un_medecin["telephone"] = $row["telephone"];
		$un_medecin["genre"] = $row["genre"];
		$un_medecin["mdp"] = $row["mdp"];
		$un_medecin["image_path"] = $row["image_path"];
		$un_medecin["bio"] = $row["bio"];
        // push single un_profil into final response array
        array_push($response["medecin"], $un_medecin);
    }
    
} else {
    // no profil found
    $response["success"] = 0;
    $response["message"] = "No profils found";

}
// echo result
    echo json_encode($response);
?>