<?php
    require_once("database.php");
    require_once("table.php");
    
    class Persons implements Table {
        // DATA MEMBERS
        private $id;
        private $fname;
        private $fnameErr;
		private $lname;
        private $lnameErr;
        private $email;
        private $emailErr;
        private $phone;
        private $phoneErr;
		private $address;
        private $addressErr;
		private $city;
        private $cityErr;
		private $password;
        private $passwordErr;
		private $state;
        private $stateErr;
		private $zip;
        private $zipErr;

        
        // CONSTRUCTOR
        function __construct($id, $fname, $lname, $email, $phone, $address, $city, $password, $state, $zip) {
            $this->id     = $id;
            $this->fname   = $fname;
			$this->lname   = $lname;
            $this->email  = $email;
            $this->phone = $phone;
			$this->address = $address;
			$this->city = $city;
			$this->password = $password;
			$this->state = $state;
			$this->zip = $zip;
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
									Users <small>TeeTime Users</small>
								</h1>
							</div>
						</div>
                        <div class='row'>
							<div class='col-xs-12'>
								<a class='btn btn-primary' style='width:125px;margin-bottom:20px;' onclick='personsRequest(\"displayCreate\")'>Add User</a>
								<table style='width:100%;' class='table table-hover table-striped'>
									<thead>
										<tr>
											<th>Name</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>";                                    
            foreach (Database::prepare('SELECT * FROM `tt_persons`', array()) as $row) {
                echo "
                    <tr>
                        <td>{$row['fname'] } {$row['lname']}</td>
                        <td>{$row['email'] }</td>
                        <td>{$row['phone']}</td>
                        <td>
							<table>
								<tr>
									<td><button class='btn btn-primary' style='margin:5px;' onclick='personsRequest(\"displayRead\", {$row['id']})'>Read</button></td>
									<td><button class='btn btn-success' style='margin:5px;' onclick='personsRequest(\"displayUpdate\", {$row['id']})'>Update</button></td>
									<td><button class='btn btn-danger' style='margin:5px;' onclick='personsRequest(\"displayDelete\", {$row['id']})'>Delete</button></td>
								</tr>
							</table>
                        </td>
                    </tr>";
            }
            echo "</tbody></table></div></div></div>";
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
									Create Person <small>TeeTime Person</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='form-horizontal'>
									<div class='control-group'>
										<label class='control-label". ((empty($this->fnameErr))?'':' error') ."'>First Name</label>
										<div class='controls'>
											<input id='userfname' type='text' required>
											<span class='help-inline'>{$this->fnameErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->lnameErr))?'':' error') ."'>Last Name</label>
										<div class='controls'>
											<input id='userlname' type='text' required>
											<span class='help-inline'>{$this->lnameErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->passwordErr))?'':' error') ."'>Password</label>
										<div class='controls'>
											<input id='userpassword' type='password' required>
											<span class='help-inline'>{$this->passwordErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->emailErr))?'':' error') ."'>Email</label>
										<div class='controls'>
											<input id='useremail' type='text' placeholder='name@svsu.edu' required>
											<span class='help-inline'>{$this->emailErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->phoneErr))?'':' error') ."'>Phone</label>
										<div class='controls'>
											<input id='userphone' type='text' placeholder='555-555-5555' required>
											<span class='help-inline'>{$this->phoneErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->addressErr))?'':' error') ."'>Address</label>
										<div class='controls'>
											<input id='useraddress' type='text' placeholder='' required>
											<span class='help-inline'>{$this->addressErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->cityErr))?'':' error') ."'>City</label>
										<div class='controls'>
											<input id='usercity' type='text' placeholder='Saginaw' required>
											<span class='help-inline'>{$this->cityErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->stateErr))?'':' error') ."'>State</label>
										<div class='controls'>
											<input id='userstate' type='text' placeholder='Michigan' required>
											<span class='help-inline'>{$this->stateErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->zipErr))?'':' error') ."'>Zip</label>
										<div class='controls'>
											<input id='userzip' type='text' placeholder='48822' required>
											<span class='help-inline'>{$this->zipErr}</span>
										</div>
									</div>
									<div class='form-actions'>
										<button class='btn btn-success' onclick='personsRequest(\"createRecord\")'>Create</button>
										<a class='btn btn-default' onclick='personsRequest(\"displayList\")'>Back</a>
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
                    "INSERT INTO tt_persons (fname, lname, password_hash, email, phone, address, city, state, zip) VALUES (?,?,?,?,?,?,?,?,?)",
                    array($this->fname, $this->lname, $this->password, $this->email, $this->phone, $this->address, $this->city, $this->state, $this->zip)
                );
                $this->displayListScreen();
            } else {
                $this->displayCreateScreen();
            }
        }
        
        // Display a form containing information about a specified record in the database.
        public function displayReadScreen() {
            $rec = Database::prepare(
                "SELECT * FROM tt_persons WHERE id = ?", 
                array($this->id)
            )->fetch(PDO::FETCH_ASSOC);
            echo "
                <div class='container-fluid'>
                    <div class='col-xs-12'>
                        <!-- Page Heading -->
						<div class='row'>
							<div class='col-lg-12'>
								<h1 class='page-header'>
									Person Details <small>TeeTime Person</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='form-horizontal'>
									<div class='control-group'>
										<label class='control-label'>First Name:&nbsp;</label>
												{$rec['fname']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Last Name:&nbsp;</label>
												{$rec['lname']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Email:&nbsp;</label>
												{$rec['email']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Phone:&nbsp;</label>
												{$rec['phone']}
									</div>
									<div class='control-group'>
										<label class='control-label'>Phone:&nbsp;</label>
												{$rec['address']}
									</div>
									<div class='control-group'>
										<label class='control-label'>City:&nbsp;</label>
												{$rec['city']}
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
										<a class='btn btn-default' onclick='personsRequest(\"displayList\")'>Back</a>
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
                "SELECT * FROM tt_persons WHERE id = ?", 
                array($this->id)
            )->fetch(PDO::FETCH_ASSOC);
            echo "
                <div class='container-fluid'>
                    <div class='col-xs-12'>
                        <!-- Page Heading -->
						<div class='row'>
							<div class='col-lg-12'>
								<h1 class='page-header'>
									Update Person <small>TeeTime Person</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='form-horizontal'>
									<div class='control-group'>
										<label class='control-label". ((empty($this->fnameErr))?'':' error') ."'>First Name</label>
										<div class='controls'>
											<input id='userfname' type='text' value='{$rec['fname']}' required>
											<span class='help-inline'>{$this->fnameErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->lnameErr))?'':' error') ."'>Last Name</label>
										<div class='controls'>
											<input id='userlname' type='text' value='{$rec['lname']}' required>
											<span class='help-inline'>{$this->lnameErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->passwordErr))?'':' error') ."'>Password</label>
										<div class='controls'>
											<input id='userpassword' type='password' value='{$rec['password_hash']}' required>
											<span class='help-inline'>{$this->passwordErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->emailErr))?'':' error') ."'>Email</label>
										<div class='controls'>
											<input id='useremail' type='text' placeholder='name@svsu.edu' value='{$rec['email']}' required>
											<span class='help-inline'>{$this->emailErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->phoneErr))?'':' error') ."'>Phone</label>
										<div class='controls'>
											<input id='userphone' type='text' placeholder='555-555-5555' value='{$rec['phone']}' required>
											<span class='help-inline'>{$this->phoneErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->addressErr))?'':' error') ."'>Address</label>
										<div class='controls'>
											<input id='useraddress' type='text' placeholder='' value='{$rec['address']}' required>
											<span class='help-inline'>{$this->addressErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->cityErr))?'':' error') ."'>City</label>
										<div class='controls'>
											<input id='usercity' type='text' placeholder='Saginaw' value='{$rec['city']}' required>
											<span class='help-inline'>{$this->cityErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->stateErr))?'':' error') ."'>State</label>
										<div class='controls'>
											<input id='userstate' type='text' placeholder='Michigan' value='{$rec['state']}' required>
											<span class='help-inline'>{$this->stateErr}</span>
										</div>
									</div>
									<div class='control-group'>
										<label class='control-label". ((empty($this->zipErr))?'':' error') ."'>Zip</label>
										<div class='controls'>
											<input id='userzip' type='text' placeholder='48822' value='{$rec['zip']}' required>
											<span class='help-inline'>{$this->zipErr}</span>
										</div>
									</div>
									<div class='form-actions'>
										<button class='btn btn-success' onclick='personsRequest(\"updateRecord\", {$this->id})'>Update</button>
										<a class='btn btn-default' onclick='personsRequest(\"displayList\")'>Back</a>
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
                    "UPDATE tt_persons SET fname = ?, lname = ?, password_hash = ?, email = ?, phone = ?, address = ?, city = ?, state = ?, zip = ? WHERE id = ?",
                    array($this->fname, $this->lname, $this->password, $this->email, $this->phone, $this->address, $this->city, $this->state, $this->zip , $this->id)
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
									Delete Person <small>TeeTime Person</small>
								</h1>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
								<div class='form-horizontal'>
									<p class='alert alert-error'>Are you sure you want to delete ?</p>
									<div class='form-actions'>
										<button id='submit' class='btn btn-danger' onClick='personsRequest(\"deleteRecord\", {$this->id});'>Yes</button>
										<a class='btn btn-default' onclick='personsRequest(\"displayList\")'>Back</a>
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
                "DELETE FROM tt_persons WHERE id = ?",
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
            if (empty($this->fname)) { 
                $this->fnameErr = "Please enter a first name.";
                $valid = false; 
            }
			if (empty($this->password)) { 
                $this->passwordErr = "Please enter a password.";
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
			if (empty($this->lname)) { 
                $this->lnameErr = "Please enter a last name.";
                $valid = false; 
            }
            if (empty($this->email)) { 
                $this->emailErr = "Please enter an email.";
                $valid = false; 
            }
            print_r($valid);
            return $valid;
        }
    }
?>
