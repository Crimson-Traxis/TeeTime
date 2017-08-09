<?php

    require_once("database.php");
    require_once("table.php");
    
    class Courses implements Table {
        // DATA MEMBERS
        private $id;
        private $address;
        private $addressErr;
		private $city;
        private $cityErr;
		private $description;
        private $descriptionErr;
		private $email;
        private $emailErr;
		private $name;
        private $nameErr;
		private $par01;
        private $par01Err;
		private $par02;
        private $par02Err;
		private $par03;
        private $par03Err;
		private $par04;
        private $par04Err;
		private $par05;
        private $par05Err;
		private $par06;
        private $par06Err;
		private $par07;
        private $par07Err;
		private $par08;
        private $par08Err;
		private $par09;
        private $par09Err;
		private $par10;
        private $par10Err;
		private $par11;
        private $par11Err;
		private $par12;
        private $par12Err;
		private $par13;
        private $par13Err;
		private $par14;
        private $par14Err;
		private $par15;
        private $par15Err;
		private $par16;
        private $par16Err;
		private $par17;
        private $par17Err;
		private $par18;
        private $par18Err;
		private $phone;
        private $phoneErr;
		private $state;
        private $stateErr;
		private $zip;
        private $zipErr;

        // CONSTRUCTOR
        function __construct($id, $address, $city, $description, $email, $name, $par01, $par02, $par03, $par04, $par05, $par06, $par07, $par08, $par09, $par10, $par11, $par12, $par13, $par14, $par15, $par16, $par17, $par18, $phone, $state, $zip) {

			$this->id=$id;
			$this->address=$address; 
			$this->city=$city; 
			$this->description=$description; 
			$this->email=$email; 
			$this->name=$name; 
			$this->par01=$par01;
			$this->par02=$par02;
			$this->par03=$par03; 
			$this->par04=$par04; 
			$this->par05=$par05; 
			$this->par06=$par06; 
			$this->par07=$par07; 
			$this->par08=$par08; 
			$this->par09=$par09; 
			$this->par10=$par10; 
			$this->par11=$par11; 
			$this->par12=$par12; 
			$this->par13=$par13; 
			$this->par14=$par14; 
			$this->par15=$par15; 
			$this->par16=$par16; 
			$this->par17=$par17; 
			$this->par18=$par18; 
			$this->phone=$phone; 
			$this->state=$state; 
			$this->zip=$zip;
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
									Courses <small>TeeTime Courses</small>
								</h1>
							</div>
						</div>
                        <div class='row'>
							<div class='col-xs-12'>
								<a class='btn btn-primary' style='width:125px;margin-bottom:20px;' onclick='coursesRequest(\"displayCreate\")'>Add Course</a>
								<table style='width:100%;' class='table table-hover table-striped'> 
									<thead>
										<tr>
											<th>Name</th>
											<th>Email</th>
											<th>City</th>
											<th>Description</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>";                                    
           foreach (Database::prepare('SELECT * FROM `tt_courses`', array()) as $row) {
                echo "
                    <tr>
                        <td>{$row['name'] } </td>
                        <td>{$row['email'] }</td>
                        <td>{$row['city']}</td>
						<td>{$row['description']}</td>
                        <td>
							<table>
								<tr>
									<td><button class='btn btn-primary' style='margin:5px;' onclick='coursesRequest(\"displayRead\", {$row['id']})'>Read</button></td>
									<td><button class='btn btn-success' style='margin:5px;' onclick='coursesRequest(\"displayUpdate\", {$row['id']})'>Update</button></td>
									<td><button class='btn btn-danger' style='margin:5px;' onclick='coursesRequest(\"displayDelete\", {$row['id']})'>Delete</button></td>
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
									Courses <small>TeeTime Course</small>
								</h1>
							</div>
						</div>
                        <div class='row'>
							<div class='col-xs-12'>
								<a class='btn btn-primary' style='width:125px;margin-bottom:20px;' onclick='coursesRequest(\"displayCreateUser\")'>Add Course</a>
								<table style='width:100%;' class='table table-hover table-striped'>
									<thead>
										<tr>
											<th>Name</th>
											<th>Email</th>
											<th>City</th>
											<th>Description</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>";                                    
           foreach (Database::prepare('SELECT *  FROM `tt_courses`', array()) as $row) {
                echo "
                    <tr>
                        <td>{$row['name'] } </td>
                        <td>{$row['email'] }</td>
                        <td>{$row['city']}</td>
						<td>{$row['description']}</td>
						<td><button class='btn btn-primary' style='margin:5px;' onclick='coursesRequest(\"displayReadUser\", {$row['id']})'>Read</button></td>
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
									Create Course <small>TeeTime Course</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='form-horizontal'>
									<div class='control-group'>
										<label class='control-label". ((empty($this->address))?'':' error') ."'>Address</label>
										<div class='controls'>
											<input id='courseaddress' type='text' required>
											<span class='help-inline'>{$this->addressErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->city))?'':' error') ."'>City</label>
										<div class='controls'>
											<input id='coursecity' type='text' required>
											<span class='help-inline'>{$this->cityErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->description))?'':' error') ."'>Description</label>
										<div class='controls'>
											<input id='coursedescription' type='text' required>
											<span class='help-inline'>{$this->descriptionErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->email))?'':' error') ."'>Email</label>
										<div class='controls'>
											<input id='courseemail' type='text' placeholder='name@svsu.edu' required>
											<span class='help-inline'>{$this->emailErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->name))?'':' error') ."'>Name</label>
										<div class='controls'>
											<input id='coursename' type='text' required>
											<span class='help-inline'>{$this->nameErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par01))?'':' error') ."'>Par Hole 1</label>
										<div class='controls'>
											<input id='par01' type='text' required>
											<span class='help-inline'>{$this->par01Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par02))?'':' error') ."'>Par Hole 2</label>
										<div class='controls'>
											<input id='par02' type='text' required>
											<span class='help-inline'>{$this->par02Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par03))?'':' error') ."'>Par Hole 3</label>
										<div class='controls'>
											<input id='par03' type='text' required>
											<span class='help-inline'>{$this->par03Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par04))?'':' error') ."'>Par Hole 4</label>
										<div class='controls'>
											<input id='par04' type='text' required>
											<span class='help-inline'>{$this->par04Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par05))?'':' error') ."'>Par Hole 5</label>
										<div class='controls'>
											<input id='par05' type='text' required>
											<span class='help-inline'>{$this->par05Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par06))?'':' error') ."'>Par Hole 6</label>
										<div class='controls'>
											<input id='par06' type='text' required>
											<span class='help-inline'>{$this->par06Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par07))?'':' error') ."'>Par Hole 7</label>
										<div class='controls'>
											<input id='par07' type='text' required>
											<span class='help-inline'>{$this->par07Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par08))?'':' error') ."'>Par Hole 8</label>
										<div class='controls'>
											<input id='par08' type='text' required>
											<span class='help-inline'>{$this->par08Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par09))?'':' error') ."'>Par Hole 9</label>
										<div class='controls'>
											<input id='par09' type='text' required>
											<span class='help-inline'>{$this->par09Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par10))?'':' error') ."'>Par Hole 10</label>
										<div class='controls'>
											<input id='par10' type='text' required>
											<span class='help-inline'>{$this->par10Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par11))?'':' error') ."'>Par Hole 11</label>
										<div class='controls'>
											<input id='par11' type='text' required>
											<span class='help-inline'>{$this->par11Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par12))?'':' error') ."'>Par Hole 12</label>
										<div class='controls'>
											<input id='par12' type='text' required>
											<span class='help-inline'>{$this->par12Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par13))?'':' error') ."'>Par Hole 13</label>
										<div class='controls'>
											<input id='par13' type='text' required>
											<span class='help-inline'>{$this->par13Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par14))?'':' error') ."'>Par Hole 14</label>
										<div class='controls'>
											<input id='par14' type='text' required>
											<span class='help-inline'>{$this->par14Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par15))?'':' error') ."'>Par Hole 15</label>
										<div class='controls'>
											<input id='par15' type='text' required>
											<span class='help-inline'>{$this->par15Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par16))?'':' error') ."'>Par Hole 16</label>
										<div class='controls'>
											<input id='par16' type='text' required>
											<span class='help-inline'>{$this->par16Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par17))?'':' error') ."'>Par Hole 17</label>
										<div class='controls'>
											<input id='par17' type='text' required>
											<span class='help-inline'>{$this->par17Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par18))?'':' error') ."'>Par Hole 18</label>
										<div class='controls'>
											<input id='par18' type='text' required>
											<span class='help-inline'>{$this->par18Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->phone))?'':' error') ."'>Phone</label>
										<div class='controls'>
											<input id='coursephone' type='text' placeholder='555-555-5555' required>
											<span class='help-inline'>{$this->phoneErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->state))?'':' error') ."'>State</label>
										<div class='controls'>
											<input id='coursestate' type='text' required>
											<span class='help-inline'>{$this->stateErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->zip))?'':' error') ."'>Zip</label>
										<div class='controls'>
											<input id='coursezip' type='text' required>
											<span class='help-inline'>{$this->zipErr}</span>
										</div>
									</div>
									<div class='form-actions'>
										<button class='btn btn-success' onclick='coursesRequest(\"createRecord\")'>Create</button>
										<a class='btn btn-default' onclick='coursesRequest(\"displayList\")'>Back</a>
									</div>
								</div>
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
									Create Course <small>TeeTime Course</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='form-horizontal'>
									<div class='control-group'>
										<label class='control-label". ((empty($this->address))?'':' error') ."'>Address</label>
										<div class='controls'>
											<input id='courseaddress' type='text' required>
											<span class='help-inline'>{$this->addressErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->city))?'':' error') ."'>City</label>
										<div class='controls'>
											<input id='coursecity' type='text' required>
											<span class='help-inline'>{$this->cityErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->description))?'':' error') ."'>Description</label>
										<div class='controls'>
											<input id='coursedescription' type='text' required>
											<span class='help-inline'>{$this->descriptionErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->email))?'':' error') ."'>Email</label>
										<div class='controls'>
											<input id='courseemail' type='text' placeholder='name@svsu.edu' required>
											<span class='help-inline'>{$this->emailErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->name))?'':' error') ."'>Name</label>
										<div class='controls'>
											<input id='coursename' type='text' required>
											<span class='help-inline'>{$this->nameErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par01))?'':' error') ."'>Par Hole 1</label>
										<div class='controls'>
											<input id='par01' type='text' required>
											<span class='help-inline'>{$this->par01Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par02))?'':' error') ."'>Par Hole 2</label>
										<div class='controls'>
											<input id='par02' type='text' required>
											<span class='help-inline'>{$this->par02Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par03))?'':' error') ."'>Par Hole 3</label>
										<div class='controls'>
											<input id='par03' type='text' required>
											<span class='help-inline'>{$this->par03Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par04))?'':' error') ."'>Par Hole 4</label>
										<div class='controls'>
											<input id='par04' type='text' required>
											<span class='help-inline'>{$this->par04Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par05))?'':' error') ."'>Par Hole 5</label>
										<div class='controls'>
											<input id='par05' type='text' required>
											<span class='help-inline'>{$this->par05Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par06))?'':' error') ."'>Par Hole 6</label>
										<div class='controls'>
											<input id='par06' type='text' required>
											<span class='help-inline'>{$this->par06Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par07))?'':' error') ."'>Par Hole 7</label>
										<div class='controls'>
											<input id='par07' type='text' required>
											<span class='help-inline'>{$this->par07Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par08))?'':' error') ."'>Par Hole 8</label>
										<div class='controls'>
											<input id='par08' type='text' required>
											<span class='help-inline'>{$this->par08Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par09))?'':' error') ."'>Par Hole 9</label>
										<div class='controls'>
											<input id='par09' type='text' required>
											<span class='help-inline'>{$this->par09Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par10))?'':' error') ."'>Par Hole 10</label>
										<div class='controls'>
											<input id='par10' type='text' required>
											<span class='help-inline'>{$this->par10Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par11))?'':' error') ."'>Par Hole 11</label>
										<div class='controls'>
											<input id='par11' type='text' required>
											<span class='help-inline'>{$this->par11Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par12))?'':' error') ."'>Par Hole 12</label>
										<div class='controls'>
											<input id='par12' type='text' required>
											<span class='help-inline'>{$this->par12Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par13))?'':' error') ."'>Par Hole 13</label>
										<div class='controls'>
											<input id='par13' type='text' required>
											<span class='help-inline'>{$this->par13Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par14))?'':' error') ."'>Par Hole 14</label>
										<div class='controls'>
											<input id='par14' type='text' required>
											<span class='help-inline'>{$this->par14Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par15))?'':' error') ."'>Par Hole 15</label>
										<div class='controls'>
											<input id='par15' type='text' required>
											<span class='help-inline'>{$this->par15Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par16))?'':' error') ."'>Par Hole 16</label>
										<div class='controls'>
											<input id='par16' type='text' required>
											<span class='help-inline'>{$this->par16Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par17))?'':' error') ."'>Par Hole 17</label>
										<div class='controls'>
											<input id='par17' type='text' required>
											<span class='help-inline'>{$this->par17Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par18))?'':' error') ."'>Par Hole 18</label>
										<div class='controls'>
											<input id='par18' type='text' required>
											<span class='help-inline'>{$this->par18Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->phone))?'':' error') ."'>Phone</label>
										<div class='controls'>
											<input id='coursephone' type='text' placeholder='555-555-5555' required>
											<span class='help-inline'>{$this->phoneErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->state))?'':' error') ."'>State</label>
										<div class='controls'>
											<input id='coursestate' type='text' required>
											<span class='help-inline'>{$this->stateErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->zip))?'':' error') ."'>Zip</label>
										<div class='controls'>
											<input id='coursezip' type='text' required>
											<span class='help-inline'>{$this->zipErr}</span>
										</div>
									</div>
									<div class='form-actions'>
										<button class='btn btn-success' onclick='coursesRequest(\"createRecordUser\")'>Create</button>
										<a class='btn btn-default' onclick='coursesRequest(\"displayListUser\")'>Back</a>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>";
        }
        
        // Adds a record to the database.
        public function createRecord() {
            if ($this->validate()) {
                Database::prepare(
                    "INSERT INTO tt_courses (address, city, description, email, name, par01, par02, par03, par04, par05, par06, par07, par08, par09, par10, par11, par12, par13, par14, par15, par16, par17, par18, phone, state, zip) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                    array($this->address, $this->city, $this->description, $this->email, $this->name, $this->par01, $this->par02, $this->par03, $this->par04, $this->par05, $this->par06, $this->par07, $this->par08, $this->par09, $this->par10, $this->par11, $this->par12, $this->par13, $this->par14, $this->par15, $this->par16, $this->par17, $this->par18, $this->phone, $this->state, $this->zip)
                );
                $this->displayListScreen();
            } else {
                $this->displayCreateScreen();
            }
        }

		public function createRecordUser() {
            if ($this->validate()) {
                Database::prepare(
                    "INSERT INTO tt_courses (address, city, description, email, name, par01, par02, par03, par04, par05, par06, par07, par08, par09, par10, par11, par12, par13, par14, par15, par16, par17, par18, phone, state, zip) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                    array($this->address, $this->city, $this->description, $this->email, $this->name, $this->par01, $this->par02, $this->par03, $this->par04, $this->par05, $this->par06, $this->par07, $this->par08, $this->par09, $this->par10, $this->par11, $this->par12, $this->par13, $this->par14, $this->par15, $this->par16, $this->par17, $this->par18, $this->phone, $this->state, $this->zip)
                );
                $this->displayListScreenUser();
            } else {
                $this->displayCreateScreenUser();
            }
        }
        
        // Display a form containing information about a specified record in the database.
        public function displayReadScreen() {
            $rec = Database::prepare(
                "SELECT * FROM tt_courses WHERE id = ?", 
                array($this->id)
            )->fetch(PDO::FETCH_ASSOC);
            echo "
                <div class='container-fluid'>
                    <div class='col-xs-12'>
                        <!-- Page Heading -->
						<div class='row'>
							<div class='col-lg-12'>
								<h1 class='page-header'>
									Course Details <small>TeeTime Course</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='form-horizontal'>
									<div class='control-group'>
										<label class='control-label'>Address:&nbsp;</label>
												{$rec['address']}
									</div>
									<div class='control-group'>
										<label class='control-label'>City:&nbsp;</label>
												{$rec['city']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Description:&nbsp;</label>
												{$rec['description']}
									</div>
									<div class='control-group'>
										<label class='control-label'>email:&nbsp;</label>
												{$rec['email']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Name:&nbsp;</label>
												{$rec['name']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 1 Par:&nbsp;</label>
												{$rec['par01']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 2 Par:&nbsp;</label>
												{$rec['par02']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 3 Par:&nbsp;</label>
												{$rec['par03']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 4 Par:&nbsp;</label>
												{$rec['par04']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 5 Par:&nbsp;</label>
												{$rec['par05']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 6 Par:&nbsp;</label>
												{$rec['par06']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 7 Par:&nbsp;</label>
												{$rec['par07']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 8 Par:&nbsp;</label>
												{$rec['par08']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 9 Par:&nbsp;</label>
												{$rec['par09']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 10 Par:&nbsp;</label>
												{$rec['par10']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 11 Par:&nbsp;</label>
												{$rec['par11']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 13 Par:&nbsp;</label>
												{$rec['par13']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 14 Par:&nbsp;</label>
												{$rec['par14']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 15 Par:&nbsp;</label>
												{$rec['par15']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 16 Par:&nbsp;</label>
												{$rec['par16']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 17 Par:&nbsp;</label>
												{$rec['par17']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 18 Par:&nbsp;</label>
												{$rec['par18']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Phone:&nbsp;</label>
												{$rec['phone']}
									</div>
									<div class='control-group'>
										<label class='control-label'>State:&nbsp;</label>
												{$rec['state']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Zip:&nbsp;</label>
												{$rec['zip']}
									</div>
									<div class='form-actions'>
										<a class='btn btn-default' onclick='coursesRequest(\"displayList\")'>Back</a>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>";
        }

		public function displayReadScreenUser() {
            $rec = Database::prepare(
                "SELECT * FROM tt_courses WHERE id = ?", 
                array($this->id)
            )->fetch(PDO::FETCH_ASSOC);
            echo "
                <div class='container-fluid'>
                    <div class='col-xs-12'>
                        <!-- Page Heading -->
						<div class='row'>
							<div class='col-lg-12'>
								<h1 class='page-header'>
									Course Details <small>TeeTime Course</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='form-horizontal'>
									<div class='control-group'>
										<label class='control-label'>Address:&nbsp;</label>
												{$rec['address']}
									</div>
									<div class='control-group'>
										<label class='control-label'>City:&nbsp;</label>
												{$rec['city']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Description:&nbsp;</label>
												{$rec['description']}
									</div>
									<div class='control-group'>
										<label class='control-label'>email:&nbsp;</label>
												{$rec['email']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Name:&nbsp;</label>
												{$rec['name']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 1 Par:&nbsp;</label>
												{$rec['par01']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 2 Par:&nbsp;</label>
												{$rec['par02']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 3 Par:&nbsp;</label>
												{$rec['par03']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 4 Par:&nbsp;</label>
												{$rec['par04']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 5 Par:&nbsp;</label>
												{$rec['par05']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 6 Par:&nbsp;</label>
												{$rec['par06']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 7 Par:&nbsp;</label>
												{$rec['par07']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 8 Par:&nbsp;</label>
												{$rec['par08']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 9 Par:&nbsp;</label>
												{$rec['par09']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 10 Par:&nbsp;</label>
												{$rec['par10']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 11 Par:&nbsp;</label>
												{$rec['par11']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 13 Par:&nbsp;</label>
												{$rec['par13']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 14 Par:&nbsp;</label>
												{$rec['par14']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 15 Par:&nbsp;</label>
												{$rec['par15']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 16 Par:&nbsp;</label>
												{$rec['par16']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 17 Par:&nbsp;</label>
												{$rec['par17']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Hole 18 Par:&nbsp;</label>
												{$rec['par18']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Phone:&nbsp;</label>
												{$rec['phone']}
									</div>
									<div class='control-group'>
										<label class='control-label'>State:&nbsp;</label>
												{$rec['state']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Zip:&nbsp;</label>
												{$rec['zip']}
									</div>
									<div class='form-actions'>
										<a class='btn btn-default' onclick='coursesRequest(\"displayListUser\")'>Back</a>
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
                "SELECT * FROM tt_courses WHERE id = ?", 
                array($this->id)
            )->fetch(PDO::FETCH_ASSOC);
            echo "
                <div class='container-fluid'>
                    <div class='col-xs-12'>
                        <!-- Page Heading -->
						<div class='row'>
							<div class='col-lg-12'>
								<h1 class='page-header'>
									Update Course <small>TeeTime Course</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='form-horizontal'>

									<div class='control-group'>
										<label class='control-label". ((empty($this->address))?'':' error') ."'>Address</label>
										<div class='controls'>
											<input id='courseaddress' type='text' value='{$rec['address']}'  required>
											<span class='help-inline'>{$this->addressErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->city))?'':' error') ."'>City</label>
										<div class='controls'>
											<input id='coursecity' type='text' value='{$rec['city']}'  required>
											<span class='help-inline'>{$this->cityErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->description))?'':' error') ."'>Description</label>
										<div class='controls'>
											<input id='coursedescription' type='text' value='{$rec['description']}'  required>
											<span class='help-inline'>{$this->descriptionErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->email))?'':' error') ."'>Email</label>
										<div class='controls'>
											<input id='courseemail' type='text' placeholder='name@svsu.edu' value='{$rec['email']}'  required>
											<span class='help-inline'>{$this->emailErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->name))?'':' error') ."'>Name</label>
										<div class='controls'>
											<input id='coursename' type='text' value='{$rec['name']}'  required>
											<span class='help-inline'>{$this->nameErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par01))?'':' error') ."'>Par Hole 1</label>
										<div class='controls'>
											<input id='par01' type='text' value='{$rec['par01']}'  required>
											<span class='help-inline'>{$this->par01Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par02))?'':' error') ."'>Par Hole 2</label>
										<div class='controls'>
											<input id='par02' type='text' value='{$rec['par02']}'  required>
											<span class='help-inline'>{$this->par02Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par03))?'':' error') ."'>Par Hole 3</label>
										<div class='controls'>
											<input id='par03' type='text' value='{$rec['par03']}'  required>
											<span class='help-inline'>{$this->par03Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par04))?'':' error') ."'>Par Hole 4</label>
										<div class='controls'>
											<input id='par04' type='text' value='{$rec['par04']}'  required>
											<span class='help-inline'>{$this->par04Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par05))?'':' error') ."'>Par Hole 5</label>
										<div class='controls'>
											<input id='par05' type='text' value='{$rec['par05']}'  required>
											<span class='help-inline'>{$this->par05Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par06))?'':' error') ."'>Par Hole 6</label>
										<div class='controls'>
											<input id='par06' type='text' value='{$rec['par06']}'  required>
											<span class='help-inline'>{$this->par06Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par07))?'':' error') ."'>Par Hole 7</label>
										<div class='controls'>
											<input id='par07' type='text' value='{$rec['par07']}'  required>
											<span class='help-inline'>{$this->par07Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par08))?'':' error') ."'>Par Hole 8</label>
										<div class='controls'>
											<input id='par08' type='text' value='{$rec['par08']}'  required>
											<span class='help-inline'>{$this->par08Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par09))?'':' error') ."'>Par Hole 9</label>
										<div class='controls'>
											<input id='par09' type='text' value='{$rec['par09']}'  required>
											<span class='help-inline'>{$this->par09Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par10))?'':' error') ."'>Par Hole 10</label>
										<div class='controls'>
											<input id='par10' type='text' value='{$rec['par10']}'  required>
											<span class='help-inline'>{$this->par10Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par11))?'':' error') ."'>Par Hole 11</label>
										<div class='controls'>
											<input id='par11' type='text' value='{$rec['par11']}'  required>
											<span class='help-inline'>{$this->par11Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par12))?'':' error') ."'>Par Hole 12</label>
										<div class='controls'>
											<input id='par12' type='text' value='{$rec['par12']}'  required>
											<span class='help-inline'>{$this->par12Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par13))?'':' error') ."'>Par Hole 13</label>
										<div class='controls'>
											<input id='par13' type='text' value='{$rec['par13']}'  required>
											<span class='help-inline'>{$this->par13Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par14))?'':' error') ."'>Par Hole 14</label>
										<div class='controls'>
											<input id='par14' type='text' value='{$rec['par14']}'  required>
											<span class='help-inline'>{$this->par14Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par15))?'':' error') ."'>Par Hole 15</label>
										<div class='controls'>
											<input id='par15' type='text' value='{$rec['par15']}'  required>
											<span class='help-inline'>{$this->par15Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par16))?'':' error') ."'>Par Hole 16</label>
										<div class='controls'>
											<input id='par16' type='text' value='{$rec['par16']}'  required>
											<span class='help-inline'>{$this->par16Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par17))?'':' error') ."'>Par Hole 17</label>
										<div class='controls'>
											<input id='par17' type='text' value='{$rec['par17']}'  required>
											<span class='help-inline'>{$this->par17Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->par18))?'':' error') ."'>Par Hole 18</label>
										<div class='controls'>
											<input id='par18' type='text' value='{$rec['par18']}'  required>
											<span class='help-inline'>{$this->par18Err}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->phone))?'':' error') ."'>Phone</label>
										<div class='controls'>
											<input id='coursephone' type='text' placeholder='555-555-5555' value='{$rec['phone']}'  required>
											<span class='help-inline'>{$this->phoneErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->state))?'':' error') ."'>State</label>
										<div class='controls'>
											<input id='coursestate' type='text' value='{$rec['state']}'  required>
											<span class='help-inline'>{$this->stateErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->zip))?'':' error') ."'>Zip</label>
										<div class='controls'>
											<input id='coursezip' type='text' value='{$rec['zip']}'  required>
											<span class='help-inline'>{$this->zipErr}</span>
										</div>
									</div>
									<div class='form-actions'>
										<button class='btn btn-success' onclick='coursesRequest(\"updateRecord\", {$this->id})'>Update</button>
										<a class='btn btn-default' onclick='coursesRequest(\"displayList\")'>Back</a>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>";
        }
        
        // Updates a record within the database.
        public function updateRecord() {
            if ($this->validate()) {
                Database::prepare(
                    "UPDATE tt_courses SET address = ?, city = ?, description = ?, email = ?, name = ?, par01 = ?, par02 = ?, par03 = ?, par04 = ?, par05 = ?, par06 = ?, par07 = ?, par08 = ?, par09 = ?, par10 = ?, par11 = ?, par12 = ?, par13 = ?, par14 = ?, par15 = ?, par16 = ?, par17 = ?, par18 = ?, phone = ?, state = ?, zip = ? WHERE id = ?",
                    array($this->address, $this->city, $this->description, $this->email, $this->name, $this->par01, $this->par02, $this->par03, $this->par04 , $this->par05 , $this->par06 , $this->par07 , $this->par08 , $this->par09 , $this->par10 , $this->par11 , $this->par12 , $this->par13 , $this->par14 , $this->par15 , $this->par16 ,$this->par17 ,$this->par18, $this->phone, $this->state, $this->zip ,$this->id)
                );
                $this->displayListScreen();
            } else {
                $this->displayUpdateScreen();
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
									Delte Course <small>TeeTime Course</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='form-horizontal'>
									<p class='alert alert-error'>Are you sure you want to delete ?</p>
									<div class='form-actions'>
										<button id='submit' class='btn btn-danger' onClick='coursesRequest(\"deleteRecord\", {$this->id});'>Yes</button>
										<a class='btn btn-default' onclick='coursesRequest(\"displayList\")'>Back</a>
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
                "DELETE FROM tt_courses WHERE id = ?",
                array($this->id)
            );
            $this->displayListScreen();
        }
        
        // Validates user input.
        private function validate() {
            $valid = true;
            // Validate Mobile
            if (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $this->phone)) {
                $this->phoneErr = "Please enter a valid phone number.";
                $valid = false;
            }
            // Validate Email
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->emailErr = "Please enter a valid email address.";
                $valid = false;
            }
            // Check for empty input.
            if (empty($this->name)) { 
                $this->nameErr = "Please enter a name.";
                $valid = false; 
            }
			if (empty($this->address)) { 
                $this->addressErr = "Please enter a address.";
                $valid = false; 
            }
			if (empty($this->city)) { 
                $this->cityErr = "Please enter a city.";
                $valid = false; 
            }
			if (empty($this->state)) { 
                $this->stateErr = "Please enter a state.";
                $valid = false; 
            }
			if (empty($this->zip)) { 
                $this->zipErr = "Please enter a zip.";
                $valid = false; 
            }
            if (empty($this->email)) { 
                $this->emailErr = "Please enter an email.";
                $valid = false; 
            }
			if (empty($this->description)) { 
                $this->descriptionErr = "Please enter an description.";
                $valid = false; 
            }
			if (empty($this->par01)) { 
                $this->par01Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par02)) { 
                $this->par02Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par03)) { 
                $this->par03Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par04)) { 
                $this->par04Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par05)) { 
                $this->par05Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par06)) { 
                $this->par06Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par07)) { 
                $this->par07Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par08)) { 
                $this->par08Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par09)) { 
                $this->par09Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par10)) { 
                $this->par10Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par11)) { 
                $this->par11Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par12)) { 
                $this->par12Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par13)) { 
                $this->par13Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par14)) { 
                $this->par14Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par15)) { 
                $this->par15Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par16)) { 
                $this->par16Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par17)) { 
                $this->par17Err = "Please enter an par.";
                $valid = false; 
            }
			if (empty($this->par18)) { 
                $this->par18Err = "Please enter an par.";
                $valid = false; 
            }
            print_r($valid);
            return $valid;
        }
    }
?>
