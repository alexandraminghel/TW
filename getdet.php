<?php
session_start();
require ('connection.php');
$query = "SELECT count(*) FROM detinuti";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_row($result);
$nr_det = $row[0];
if ($nr_det == 0) {
 	$message = "Nu exista detinuti in baza de date";
    echo $message;
}
else
 {
	$limit = 2;
	$pages = ceil($nr_det / $limit);

	if ( isset($_GET["page"]) ) {
		$page = $_GET["page"];
    	$offset = $limit * ($page - 1);
	} 

	else {
    	$page = 1;
    	$offset = 0;
	}

$query="SELECT nume as \"NUME\",prenume as \"PRENUME\", datanastere as \"DAT_NAS\",dataincarcerare as \"DATA_INCA\",peadeapsa as \"PEDEAPSA\",crima as \"CRIMA\" from detinuti LIMIT $limit OFFSET $offset";
mysqli_free_result($result);
$result = mysqli_query($conn, $query, MYSQLI_USE_RESULT);


if (! $result) {
    	$message = "Nu aveti inca nici o vizita realizata aaaaaaaaaaaaaaaaa";
    	//echo "<div class=\"nici\">";
    	echo $message;
    	//echo "<div/>";
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
        echo "<tr class=\"primul\"><td>Nume</td><td>Prenume</td><td>Data nastere</td><td>Data incarcerare</td><td>Pedeapsa</td><td>Crima</td></tr>";

       


        while ($row = $result->fetch_assoc())
        {
        //$id_viz=$row['ID_VIZ'];
		echo "<tr><td>".$row['NUME']."</td><td>".$row['PRENUME']."</td><td>".$row['DAT_NAS']."</td><td>".$row['DATA_INCA']."</td><td>".$row['PEDEAPSA']."</td><td>".$row['CRIMA']."</td></tr>";

        }

	}
	echo "</table>";

}
?>