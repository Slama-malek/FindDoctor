<?php

require_once 'config.php';
$conn= mysqli_connect($server,$user,$mp,$database,$port);
 
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
 $DefaultId = 0;
 $x = 0;
 
 $ImageData = $_POST['image_path'];
 $ServerURL="";
 
 //$ImageName = $_POST['image_name'];
 $nom = $_POST['nom_prenom'];
 $usertype = $_POST['usertype'];
 $email = $_POST['email'];
 $mdp = $_POST['mdp'];
 $genre = $_POST['genre'];
 $specialite = $_POST['specialite'];
 $adresse = $_POST['adresse'];
 $tel = $_POST['tel'];
 $bio = $_POST['bio'];
 $emailexist ="SELECT * FROM personne where email='$email' ";
 	$resultuser = mysqli_query($conn, $emailexist)or die(mysqli_error());
		if (mysqli_num_rows($resultuser) > 0) {
			
			 echo "Email déja existe!";
		}
		else{
			

 $GetOldIdSQL ="SELECT id_pers FROM personne ORDER BY id_pers ASC";
 
 $Query = mysqli_query($conn,$GetOldIdSQL);
 
 while($row = mysqli_fetch_array($Query)){
 
 $DefaultId = $row['id_pers'];
 }
 $DefaultId=$DefaultId+1;
 $ImagePath = "images/$DefaultId.png";
 
$ServerURL = "http://192.168.1.250:8282/projetandroid/$ImagePath";
 
  //$InsertSQLuser = "insert into personne (nom_prenom,email,mdp,adresse,genre,telephone,usertype,image_path) values ('$nom','$email','$mdp','$adresse','$genre','$tel','$usertype','$ServerURL')";

 
 
 $InsertSQL = "insert into personne (nom_prenom,email,mdp,adresse,genre,specialite,telephone,bio,usertype,image_path) values ('$nom','$email','$mdp','$adresse','$genre','$specialite','$tel','$bio','$usertype','$ServerURL')";


 if(mysqli_query($conn, $InsertSQL)){

 file_put_contents($ImagePath,base64_decode($ImageData));

 echo "Votre Compte est creé avec succés.";
 }
 
 mysqli_close($conn);
 }
 }
 else{
 echo "Not Uploaded";
 }

?>