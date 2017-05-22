<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once ('connection.php');
require_once ('userobject.php');
require_once ('functions.php');

$email = $_SESSION['email'];
$user = new User($email, $conn);
$nr_programari = getTotalProgs($user->id, $conn);
$ultima_viz = getLastVisit($user->id, $conn);
?>
