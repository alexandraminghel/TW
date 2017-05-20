<?php  
session_start();
require('connection.php');

$id_detinut = $_GET['id'];

$query = "SELECT count(*) FROM programari where id_detinut like '$id_detinut'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_row($result);
$nr_progs = $row[0];

if ($nr_progs == 0) {
 	$message = "Detinutul nu a avut nici o vizita";
    echo $message;
}

else {
	$limit = 5;
	$pages = ceil($nr_progs / $limit);

	if ( isset($_GET["page"]) ) {
		$page = $_GET["page"];
    	$offset = $limit * ($page - 1);
	} 

	else {
    	$page = 1;
    	$offset = 0;
	}

	$query = "SELECT p.id as \"ID\", d.nume as \"NUME\", d.prenume as \"PRENUME\", p.DATA_VIZITEI, p.NATURA_VIZITEI, p.RELATIA_DETINUT, p.REZUMATUL_DISCUTIEI, p.OBIECTE_ADUSE FROM programari p join users d on p.id_vizitator = d.id where p.id_detinut like '$id_detinut' LIMIT $limit OFFSET $offset";
	mysqli_free_result($result);
	$result = mysqli_query($conn, $query, MYSQLI_USE_RESULT);

	if (! $result) {
    	$message = "Detinutul nu a avut nici o vizita";
    	echo $message;
	}

	else {
		if ($page > 1) {

			if( $page == $pages ) {
        		$last = $page - 1;
                echo "<div class = \"pagination\">";
        		echo "<a href = \"$_SERVER[PHP_SELF]?id=$id_detinut&page=$last\">Inapoi</a>";
                echo "</div>";
     		}

     		else {
        		$last = $page - 1;
        		$page = $page + 1;
        		echo "<div class = \"pagination\">";
        		echo "<a href = \"$_SERVER[PHP_SELF]?id=$id_detinut&page=$last\">Inapoi</a> | ";
        		echo "<a href = \"$_SERVER[PHP_SELF]?id=$id_detinut&page=$page\">Inainte</a>";
        		echo "</div>";
        	}
    	}

    	else if( $page == 1 ) {

    		if ($pages > $page) {
    			$page = $page + 1;
    		}
            echo "<div class = \"pagination\">";
        	echo "<a href = \"$_SERVER[PHP_SELF]?id=$id_detinut&page=$page\">Inainte</a>";
            echo "</div>";
    	}

		echo "<table class = \"vizite\">";
		echo "</br>";
        echo "<th>ID</th><th>Data</th><th>Ora</th><th>Durata</th><th>Nume</th><th>Natura vizitei</th><th>Relatie</th><th id=\"discutie\">Rezumatul discutiei</th><th id=\"obiecte\">Obiecte aduse</th>";
		
		while ($row = $result->fetch_assoc()) {

			echo "<tr><td>".$row['ID']."</td><td>".$row['DATA_VIZITEI']."</td><td>12:00</td><td>20</td><td>".$row['NUME']." ".$row['PRENUME']."</td><td>".$row['NATURA_VIZITEI']."</td><td>".$row['RELATIA_DETINUT']."</td><td>".$row['REZUMATUL_DISCUTIEI']."</td><td>".$row['OBIECTE_ADUSE']."</td></tr>";
		}

		echo "</table>";
	}
}
?>