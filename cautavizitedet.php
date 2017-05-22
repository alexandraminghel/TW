<?php  
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require('connection.php');
require('detinutobject.php');

$message = "";
$line = 0;
$column = 0;
$rownum = 0;
$rows = array(array());
$last = 1;
$page = 1;

if (! (isset($_GET['id']))) {
    $message = "Detinut inexistent";
    $detinut = new Detinut();
}

else {
    $id_detinut = (int)$_GET['id'];
    $detinut = new Detinut($id_detinut, $conn);

    $query = $conn->prepare('SELECT count(*) as "nr" FROM vizite where id_detinut like ?');
    $query->bind_param('i', $detinut->id);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();
    $nr_progs = $row['nr'];

    if ($nr_progs == 0) {
 	  $message = "Detinutul nu a avut nici o vizita 1";
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

        $query = $conn->prepare('SELECT p.id as "ID", d.nume as "NUME", d.prenume as "PRENUME", p.DATA_VIZITEI, p.NATURA_VIZITEI, p.RELATIA_DETINUT, p.REZUMATUL_DISCUTIEI, p.DURATA, p.OBIECTE_ADUSE, p.OBIECTE_OFERITE, p.ORA FROM vizite p join users d on p.id_vizitator = d.id where p.id_detinut like ? LIMIT ? OFFSET ?');
        $query->bind_param('iii', $detinut->id, $limit, $offset);
        mysqli_free_result($result);
        $query->execute();
        $result = $query->get_result();
	
        if (! $result) {
            $message = "Detinutul nu a avut nici o vizita 1";
        }

	   else {

		  if ($page > 1) {

			if( $page == $pages ) {
        		$last = $page - 1;
     		}

     		else {
        		$last = $page - 1;
        		$page = $page + 1;
        	}
    	}

    	else if( $page == 1 ) {

    		if ($pages > $page) {
    			$page = $page + 1;
    		}

            $last = 1;
    	}

        while ($row = $result->fetch_assoc()) {
            $rows[$rownum][0] = $row['ID'];
            $rows[$rownum][1] = $row['DATA_VIZITEI'];
            $rows[$rownum][2] = $row['ORA'];
            $rows[$rownum][3] = $row['DURATA'];
            $rows[$rownum][4] = $row['NUME']." ".$row['PRENUME'];
            $rows[$rownum][5] = $row['NATURA_VIZITEI'];
            $rows[$rownum][6] = $row['RELATIA_DETINUT'];
            $rows[$rownum][7] = $row['REZUMATUL_DISCUTIEI'];
            $rows[$rownum][8] = $row['OBIECTE_ADUSE'];
            $rows[$rownum][9] = $row['OBIECTE_OFERITE'];
            $rownum++;
        }
		/*echo "<table class = \"vizite\">";
		echo "</br>";
        echo "<th>ID</th><th>Data</th><th>Ora</th><th>Durata</th><th>Nume</th><th>Natura vizitei</th><th>Relatie</th><th id=\"discutie\">Rezumatul discutiei</th><th id=\"obiecte\">Obiecte aduse</th>";*/
		
		/*while ($row = $result->fetch_assoc()) {

			echo "<tr><td>".$row['ID']."</td><td>".$row['DATA_VIZITEI']."</td><td>12:00</td><td>20</td><td>".$row['NUME']." ".$row['PRENUME']."</td><td>".$row['NATURA_VIZITEI']."</td><td>".$row['RELATIA_DETINUT']."</td><td>".$row['REZUMATUL_DISCUTIEI']."</td><td>".$row['OBIECTE_ADUSE']."</td></tr>";
		}*/

	}
}
}
?>