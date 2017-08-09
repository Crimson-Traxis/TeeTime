<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	require_once('database.php');

	class login {
		public $userID;
		public $fname;
		public $lname;
		public $email;
		public $phone;
		public $address;
		public $city;
		public $state;
		public $zip;
		public $isAdmin;
		public $password;

		function Logout() {
			try {
				session_destroy();
			} catch(Exception $ex) {
				$result = array( 'result' => false);
				echo json_encode($result);
			}
			$result = array( 'result' => true);
			echo json_encode($result);
		}

		function LoginWithUserPass($user,$pass) {
			
			foreach (Database::prepare('SELECT * FROM `tt_persons` where email = ? and password_hash = ?', array($user,$pass)) as $row) {
				$_SESSION['userID'] = $row['id'];
				$this->userID = $row['id'];
				$this->fname = $row['fname'];
				$this->lname = $row['lname'];
				$this->email = $row['email'];
				$this->phone = $row['phone'];
				$this->address = $row['address'];
				$this->city = $row['city'];
				$this->state = $row['state'];
				$this->zip = $row['zip'];
				$this->isAdmin = $row['isAdmin'];
				$this->password = $row['password_hash'];
			}
			if($this->userID) {
				$result = array('name' => $this->fname . " " . $this->lname, 'result' => true);
				echo json_encode($result);
			} else {
				$result = array( 'result' => false);
				echo json_encode($result);
			}
		}

		function LoginWithSessionVariable() {
			if(isset($_SESSION['userID'])) {
				foreach (Database::prepare('SELECT * FROM `tt_persons` where id = ? ', array($_SESSION['userID'])) as $row) {
					$this->userID = $row['id'];
					$this->fname = $row['fname'];
					$this->lname = $row['lname'];
					$this->email = $row['email'];
					$this->phone = $row['phone'];
					$this->address = $row['address'];
					$this->city = $row['city'];
					$this->state = $row['state'];
					$this->zip = $row['zip'];
					$this->isAdmin = $row['isAdmin'];
					return true;
				}
			}
			else {
				return false;
			}
		}

		function Signup($fname, $lname, $email, $phone, $address, $city, $password, $state, $zip) {
            $this->fname   = $fname;
			$this->lname   = $lname;
            $this->email  = $email;
            $this->phone = $phone;
			$this->address = $address;
			$this->city = $city;
			$this->password = $password;
			$this->state = $state;
			$this->zip = $zip;
			$exists = false;
			foreach (Database::prepare('SELECT *  FROM `tt_persons` where email = ? ', array($email)) as $row) {
				$result = array('message' => 'Email is already taken', 'result' => false);
				echo json_encode($result);
				$exists = true;
			}
			if(!$exists) {
				Database::prepare(
                    "INSERT INTO tt_persons (fname, lname, password_hash, email, phone, address, city, state, zip) VALUES (?,?,?,?,?,?,?,?,?)",
                    array($this->fname, $this->lname, $this->password, $this->email, $this->phone, $this->address, $this->city, $this->state, $this->zip)
                );
				$result = array( 'result' => true);
				echo json_encode($result);
			}
		}
	}

	?>