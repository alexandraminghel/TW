<?php  
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
    $line = 0;
    $column = 0;
    $rownum = 0;
    $rows = array(array());
    $page = 1;
    $last = 1;
 	$message = "Nu aveti inca nici o programare realizata.";
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

	$query = $conn->prepare('SELECT p.id as "ID", d.nume as "NUME", d.prenume as "PRENUME", p.DATA_VIZITEI, p.NATURA_VIZITEI, p.RELATIA_DETINUT FROM programari p join detinuti d on p.id_detinut = d.id where p.id_vizitator like ? LIMIT ? OFFSET ?');
	mysqli_free_result($result);
    $query->bind_param('iii', $user->id, $limit, $offset);
    $query->execute();
    $result = $query->get_result();

	if (mysqli_num_rows($result) == 0) {
    	$message = "Nu aveti inca nici o programare realizata";
    	echo $message;
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

        $rows = array(array());
        $rownum = 0;
        while ($row = $result->fetch_assoc()) {
            $rows[$rownum][0] = $row['ID'];
            $rows[$rownum][1] = $row['DATA_VIZITEI'];
            $rows[$rownum][2] = $row['NUME'];
            $rows[$rownum][3] = $row['PRENUME'];
            $rows[$rownum][4] = $row['NATURA_VIZITEI'];
            $rows[$rownum][5] = $row['RELATIA_DETINUT'];
            $rownum++;
        }

        $line = 0;
        $column = 0;
	}
}
?>