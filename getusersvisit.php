<?php  
session_start();
require_once ('connection.php');
require_once ('userobject.php');
require_once ('detinutobject.php');

$email = $_SESSION['email'];
$message = "";
$user = new User($email, $conn);

$query = $conn->prepare('SELECT count(*) as "nr" FROM programari where id_vizitator like ?');
$query->bind_param('i', $user->id);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();
$nr_progs = $row['nr'];

if ($nr_progs == 0) {
 	$message = "Nu aveti inca nici o vizita realizata.";
    echo $message;
}
else {
	$limit = 2;
	$pages = ceil($nr_progs / $limit);

	if ( isset($_GET["page"]) ) {
		$page = $_GET["page"];
    	$offset = $limit * ($page - 1);
	} 

	else {
    	$page = 1;
    	$offset = 0;
	}

	$query = $conn->prepare('SELECT p.id as "ID", d.nume as "NUME", d.prenume as "PRENUME", p.DATA_VIZITEI, p.NATURA_VIZITEI, p.RELATIA_DETINUT FROM vizite p join detinuti d on p.id_detinut = d.id where p.id_vizitator like ? LIMIT ? OFFSET ?');
	mysqli_free_result($result);
    $query->bind_param('iii', $user->id, $limit, $offset);
    $query->execute();
    $result = $query->get_result();

	if (mysqli_num_rows($result) == 0) {
    	$message = "Nu aveti inca nici o vizita realizata";
    	echo $message;
	}

	else {
		if ($page > 1) {

			if( $page == $pages ) {
        		$last = $page - 1;
                echo "<div class = \"pagination\">";
        		echo "<a href = \"$_SERVER[PHP_SELF]?page=$last\">Inapoi</a>";
                echo "</div>";
     		}

     		else {
        		$last = $page - 1;
        		$page = $page + 1;
        		echo "<div class = \"pagination\">";
        		echo "<a href = \"$_SERVER[PHP_SELF]?page=$last\">Inapoi</a> | ";
        		echo "<a href = \"$_SERVER[PHP_SELF]?page=$page\">Inainte</a>";
        		echo "</div>";
        	}
    	}

    	else if( $page == 1 ) {

    		if ($pages > $page) {
    			$page = $page + 1;
    		}
            echo "<div class = \"pagination\">";
        	echo "<a href = \"$_SERVER[PHP_SELF]?page=$page\">Inainte</a>";
            echo "</div>";
    	}

		echo "<table class = \"vizite\">";
		echo "</br>";
        echo "<th><td>ID</td><td>Data</td><td>Ora</td><td>Nume detinut</td><td>Prenume detinut</td><td>Natura vizitei</td><td>Relatia cu detinutul</td></th>";
		
		while ($row = $result->fetch_assoc()) {

			echo "<tr><td>".$row['ID']."</td><td>".$row['DATA_VIZITEI']."</td><td>12:00</td><td>".$row['NUME']."</td><td>".$row['PRENUME']."</td><td>".$row['NATURA_VIZITEI']."</td><td>".$row['RELATIA_DETINUT']."</td></tr>";
		}

		echo "</table>";
	}
}
?>