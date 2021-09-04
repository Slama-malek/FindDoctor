<?php

require_once 'config.php';
$conn= mysqli_connect($server,$user,$mp,$database,$port);
 
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
	 
 $DefaultId = 0;
 
 $ImageData = $_POST['image_path'];
 
 
 $nom = $_POST['nom_prenom'];
 $email = $_POST['email'];
 $mdp = $_POST['mdp'];
 

 $adresse = $_POST['adresse'];
 $tel = $_POST['tel'];
 $emailexist ="SELECT * FROM user where email_user='$email' ";
 	$resultuser = mysqli_query($conn, $emailexist)or die(mysqli_error());
		if (mysqli_num_rows($resultuser) > 0) {
			
			 echo "Email déja existe!";
		}
		else{

 

 $GetOldIdSQL ="SELECT id_user FROM user ORDER BY id_user ASC";
 
 $Query = mysqli_query($conn,$GetOldIdSQL);
 
 while($row = mysqli_fetch_array($Query)){
 
 $DefaultId = $row['id_user'];
 }
 $DefaultId = $DefaultId+1;
 
 $ImagePath = "imagesuser/$DefaultId.png";
 
 $ServerURL = "http://192.168.1.250:8282/projetandroid/$ImagePath";
 
 $InsertSQL = "insert into user (nom_prenomuser,tel_user,adresse_user,email_user,mdp_user,image_path) values ('$nom','$tel','$adresse','$email','$mdp','$ServerURL')";
 
 if(mysqli_query($conn, $InsertSQL)){

 file_put_contents($ImagePath,base64_decode($ImageData));

 echo "Votre Compte est creé avec succés.";
 }
 
 mysqli_close($conn);
 }}
 else{
 echo "Not Uploaded";
 }

?>