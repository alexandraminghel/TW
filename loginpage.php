<?php
session_start();
require ('connection.php');
$Email=$_POST["email"];
$Password=$_POST["password"];
$_SESSION['email']=$Email;
	
	if($Email=='admin' && $Password=='admin')
		header('Location:admin.html');
	else
	{
	$sql1="Select * from users where '$Email'=EMAIL";
	$sql2="Select parola from users where '$Email'=EMAIL";
	$result1=mysqli_query($conn,$sql1) or die(mysqli_error($conn));
	$result2=mysqli_query($conn,$sql2) or die(mysqli_error($conn));
	$count1 = mysqli_num_rows($result1);
	$count2 = mysqli_num_rows($result2);
	$row=$result1->fetch_assoc();
	$ceva=$row["PAROLA"];
	$isPasswordCorrect = password_verify($Password, $ceva);

	
	if($count1!=1)
		header('Location:loginpage_error_email.html');
	else
	if ($isPasswordCorrect==1)
	header('Location: newvisit.html');
	else
	header('Location: loginpage_error.html');
	}

?>
