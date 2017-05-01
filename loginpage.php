<?php
session_start();

if(isset($_POST['buton-login']))
{
	require ('connection.php');
	$Nume=$_POST["username"];
	$Password=$_POST["password"];
	$sql="Select * from users where '$Nume'=Nume and '$Password'=Parola";
	$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$count = mysqli_num_rows($result);
	if ($count== 1)
{
	$_SESSION['username']=$Nume;
	header('Location: newvisit.php');
}

else
	header('Location: loginpage_error.php');


}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="loginpagestyle.css">
	
</head>
<body>


	<!--<button class="butoane1">Creare cont</button>
	<button class="butoane2">Date de contact</button>-->

</div>
<form method="post" action="">
<div class="wrap" >

	<h2>
		Login 
	</h2>
	<input type="text" name="username" placeholder="Your username">
	<input type="password" name="password" placeholder="Your password">
	<button class="btn-login" name="buton-login">Login</button>
	<button class="btn-c"> <a href="createaccount.html">Creare cont</a></button>
</div>
</form>
<div class="detalii">Vrei sa afli mai multe detalii? Apasa <a href="Harta.html"><ins>aici</ins></a> .</div>



</body>
</html>