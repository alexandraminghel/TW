<?php
session_start();
require ('connection.php');

$Nume=$_POST["nume"];
$Prenume=$_POST["prenume"];
$Email=$_POST["email"];
$Parola1=$_POST["parola1"];
$Parola2=$_POST["parola2"];
$Telefon=$_POST["telefon"];





$sql_cauta_email="select * from users where '$Email'=EMAIL";
$result=mysqli_query($conn,$sql_cauta_email) or die(mysqli_error($conn));
$count= mysqli_num_rows($result);


if($Parola1==$Parola2 && $count==0 && filter_var($Email, FILTER_VALIDATE_EMAIL) && preg_match("/^0[0-9]{9}$/", $Telefon))
{
$Parola_securizata=password_hash($Parola1,PASSWORD_DEFAULT);
$dir="poze/";
$info = pathinfo($_FILES['poza']['name']);
$ext = $info['extension'];
$newname = $Email.'.'.$ext; 
$uploadfile = $dir.$newname;
move_uploaded_file($_FILES['poza']['tmp_name'], $uploadfile);
$sql="insert into users(NUME,PRENUME,EMAIL,PAROLA,TELEFON,POZA) values ('$Nume', '$Prenume','$Email','$Parola_securizata','$Telefon','$uploadfile')";



if(mysqli_query($conn, $sql)){
    header('Location:loginpage.html');
} 
}
else
	if($Parola1!=$Parola2)
	header('Location:createaccount_error_parole.html');
	else
		if($count==1)
		header('Location:createaccount_error_email.html');
	else
		if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) 
 	header('Location:createaccount_error_emailvalid.html');
 	else
 		if(!preg_match("/^0[0-9]{9}$/", $Telefon))
 			header('Location:createaccount_error_phonevalid.html')

?>