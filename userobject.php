<?php  
class User {
	public $id;
	public $nume;
	public $email;
	public $poza;

	public function createByEmail($email1, $conn){
		$this->email = $email1;

		$query = $conn->prepare('SELECT id, nume, prenume, poza FROM users where email like ?');
		$query->bind_param('s', $email1);
		$query->execute();
		$result = $query->get_result();
 
 		if( mysqli_num_rows($result) > 0) {
 			$row = $result->fetch_assoc();
 			$this->nume = $row['nume']." ".$row['prenume'];
 			$this->id = $row['id'];
 			$this->poza = $row['poza'];
 		}

 		else {
 	 		$this->nume ="USER INEXISTENT";
 	 		$this->id = 0;
 	 		$this->poza = "";
 		}	
	}

	public function createByID($id1, $conn) {
		$this->id = $id1;

		$query = $conn->prepare('SELECT email, nume, prenume, poza FROM users where id like ?');
		$query->bind_param('i', $id1);
		$query->execute();
		$result = $query->get_result();
 
 		if( mysqli_num_rows($result) > 0) {
 			$row = $result->fetch_assoc();
 			$this->nume = $row['nume']." ".$row['prenume'];
 			$this->email = $row['email'];
 			$this->poza = $row['poza'];
 		}

 		else {
 	 		$this->nume ="USER INEXISTENT";
 	 		$this->email = "";
 	 		$this->poza = "";
 		}	
	}

	public function createByName($lastname, $firstname, $conn) {
		$this->nume = $lastname." ".$firstname;

		$query = $conn->prepare('SELECT email, id, poza FROM users where nume like ? and prenume like ?');
		$query->bind_param('ss', $lastname, $firstname);
		$query->execute();
		$result = $query->get_result();
 
 		if( mysqli_num_rows($result) > 0) {
 			$row = $result->fetch_assoc();
 			$this->id = $row['id'];
 			$this->email = $row['email'];
 			$this->poza = $row['poza'];
 		}

 		else {
 	 		$this->id = 0;
 	 		$this->email = "";
 	 		$this->poza = "";
 		}	
	}

	public function __construct(...$args1) {
		$nr_args = func_num_args();

		switch ($nr_args) {
			case 0 :
				$this->id = 0;
				$this->nume = "";
				$this->email = "";
				$this->poza = "";
				break;

			case 2 :
				$args = func_get_args();
				$arg = $args[0];
				$conn = $args[1];

				if (gettype($arg) == "string") {
					$this->createByEmail($arg, $conn);
				}

				else  if (gettype($arg) == "integer") {
					$this->createByID($arg, $conn);
				}

				else {
					$this->id = 0;
					$this->nume = "";
					$this->email = "";
					$this->poza = "";
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
					$this->email = "";
					$this->poza = "";
				}
				break;
			default :
				$this->id = 0;
				$this->nume = "";
				$this->email = "";
				$this->poza = ""; 
				break;
		}
	}
}
?>