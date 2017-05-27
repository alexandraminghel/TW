<?php  
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ( $_SESSION['type'] != 'admin') {
    header("Location: logout.php");
}
?>