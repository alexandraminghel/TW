<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();}
require ('connection.php');
$NumePrenume=$_POST['numeprenume'];
$last_space=strrpos($NumePrenume, ' ');
$Prenume=substr($NumePrenume, $last_space);
$Nume=substr($NumePrenume,0, $last_space);
$Prenume=trim($Prenume);


$query = "SELECT count(*) FROM detinuti where NUME='$Nume' and PRENUME='$Prenume'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_row($result);
$nr_det = $row[0];
$message="";



if ($nr_det == 0) {
 	$message = "Nu exista detinutul in baza de date";
     $line=0;
     $rownum=0;
     $last=0;
     $page=0;
     $NumeTabel=" ";
	 $PrenumeTabel=" ";
	 $DataNastereTabel=" ";
	 $DataIncarcerareTabel=" ";
	 $PedeapsaTabel=" ";
	 $CrimaTabel=" ";
     
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

$query="SELECT id as \"ID_DET\", nume as \"NUME\",prenume as \"PRENUME\", datanastere as \"DAT_NAS\",dataincarcerare as \"DATA_INCA\",peadeapsa as \"PEDEAPSA\",crima as \"CRIMA\" from detinuti where  NUME='$Nume' and PRENUME='$Prenume' LIMIT $limit OFFSET $offset";
mysqli_free_result($result);
$result = mysqli_query($conn, $query, MYSQLI_USE_RESULT);


if (! $result) {
    	$message = "Nu aveti inca nici o vizita realizata a";
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
        $DataNastereTabel="Data nastere";
        $DataIncarcerareTabel="Data incarcerare";
        $PedeapsaTabel="Pedeapsa";
        $CrimaTabel="Crima";
       

        $rows = array(array());
        $rownum = 0;
        while ($row = $result->fetch_assoc())
        {
             $id_det=$row['ID_DET'];
             $rows[$rownum][0] = $row['NUME'];
             $rows[$rownum][1] = $row['PRENUME'];
             $rows[$rownum][2] = $row['DAT_NAS'];
             $rows[$rownum][3] = $row['DATA_INCA'];
             $rows[$rownum][4] = $row['PEDEAPSA'];
             $rows[$rownum][5] = $row['CRIMA'];
             $rownum++;


       
        }
        $line = 0;
        $column = 0;

	}
	

}


?>