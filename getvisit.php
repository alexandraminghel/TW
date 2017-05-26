<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();}
require ('connection.php');
$query = "SELECT count(*) FROM programari";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_row($result);
$nr_progs = $row[0];
$message="";
$NumeVizitator="";
$Detinut="";
if ($nr_progs == 0) {
 	$message = "Nu aveti inca nici o programare de validat.";
    $line=0;
    $last=0;
    $page=0;
    $rownum=0;
    
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

$query="SELECT u.nume as \"NUME_VIZ\",u.prenume as \"PRENUME_VIZ\", d.nume as \"NUME_DET\",d.prenume as \"PRENUME_DET\",p.id as \"ID_VIZ\" from programari p join users u on p.ID_VIZITATOR=u.id join detinuti d on d.id=p.ID_DETINUT  LIMIT $limit OFFSET $offset";
mysqli_free_result($result);
$result = mysqli_query($conn, $query, MYSQLI_USE_RESULT);


if (! $result) {
    	$message = "Nu exista nici o programare momentan";
    	
	}
	else
	{
		if ($page > 1) {

			if( $page == $pages ) {
        		$last = $page - 1;
     		}

     		else {
        		$last = $page - 1;
        		$page = $page + 1;
        		
        	}
    	}
    	else 
    		if( $page == 1 ) {

    		if ($pages > $page) {
    			$page = $page + 1;
    		}


            $last=1;
    	}

        $NumeVizitator="Nume vizitator";
        $Detinut="Detinut";
        $rows = array(array());
        $rownum = 0;

        while ($row = $result->fetch_assoc())
        {
        $id_viz=$row['ID_VIZ'];
            $rows[$rownum][0] = $row['NUME_VIZ']." ".$row['PRENUME_VIZ'];
            $rows[$rownum][1] = $row['NUME_DET']." ".$row['PRENUME_DET'];
            $rownum++;

        }
         $line = 0;
         $column = 0;
	}
	

}
?>