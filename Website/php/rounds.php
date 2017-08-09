<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
    require_once("../php/database.php");
    require_once("../php/table.php");
    
    class Rounds implements Table {
        // DATA MEMBERS
        private $id;
        private $course_id;
		private $person_id;
		private $strokes01;
		private $strokes02;
		private $strokes03;
		private $strokes04;
		private $strokes05;
		private $strokes06;
		private $strokes07;
		private $strokes08;
		private $strokes09;
		private $strokes10;
		private $strokes11;
		private $strokes12;
		private $strokes13;
		private $strokes14;
		private $strokes15;
		private $strokes16;
		private $strokes17;
		private $strokes18;
		private $teedate;
		private $teetime;
		private $errMessage;

        // CONSTRUCTOR
        function __construct($id, $course_id, $person_id, $strokes01, $strokes02, $strokes03, $strokes04, $strokes05, $strokes06, $strokes07, $strokes08, $strokes09, $strokes10, $strokes11, $strokes12, $strokes13, $strokes14, $strokes15, $strokes16, $strokes17, $strokes18, $teedate, $teetime) {

			$this->id=$id;
			$this->course_id=$course_id; 
			$this->person_id=$person_id; 
			$this->strokes01=$strokes01;
			$this->strokes02=$strokes02;
			$this->strokes03=$strokes03; 
			$this->strokes04=$strokes04; 
			$this->strokes05=$strokes05; 
			$this->strokes06=$strokes06; 
			$this->strokes07=$strokes07; 
			$this->strokes08=$strokes08; 
			$this->strokes09=$strokes09; 
			$this->strokes10=$strokes10; 
			$this->strokes11=$strokes11; 
			$this->strokes12=$strokes12; 
			$this->strokes13=$strokes13; 
			$this->strokes14=$strokes14; 
			$this->strokes15=$strokes15; 
			$this->strokes16=$strokes16; 
			$this->strokes17=$strokes17; 
			$this->strokes18=$strokes18; 
			$this->teedate=$teedate; 
			$this->teetime=$teetime; 
        }
    
        // Display a table containing details about every record in the database.
        public function displayListScreen() {
            echo "
                <div class='container-fluid'>
                    <div class='col-xs-12'>
                        <!-- Page Heading -->
						<div class='row'>
							<div class='col-lg-12'>
								<h1 class='page-header'>
									Rounds <small>TeeTime Rounds</small>
								</h1>
							</div>
						</div>
                        <div class='row'>
							<div class='col-xs-12'>
								<a class='btn btn-primary' style='width:125px;margin-bottom:20px;' onclick='roundsRequest(\"displayCreate\")'>Add Round</a>
								<table style='width:100%;' class='table table-hover table-striped'>
									<thead>
										<tr>
											<th>Name</th>
											<th>Course</th>
											<th>TeeTime</th>
											<th>Score</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>";                                    
           foreach (Database::prepare('SELECT CONCAT(persons.fname," ",persons.lname) as name, rounds.teetime as time, course.name as coursename, persons.email as email, persons.phone as phone, rounds.id as r_id, strokes01+strokes02+strokes03+strokes04+strokes05+strokes06+strokes07+strokes08+strokes09+strokes10+strokes11+strokes12+strokes13+strokes14+strokes15+strokes16+strokes17+strokes18 AS TotalSum FROM `tt_rounds` as rounds Left Join tt_persons as persons on rounds.person_id = persons.id Left join tt_courses as course on course.id = rounds.course_id', array()) as $row) {
                echo "
                    <tr>
                        <td>{$row['name'] } </td>
                        <td>{$row['coursename'] }</td>
                        <td>{$row['time']}</td>
						<td>{$row['TotalSum']}</td>
                        <td>
							<table>
								<tr>
									<td><button class='btn btn-primary' style='margin:5px;' onclick='roundsRequest(\"displayRead\", {$row['r_id']})'>Read</button></td>
									<td><button class='btn btn-success' style='margin:5px;' onclick='roundsRequest(\"displayUpdate\", {$row['r_id']})'>Update</button></td>
									<td><button class='btn btn-danger' style='margin:5px;' onclick='roundsRequest(\"displayDelete\", {$row['r_id']})'>Delete</button></td>
								</tr>
							</table>
                        </td>
                    </tr>";
            }
            echo "</tbody></table></div></div></div></div>";
        }

		public function displayListScreenUser() {
            echo "
                <div class='container-fluid'>
                    <div class='col-xs-12'>
                        <!-- Page Heading -->
						<div class='row'>
							<div class='col-lg-12'>
								<h1 class='page-header'>
									Rounds <small>TeeTime Rounds</small>
								</h1>
							</div>
						</div>
                        <div class='row'>
							<div class='col-xs-12'>
								<a class='btn btn-primary' style='width:125px;margin-bottom:20px;' onclick='roundsRequest(\"displayCreateUser\")'>Add Round</a>
								<table style='width:100%;' class='table table-hover table-striped'>
									<thead>
										<tr>
											<th>Name</th>
											<th>Course</th>
											<th>TeeTime</th>
											<th>Score</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>";                                    
           foreach (Database::prepare('SELECT CONCAT(persons.fname," ",persons.lname) as name, rounds.teetime as time, course.name as coursename, persons.email as email, persons.phone as phone, rounds.id as r_id, strokes01+strokes02+strokes03+strokes04+strokes05+strokes06+strokes07+strokes08+strokes09+strokes10+strokes11+strokes12+strokes13+strokes14+strokes15+strokes16+strokes17+strokes18 AS TotalSum FROM `tt_rounds` as rounds Left Join tt_persons as persons on rounds.person_id = persons.id Left join tt_courses as course on course.id = rounds.course_id where persons.id = ?', array($_SESSION['userID'])) as $row) {
                echo "
                    <tr>
                        <td>{$row['name'] } </td>
                        <td>{$row['coursename'] }</td>
                        <td>{$row['time']}</td>
						<td>{$row['TotalSum']}</td>
                        <td>
							<table>
								<tr>
									<td><button class='btn btn-primary' style='margin:5px;' onclick='roundsRequest(\"displayReadUser\", {$row['r_id']})'>Read</button></td>
									<td><button class='btn btn-success' style='margin:5px;' onclick='roundsRequest(\"displayUpdateUser\", {$row['r_id']})'>Update</button></td>
									<td><button class='btn btn-danger' style='margin:5px;' onclick='roundsRequest(\"displayDeleteUser\", {$row['r_id']})'>Delete</button></td>
								</tr>
							</table>
                        </td>
                    </tr>";
            }
            echo "</tbody></table></div></div></div></div>";
        } 
        
        // Display a form for adding a record to the database.
        public function displayCreateScreen() {
				echo "
                <div class='container-fluid'>
                    <div class='col-xs-12'>
                        <!-- Page Heading -->
						<div class='row'>
							<div class='col-lg-12'>
								<h1 class='page-header'>
									Create Round <small>TeeTime Rounds</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Course</span>
									<select id='course_id' class='form-control' style='width:auto;'>";

									foreach (Database::prepare('SELECT * from tt_courses order by name asc', array()) as $row) {
										echo "<option value='{$row['id'] }'>{$row['name'] }</option>";
									}

							echo "</select>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Person</span>
									<select id='person_id' class='form-control' style='width:auto;'>";

									foreach (Database::prepare('SELECT * from tt_persons order by fname asc', array()) as $row) {
										echo "<option value='{$row['id'] }'>{$row['fname']} {$row['lname'] }</option>";
									}

							echo "</select>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Tee Date</span>
									<input id='teedate' type='text' value='" . date('m/d/Y') . "' class='form-control date' style='width:175px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Tee Time</span>
									<input id='teetime' type='text' class='form-control time' style='width:175px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 1</span>
									<input id='strokes01' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 2</span>
									<input id='strokes02' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 3</span>
									<input id='strokes03' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 4</span>
									<input id='strokes04' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 5</span>
									<input id='strokes05' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 6</span>
									<input id='strokes06' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 7</span>
									<input id='strokes07' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 8</span>
									<input id='strokes08' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 9</span>
									<input id='strokes09' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 10</span>
									<input id='strokes10' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 11</span>
									<input id='strokes11' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 12</span>
									<input id='strokes12' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 13</span>
									<input id='strokes13' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 14</span>
									<input id='strokes14' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 15</span>
									<input id='strokes15' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 16</span>
									<input id='strokes16' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 17</span>
									<input id='strokes17' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 18</span>
									<input id='strokes18' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div style='color:red;'>"
								. $this->errMessage .
								"</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<button class='btn btn-success' onclick='roundsRequest(\"createRecord\")'>Create</button>
								<a class='btn btn-default' onclick='roundsRequest(\"displayList\")'>Back</a>
							</div>
						</div>
                    </div>
                </div>";
        }

		public function displayCreateScreenUser() {
            echo "
                <div class='container-fluid'>
                    <div class='col-xs-12'>
                        <!-- Page Heading -->
						<div class='row'>
							<div class='col-lg-12'>
								<h1 class='page-header'>
									Create Round <small>TeeTime Rounds</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Course</span>
									<select id='course_id' class='form-control' style='width:auto;'>";

									foreach (Database::prepare('SELECT * from tt_courses order by name asc', array()) as $row) {
										echo "<option value='{$row['id'] }'>{$row['name'] }</option>";
									}

							echo "</select>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Tee Date</span>
									<input id='teedate' type='text' value='" . date('m/d/Y') . "' class='form-control date' style='width:175px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Tee Time</span>
									<input id='teetime' type='text' class='form-control time' style='width:175px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 1</span>
									<input id='strokes01' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 2</span>
									<input id='strokes02' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 3</span>
									<input id='strokes03' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 4</span>
									<input id='strokes04' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 5</span>
									<input id='strokes05' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 6</span>
									<input id='strokes06' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 7</span>
									<input id='strokes07' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 8</span>
									<input id='strokes08' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 9</span>
									<input id='strokes09' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 10</span>
									<input id='strokes10' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 11</span>
									<input id='strokes11' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 12</span>
									<input id='strokes12' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 13</span>
									<input id='strokes13' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 14</span>
									<input id='strokes14' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 15</span>
									<input id='strokes15' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 16</span>
									<input id='strokes16' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 17</span>
									<input id='strokes17' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 18</span>
									<input id='strokes18' type='text' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div style='color:red;'>"
								. $this->errMessage .
								"</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<button class='btn btn-success' onclick='roundsRequest(\"createRecordUser\")'>Create</button>
								<a class='btn btn-default' onclick='roundsRequest(\"displayListUser\")'>Back</a>
							</div>
						</div>
                    </div>
                </div>";
        }
        
        // Adds a record to the database.
        public function createRecord() {
            if ($this->validate()) {
                Database::prepare(
                    "INSERT INTO tt_rounds (course_id, person_id, strokes01, strokes02, strokes03, strokes04, strokes05, strokes06, strokes07, strokes08, strokes09, strokes10, strokes11, strokes12, strokes13, strokes14, strokes15, strokes16, strokes17, strokes18, teedate, teetime) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                    array($this->course_id, $this->person_id, $this->strokes01, $this->strokes02, $this->strokes03, $this->strokes04, $this->strokes05, $this->strokes06, $this->strokes07, $this->strokes08, $this->strokes09, $this->strokes10, $this->strokes11, $this->strokes12, $this->strokes13, $this->strokes14, $this->strokes15, $this->strokes16, $this->strokes17, $this->strokes18, $this->teedate, $this->teetime)
                );
                $this->displayListScreen();
            } else {
                $this->displayCreateScreen();
            }
        }

		public function createRecordUser() {
            if ($this->validate()) {
                Database::prepare(
                    "INSERT INTO tt_rounds (course_id, person_id, strokes01, strokes02, strokes03, strokes04, strokes05, strokes06, strokes07, strokes08, strokes09, strokes10, strokes11, strokes12, strokes13, strokes14, strokes15, strokes16, strokes17, strokes18, teedate, teetime) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                    array($this->course_id, $_SESSION['userID'], $this->strokes01, $this->strokes02, $this->strokes03, $this->strokes04, $this->strokes05, $this->strokes06, $this->strokes07, $this->strokes08, $this->strokes09, $this->strokes10, $this->strokes11, $this->strokes12, $this->strokes13, $this->strokes14, $this->strokes15, $this->strokes16, $this->strokes17, $this->strokes18, $this->teedate, $this->teetime)
                );
                $this->displayListScreenUser();
            } else {
                $this->displayCreateScreenUser();
            }
        }
        
        // Display a form containing information about a specified record in the database.
        public function displayReadScreen() {
            $rec = Database::prepare(
                "SELECT * FROM tt_rounds WHERE id = ?", 
                array($this->id)
            )->fetch(PDO::FETCH_ASSOC);
            echo "
                <div class='container-fluid'>
                    <div class='col-xs-12'>
                        <!-- Page Heading -->
						<div class='row'>
							<div class='col-lg-12'>
								<h1 class='page-header'>
									Rounds Details <small>TeeTime Rounds</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='form-horizontal'>
									<div class='control-group'>
										<label class='control-label'>Course ID:&nbsp;</label>
												{$rec['course_id']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Person ID:&nbsp;</label>
												{$rec['person_id']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 1 strokes:&nbsp;</label>
												{$rec['strokes01']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 2 strokes:&nbsp;</label>
												{$rec['strokes02']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 3 strokes:&nbsp;</label>
												{$rec['strokes03']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 4 strokes:&nbsp;</label>
												{$rec['strokes04']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 5 strokes:&nbsp;</label>
												{$rec['strokes05']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 6 strokes:&nbsp;</label>
												{$rec['strokes06']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 7 strokes:&nbsp;</label>
												{$rec['strokes07']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 8 strokes:&nbsp;</label>
												{$rec['strokes08']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 9 strokes:&nbsp;</label>
												{$rec['strokes09']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 10 strokes:&nbsp;</label>
												{$rec['strokes10']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 11 strokes:&nbsp;</label>
												{$rec['strokes11']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 13 strokes:&nbsp;</label>
												{$rec['strokes13']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 14 strokes:&nbsp;</label>
												{$rec['strokes14']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 15 strokes:&nbsp;</label>
												{$rec['strokes15']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 16 strokes:&nbsp;</label>
												{$rec['strokes16']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 17 strokes:&nbsp;</label>
												{$rec['strokes17']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 18 strokes:&nbsp;</label>
												{$rec['strokes18']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Tee Date:&nbsp;</label>
												{$rec['teedate']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Tee Time:&nbsp;</label>
												{$rec['teetime']}
									</div>
									<div class='form-actions'>
										<a class='btn btn-default' onclick='roundsRequest(\"displayList\")'>Back</a>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>";
        }

		public function displayReadScreenUser() {
            $rec = Database::prepare(
                "SELECT * FROM tt_rounds WHERE id = ?", 
                array($this->id)
            )->fetch(PDO::FETCH_ASSOC);
            echo "
                <div class='container-fluid'>
                    <div class='col-xs-12'>
                        <!-- Page Heading -->
						<div class='row'>
							<div class='col-lg-12'>
								<h1 class='page-header'>
									Rounds Details <small>TeeTime Rounds</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='form-horizontal'>
									<div class='control-group'>
										<label class='control-label'>Course ID:&nbsp;</label>
												{$rec['course_id']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Person ID:&nbsp;</label>
												{$rec['person_id']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 1 strokes:&nbsp;</label>
												{$rec['strokes01']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 2 strokes:&nbsp;</label>
												{$rec['strokes02']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 3 strokes:&nbsp;</label>
												{$rec['strokes03']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 4 strokes:&nbsp;</label>
												{$rec['strokes04']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 5 strokes:&nbsp;</label>
												{$rec['strokes05']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 6 strokes:&nbsp;</label>
												{$rec['strokes06']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 7 strokes:&nbsp;</label>
												{$rec['strokes07']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 8 strokes:&nbsp;</label>
												{$rec['strokes08']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 9 strokes:&nbsp;</label>
												{$rec['strokes09']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 10 strokes:&nbsp;</label>
												{$rec['strokes10']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 11 strokes:&nbsp;</label>
												{$rec['strokes11']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 13 strokes:&nbsp;</label>
												{$rec['strokes13']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 14 strokes:&nbsp;</label>
												{$rec['strokes14']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 15 strokes:&nbsp;</label>
												{$rec['strokes15']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 16 strokes:&nbsp;</label>
												{$rec['strokes16']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 17 strokes:&nbsp;</label>
												{$rec['strokes17']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 18 strokes:&nbsp;</label>
												{$rec['strokes18']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Tee Date:&nbsp;</label>
												{$rec['teedate']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Tee Time:&nbsp;</label>
												{$rec['teetime']}
									</div>
									<div class='form-actions'>
										<a class='btn btn-default' onclick='roundsRequest(\"displayListUser\")'>Back</a>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>";
        }
        
        // Display a form for updating a record within the database.
        public function displayUpdateScreen() {
            $rec = Database::prepare(
                "SELECT * FROM tt_rounds WHERE id = ?", 
                array($this->id)
            )->fetch(PDO::FETCH_ASSOC);
            echo "
                <div class='container-fluid'>
                    <div class='col-xs-12'>
                        <!-- Page Heading -->
						<div class='row'>
							<div class='col-lg-12'>
								<h1 class='page-header'>
									Update Round <small>TeeTime Rounds</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Course</span>
									<select id='course_id' class='form-control' style='width:auto;'>";

									foreach (Database::prepare('SELECT * from tt_courses order by name asc', array()) as $row) {
										echo "<option value='{$row['id'] }' " . (($rec['course_id']==$row['id'])?'selected="selected"':"") . " >{$row['name'] }</option>";
									}

							echo "</select>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Person</span>
									<select id='person_id' class='form-control' style='width:auto;'>";

									foreach (Database::prepare('SELECT * from tt_persons order by fname asc', array()) as $row) {
										echo "<option value='{$row['id'] }' " . (($rec['person_id']==$row['id'])?'selected="selected"':"") . " >{$row['fname'] } {$row['lname'] }</option>";
									}

							echo "</select>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Tee Date</span>
									<input id='teedate' type='text' value='{$rec['teedate']}' class='form-control date' style='width:175px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Tee Time</span>
									<input id='teetime' type='text' value='{$rec['teetime']}' class='form-control time' style='width:175px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 1</span>
									<input id='strokes01' type='text' value='{$rec['strokes01']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 2</span>
									<input id='strokes02' type='text' value='{$rec['strokes02']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 3</span>
									<input id='strokes03' type='text' value='{$rec['strokes03']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 4</span>
									<input id='strokes04' type='text' value='{$rec['strokes04']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 5</span>
									<input id='strokes05' type='text'  value='{$rec['strokes05']}'class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 6</span>
									<input id='strokes06' type='text' value='{$rec['strokes06']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 7</span>
									<input id='strokes07' type='text' value='{$rec['strokes07']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 8</span>
									<input id='strokes08' type='text' value='{$rec['strokes08']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 9</span>
									<input id='strokes09' type='text' value='{$rec['strokes09']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 10</span>
									<input id='strokes10' type='text' value='{$rec['strokes10']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 11</span>
									<input id='strokes11' type='text' value='{$rec['strokes11']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 12</span>
									<input id='strokes12' type='text' value='{$rec['strokes12']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 13</span>
									<input id='strokes13' type='text' value='{$rec['strokes13']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 14</span>
									<input id='strokes14' type='text' value='{$rec['strokes14']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 15</span>
									<input id='strokes15' type='text' value='{$rec['strokes15']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 16</span>
									<input id='strokes16' type='text' value='{$rec['strokes16']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 17</span>
									<input id='strokes17' type='text' value='{$rec['strokes17']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 18</span>
									<input id='strokes18' type='text' value='{$rec['strokes18']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div style='color:red;'>"
								. $this->errMessage .
								"</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<button class='btn btn-success' onclick='roundsRequest(\"updateRecord\", {$this->id})'>Update</button>
								<a class='btn btn-default' onclick='roundsRequest(\"displayList\", {$this->id})'>Back</a>
							</div>
						</div>
                    </div>
                </div>";
        }

		public function displayUpdateScreenUser() {
            $rec = Database::prepare(
                "SELECT * FROM tt_rounds WHERE id = ?", 
                array($this->id)
            )->fetch(PDO::FETCH_ASSOC);

			echo "
                <div class='container-fluid'>
                    <div class='col-xs-12'>
                        <!-- Page Heading -->
						<div class='row'>
							<div class='col-lg-12'>
								<h1 class='page-header'>
									Update Round <small>TeeTime Rounds</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Course</span>
									<select id='course_id' class='form-control' style='width:auto;'>";

									foreach (Database::prepare('SELECT * from tt_courses order by name asc', array()) as $row) {
										echo "<option value='{$row['id'] }' " . (($rec['course_id']==$row['id'])?'selected="selected"':"") . " >{$row['name'] }</option>";
									}

							echo "</select>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Tee Date</span>
									<input id='teedate' type='text' value='{$rec['teedate']}' class='form-control date' style='width:175px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Tee Time</span>
									<input id='teetime' type='text' value='{$rec['teetime']}' class='form-control time' style='width:175px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 1</span>
									<input id='strokes01' type='text' value='{$rec['strokes01']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 2</span>
									<input id='strokes02' type='text' value='{$rec['strokes02']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 3</span>
									<input id='strokes03' type='text' value='{$rec['strokes03']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 4</span>
									<input id='strokes04' type='text' value='{$rec['strokes04']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 5</span>
									<input id='strokes05' type='text'  value='{$rec['strokes05']}'class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 6</span>
									<input id='strokes06' type='text' value='{$rec['strokes06']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 7</span>
									<input id='strokes07' type='text' value='{$rec['strokes07']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 8</span>
									<input id='strokes08' type='text' value='{$rec['strokes08']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 9</span>
									<input id='strokes09' type='text' value='{$rec['strokes09']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 10</span>
									<input id='strokes10' type='text' value='{$rec['strokes10']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 11</span>
									<input id='strokes11' type='text' value='{$rec['strokes11']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 12</span>
									<input id='strokes12' type='text' value='{$rec['strokes12']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 13</span>
									<input id='strokes13' type='text' value='{$rec['strokes13']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 14</span>
									<input id='strokes14' type='text' value='{$rec['strokes14']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 15</span>
									<input id='strokes15' type='text' value='{$rec['strokes15']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 16</span>
									<input id='strokes16' type='text' value='{$rec['strokes16']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 17</span>
									<input id='strokes17' type='text' value='{$rec['strokes17']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='input-group'>
									<span class='input-group-addon' style='width:100px;'>Hole 18</span>
									<input id='strokes18' type='text' value='{$rec['strokes18']}' class='form-control' style='width:50px;'>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div style='color:red;'>"
								. $this->errMessage .
								"</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<button class='btn btn-success' onclick='roundsRequest(\"updateRecordUser\", {$this->id})'>Update</button>
								<a class='btn btn-default' onclick='roundsRequest(\"displayListUser\", {$this->id})'>Back</a>
							</div>
						</div>
                    </div>
                </div>";
        }
        
        // Updates a record within the database.
        public function updateRecord() {
            if ($this->validate()) {
                Database::prepare(
                    "UPDATE tt_rounds SET course_id = ?, person_id = ?, strokes01 = ?, strokes02 = ?, strokes03 = ?, strokes04 = ?, strokes05 = ?, strokes06 = ?, strokes07 = ?, strokes08 = ?, strokes09 = ?, strokes10 = ?, strokes11 = ?, strokes12 = ?, strokes13 = ?, strokes14 = ?, strokes15 = ?, strokes16 = ?, strokes17 = ?, strokes18 = ?, teedate = ?, teetime = ? WHERE id = ?",
                    array($this->course_id, $this->person_id, $this->strokes01, $this->strokes02, $this->strokes03, $this->strokes04 , $this->strokes05 , $this->strokes06 , $this->strokes07 , $this->strokes08 , $this->strokes09 , $this->strokes10 , $this->strokes11 , $this->strokes12 , $this->strokes13 , $this->strokes14 , $this->strokes15 , $this->strokes16 ,$this->strokes17 ,$this->strokes18, $this->teedate, $this->teetime, $this->id)
                );
                $this->displayListScreen();
            } else {
                $this->displayUpdateScreen();
            }
        }

		 public function updateRecordUser() {
            if ($this->validate()) {
                Database::prepare(
                    "UPDATE tt_rounds SET course_id = ?, person_id = ?, strokes01 = ?, strokes02 = ?, strokes03 = ?, strokes04 = ?, strokes05 = ?, strokes06 = ?, strokes07 = ?, strokes08 = ?, strokes09 = ?, strokes10 = ?, strokes11 = ?, strokes12 = ?, strokes13 = ?, strokes14 = ?, strokes15 = ?, strokes16 = ?, strokes17 = ?, strokes18 = ?, teedate = ?, teetime = ? WHERE id = ?",
                    array($this->course_id, $_SESSION['userID'], $this->strokes01, $this->strokes02, $this->strokes03, $this->strokes04 , $this->strokes05 , $this->strokes06 , $this->strokes07 , $this->strokes08 , $this->strokes09 , $this->strokes10 , $this->strokes11 , $this->strokes12 , $this->strokes13 , $this->strokes14 , $this->strokes15 , $this->strokes16 ,$this->strokes17 ,$this->strokes18, $this->teedate, $this->teetime, $this->id)
                );
                $this->displayListScreenUser();
            } else {
                $this->displayUpdateScreenUser();
            }
        }
        
        // Display a form for deleting a record from the database.
        public function displayDeleteScreen() {
            echo "
                <div class='container-fluid'>
                    <div class='col-xs-12'>
                        <!-- Page Heading -->
						<div class='row'>
							<div class='col-lg-12'>
								<h1 class='page-header'>
									Delete Round <small>TeeTime Rounds</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='form-horizontal'>
									<p class='alert alert-error'>Are you sure you want to delete ?</p>
									<div class='form-actions'>
										<button id='submit' class='btn btn-danger' onClick='roundsRequest(\"deleteRecord\", {$this->id});'>Yes</button>
										<a class='btn btn-default' onclick='roundsRequest(\"displayList\")'>Back</a>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>";
        }

		public function displayDeleteScreenUser() {
            echo "
                <div class='container-fluid'>
                    <div class='col-xs-12'>
                        <!-- Page Heading -->
						<div class='row'>
							<div class='col-lg-12'>
								<h1 class='page-header'>
									Delete Round <small>TeeTime Rounds</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='form-horizontal'>
									<p class='alert alert-error'>Are you sure you want to delete ?</p>
									<div class='form-actions'>
										<button id='submit' class='btn btn-danger' onClick='roundsRequest(\"deleteRecord\", {$this->id});'>Yes</button>
										<a class='btn btn-default' onclick='roundsRequest(\"displayListUser\")'>Back</a>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>";
        }
        
        // Removes a record from the database.
        public function deleteRecord() {
            Database::prepare(
                "DELETE FROM tt_rounds WHERE id = ?",
                array($this->id)
            );
            $this->displayListScreen();
        }

		public function deleteRecordUser() {
            Database::prepare(
                "DELETE FROM tt_rounds WHERE id = ?",
                array($this->id)
            );
            $this->displayListScreenUser();
        }
        
        // Validates user input.
        private function validate() {
            $valid = true;
            // Check for empty input.
            if (empty($this->course_id)) { 
                $this->errMessage . "Please enter a course id.<br />";
                $valid = false; 
            }
			if (empty($this->person_id)) { 
                $this->errMessage .  "Please enter a person id.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes01)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes02)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes03)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes04)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes05)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes06)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes07)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes08)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes09)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes10)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes11)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes12)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes13)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes14)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes15)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes16)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes17)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			else if (empty($this->strokes18)) { 
                $this->errMessage .  "Please fill out all strokes.<br />";
                $valid = false; 
            }
			if (empty($this->teedate)) { 
                $this->errMessage .  "Please enter an teedate.<br />";
                $valid = false; 
            }
			if (empty($this->teetime)) { 
                $this->errMessage .  "Please enter an teetime.<br />";
                $valid = false; 
            }
            print_r($valid);
            return $valid;
        }
    }
?>
