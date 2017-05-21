<?php
session_start();
require ('connection.php');
$query = "SELECT count(*) FROM programari";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_row($result);
$nr_progs = $row[0];
if ($nr_progs == 0) {
 	$message = "Nu aveti inca nici o programare de validat.";
    echo $message;
}
else
 {
	$limit = 3;
	$pages = ceil($nr_progs / $limit);

	if ( isset($_GET["page"]) ) {
		$page = $_GET["page"];
    	$offset = $limit * ($page - 1);
	} 

	else {
    	$page = 1;
    	$offset = 0;
	}

$query="SELECT u.nume as \"NUME_VIZ\",u.prenume as \"PRENUME_VIZ\", d.nume as \"NUME_DET\",d.prenume as \"PRENUME_DET\",u.id as \"ID_VIZ\" from programari p join users u on p.ID_VIZITATOR=u.id join detinuti d on d.id=p.ID_DETINUT  LIMIT $limit OFFSET $offset";
mysqli_free_result($result);
$result = mysqli_query($conn, $query, MYSQLI_USE_RESULT);


if (! $result) {
    	$message = "Nu aveti inca nici o vizita realizata";
    	echo "<div class=\"nici\">";
    	echo $message;
    	echo "<div/>";
	}
	else
	{
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
    	else 
    		if( $page == 1 ) {

    		if ($pages > $page) {
    			$page = $page + 1;
    		}


            echo "<div class = \"pagination\">";
        	echo "<a href = \"$_SERVER[PHP_SELF]?page=$page\">Inainte</a>";
            echo "</div>";
    	}

    	echo "<table class = \"info\">";
		echo "</br>";
        echo "<tr class=\"primul\"><td>Nume vizitator</td><td>Detinut</td>";

       


        while ($row = $result->fetch_assoc())
        {
        $id_viz=$row['ID_VIZ'];
		echo "<tr><td><a href=\"addvisit.php?id=$id_viz\">".$row['NUME_VIZ']." ".$row['PRENUME_VIZ']."</td><td>".$row['NUME_DET']." ".$row['PRENUME_DET']."</td>";

        }

	}
	echo "</table>";

}
?>