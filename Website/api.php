<?php	
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	require_once("php/database.php");

	
		if(isset($_GET['table'])) {
			if ($_GET['table'] == "courses") 
			{
				if($_GET['id']) {
					$rec = [];
					foreach (Database::prepare('SELECT * FROM tt_courses WHERE id = ?', array($_GET['id'])) as $row) {
						$rec[] = $row;
					}
					echo json_encode($rec);
				}
			}
			else if($_GET['table'] == "rounds") {
				if($_GET['id']) {
					$rec = [];
					foreach (Database::prepare('SELECT * FROM tt_rounds WHERE id = ?', array($_GET['id'])) as $row) {
						$rec[] = $row;
					}
					echo json_encode($rec);
				}
			}
			else if($_GET['table'] == "persons") {
				if($_GET['id']) {
					$rec = [];
					foreach (Database::prepare('SELECT * FROM tt_persons WHERE id = ?', array($_GET['id'])) as $row) {
						$rec[] = $row;
					}
					echo json_encode($rec);
				}
			}
		}
		else {
			$rec = [];
		    foreach (Database::prepare('SELECT * FROM tt_courses', array()) as $row) {
				$rec[] = $row;
			}
			$rec2 = [];
		    foreach (Database::prepare('SELECT * FROM tt_rounds', array()) as $row) {
				$rec2[] = $row;
			}
			$rec3 = [];
		    foreach (Database::prepare('SELECT * FROM tt_persons', array()) as $row) {
				$rec3[] = $row;
			}
			echo json_encode($rec);
			echo json_encode($rec2);
			echo json_encode($rec3);
		}
?>