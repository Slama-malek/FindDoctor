<?php
require_once 'config.php';
$con= mysqli_connect($server,$user,$mp,$database,$port);
$reqSel = "SELECT * FROM personne WHERE (email = '".$_GET["email"]."' AND mdp = '".$_GET["mdp"]."')";
$reqSeluser = "SELECT * FROM user WHERE (email_user = '".$_GET["email"]."' AND mdp_user = '".$_GET["mdp"]."')";
		 	$result = mysqli_query($con,$reqSel)or die(mysqli_error());
			
			$resultuser = mysqli_query($con,$reqSeluser)or die(mysqli_error());
		if (mysqli_num_rows($result) > 0) {
	 // success
    $response["success"] = 1;
	
	//$response["message"] = "medecin";

    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $un_medecin = array();
		$un_medecin["id_pers"] = $row["id_pers"];
        $un_medecin["nom_prenom"] = $row["nom_prenom"];
        
       
		$un_medecin["email"] = $row["email"];
		
		$un_medecin["genre"] = $row["genre"];
		$un_medecin["usertype"] = $row["usertype"];
		$un_medecin["telephone"] = $row["telephone"];
		
        // push single un_profil into final response array
        //array_push($response["medecin"], $un_medecin);
		$response["medecin"]= $un_medecin;
    }
	
    
    
} 
else{
	 $response["success"] = 0;
    $response["message"] = "Acces Rufuse";
	
}

		 	

echo json_encode($response);

?>