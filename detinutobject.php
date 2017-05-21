<?php  
class Detinut {
	public $id;
	public $nume;
	public $data_nasterii;
	public $data_incarcerarii;
	public $timp_pedeapsa;

	public function createByID($id1, $conn) {
		$this->id = $id1;

		$query = $conn->prepare('SELECT nume, prenume, DATANASTERE, DATAINCARCERARE, PEADEAPSA FROM detinuti where id like ?');
		$query->bind_param('i', $id1);
		$query->execute();
		$result = $query->get_result();
 
 		if( mysqli_num_rows($result) > 0) {
 			$row = $result->fetch_assoc();
 			$this->nume = $row['nume']." ".$row['prenume'];
 			$this->data_nasterii = $row['DATANASTERE'];
 			$this->data_incarcerarii = $row['DATAINCARCERARE'];
 			$this->timp_pedeapsa = $row['PEADEAPSA'];
 		}

 		else {
 	 		$this->nume ="DETINUT INEXISTENT";
 	 		$this->data_nasterii = "";
 			$this->data_incarcerarii = "";
 			$this->timp_pedeapsa = "";
 		}	
	}

	public function createByName($lastname, $firstname, $conn) {
		$this->nume = $lastname." ".$firstname;

		$query = $conn->prepare('SELECT id, DATANASTERE, DATAINCARCERARE, PEADEAPSA FROM detinuti where nume like ? and prenume like ?');
		$query->bind_param('ss', $lastname, $firstname);
		$query->execute();
		$result = $query->get_result();
 
 		if( mysqli_num_rows($result) > 0) {
 			$row = $result->fetch_assoc();
 			$this->id = $row['id'];
 			$this->data_nasterii = $row['DATANASTERE'];
 			$this->data_incarcerarii = $row['DATAINCARCERARE'];
 			$this->timp_pedeapsa = $row['PEADEAPSA'];
 		}

 		else {
 	 		$this->id = 0;
 	 		$this->data_nasterii = "";
 			$this->data_incarcerarii = "";
 			$this->timp_pedeapsa = "";
 		}	
	}

	public function __construct(...$args1) {
		$nr_args = func_num_args();

		switch ($nr_args) {
			case 0 :
				$this->id = 0;
				$this->nume = "";
				$this->data_nasterii = "";
 				$this->data_incarcerarii = "";
 				$this->timp_pedeapsa = "";
				break;

			case 2 :
				$args = func_get_args();
				$arg = $args[0];
				$conn = $args[1];

				if (gettype($arg) == "integer") {
					$this->createByID($arg, $conn);
				}

				else {
					$this->id = 0;
					$this->nume = "";
					$this->data_nasterii = "";
 					$this->data_incarcerarii = "";
 					$this->timp_pedeapsa = "";
				}
				break;
			case 3 :
				$args = func_get_args();
				$conn = $args[2];

				if (gettype($args[0]) == "string" && gettype($args[1]) == "string") {
					$this->createByName($args[0], $args[1], $conn);
				}

				else {
					$this->id = 0;
					$this->nume = "";
					$this->data_nasterii = "";
 					$this->data_incarcerarii = "";
 					$this->timp_pedeapsa = "";
				}
				break;
			default :
				$this->id = 0;
				$this->nume = "";
				$this->data_nasterii = "";
 				$this->data_incarcerarii = "";
 				$this->timp_pedeapsa = ""; 
				break;
		}
	}
}
?>