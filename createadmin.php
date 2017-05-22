<?php

require ('connection.php');

$Nume="admin";
$Prenume="admin";
$Email="admin";
$Parola1="admin";
$Parola2="admin";
$Telefon=NULL;

$Poza="poze/admin.png";

$Parola_securizata=password_hash($Parola1,PASSWORD_DEFAULT);
$sql="insert into users(NUME,PRENUME,EMAIL,PAROLA,TELEFON,POZA) values ('$Nume', '$Prenume','$Email','$Parola_securizata','$Telefon','$Poza')";


$result=mysqli_query($conn, $sql);


?>