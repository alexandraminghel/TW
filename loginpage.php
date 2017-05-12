<?php
session_start();
require ('connection.php');
$Email=$_POST["email"];
$Password=$_POST["password"];
	$sql="Select * from users where '$Email'=EMAIL and '$Password'=PAROLA";
	$sql1="Select * from users where '$Email'=EMAIL";
	$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$result1=mysqli_query($conn,$sql1) or die(mysqli_error($conn));
	$count1 = mysqli_num_rows($result1);
	$count = mysqli_num_rows($result);
	if($count1!=1)
		header('Location:loginpage_error_email.html');
	else
	{
	if ($count== 1)
{
	$_SESSION['email']=$Email;
	header('Location: newvisit.html');
}

else
	header('Location: loginpage_error.html');

}


?>
