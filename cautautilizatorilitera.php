<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$litera=$_GET['litera'];
require ('connection.php');
$query = "SELECT count(*) FROM users where nume like '$litera%'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_row($result);
$nr_det = $row[0];

$message="";
$NumeTabel="";
$PrenumeTabel="";
$EmailTabel="";
$TelefonTabel="";
if ($nr_det == 0) {
 	$message = "Nu exista detinuti in baza de date";
     $line=0;
     $rownum=0;
     $last=0;
     $page=0;
     $NumeTabel="";
	 $PrenumeTabel="";
	 $EmailTabel="";
	 $TelefonTabel="";
     
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

$query="SELECT id as \"ID_USER\", nume as \"NUME\",prenume as \"PRENUME\", email as \"EMAIL\",telefon as \"TELEFON\" from users where nume like '$litera%' LIMIT $limit OFFSET $offset";
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
            $last = 1;

    	}

    	
        $NumeTabel="Nume";
        $PrenumeTabel="Prenume";
        $EmailTabel="Email";
        $TelefonTabel="Numar telefon";
       
       

        $rows = array(array());
        $rownum = 0;
        while ($row = $result->fetch_assoc())
        {
             $id_det=$row['ID_USER'];
             $rows[$rownum][0] = $row['NUME'];
             $rows[$rownum][1] = $row['PRENUME'];
             $rows[$rownum][2] = $row['EMAIL'];
             $rows[$rownum][3] = $row['TELEFON'];
             $rownum++;


       
        }
        $line = 0;
        $column = 0;

	}
	

}


?>