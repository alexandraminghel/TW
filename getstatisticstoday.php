<?php  
require_once('connection.php');

$date_current = date('Y-m-d', time());
$query = $conn->prepare('SELECT count(*) as "nr" from VIZITE where data_vizitei like ?');
$query->bind_param('s', $date_current);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();
$nr_visits = $row['nr'];


?>