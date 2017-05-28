<?php  
require_once('connection.php');
require_once('userobject.php');
require_once('detinutobject.php');

$id = (int)$_GET['id'];
$query = $conn->prepare('SELECT * FROM programari WHERE ID = ?');
$query->bind_param('i', $id);
$query->execute();

$result = $query->get_result();
$row = $result->fetch_assoc();

$user = new User($row['ID_VIZITATOR'], $conn);
$detinut = new Detinut($row['ID_DETINUT'], $conn);

$name = "viz".$id;
$start_prog = strtotime("09:00:00");
$end_prog = strtotime("17:00:00");
$dif_ora = 60*60*3;
$data_viz = strtotime($row['DATA_VIZITEI']);
$locatie = "Penitenciar";
$start = date('Ymd', $data_viz).'T'.date('His', $start_prog - $dif_ora).'Z';
$end = date('Ymd', $data_viz).'T'.date('His', $end_prog - $dif_ora).'Z';
$description = "Vizitator: ".$user->nume."\\nDetinut: ".$detinut->nume."\\nObiecte aduse: ".$row['OBIECTE_ADUSE']."\\nRezumatul discutiei: ".$row['REZUMATUL_DISCUTIEI'];
header("Content-Type: text/Calendar; charset=utf-8; method=REQUEST");
header("Content-Disposition: inline; filename={$name}.ics");
echo "BEGIN:VCALENDAR\n";
echo "VERSION:2.0\n";
echo "PRODID:{$name}\n";
echo "METHOD:REQUEST\n"; 
echo "BEGIN:VEVENT\n";
echo "UID:{$name}\n"; 
echo "DTSTAMP:".date('Ymd').'T'.date('His')."\n"; 
echo "LOCATION:{$locatie}\n";
echo "DTSTART:{$start}\n";
echo "DTEND:{$end}\n";
echo "SUMMARY:{$name}\n";
echo "DESCRIPTION: {$description}\n";
echo "END:VEVENT\n";
echo "END:VCALENDAR\n";
