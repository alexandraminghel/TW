<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();}
require ('connection.php');
$NumePrenume=$_POST['numeprenume'];
$last_space=strrpos($NumePrenume, ' ');
$Prenume=substr($NumePrenume, $last_space);
$Nume=substr($NumePrenume,0, $last_space);
$Prenume=trim($Prenume);


$query = "SELECT count(*) FROM users where NUME='$Nume' and PRENUME='$Prenume'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_row($result);
$nr_user = $row[0];
$message="";



if ($nr_user == 0) {
    $message = "Nu exista utilizatorul in baza de date";
     $line=0;
     $rownum=0;
     $last=0;
     $page=0;
     $NumeTabel=" ";
     $PrenumeTabel=" ";
     $EmailTabel=" ";
     $TelefonTabel=" ";
    
     
}
else
 {
    $limit = 2;
    $pages = ceil($nr_user / $limit);

    if ( isset($_GET["page"]) ) {
        $page = $_GET["page"];
        $offset = $limit * ($page - 1);
    } 

    else {
        $page = 1;
        $offset = 0;
    }

$query="SELECT id as \"ID_DET\", nume as \"NUME\",prenume as \"PRENUME\", email as \"EMAIL\",telefon as \"TELEFON\" from users where  NUME='$Nume' and PRENUME='$Prenume' LIMIT $limit OFFSET $offset";
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
        $EmailTabel="Data nastere";
        $TelefonTabel="Data incarcerare";
       
       

        $rows = array(array());
        $rownum = 0;
        while ($row = $result->fetch_assoc())
        {
             $id_det=$row['ID_DET'];
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