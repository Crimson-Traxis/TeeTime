<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
    require_once("database.php");
	require_once("login.php");
    
    class functions {
    
        function GetSideBar() {
			$loginObj = new login();
			if($loginObj->LoginWithSessionVariable()) {
				echo '
				<li class="active">
                    <a id="dashboard" href="javascript:loadDashboard();"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
				</li>
				<li>
					<a id="profile" href="javascript:loadProfile();"><i class="fa fa-fw fa-user"></i> Profile</a>
				</li>
				<li>
					<a id="userCourses" href="javascript:coursesRequest(\'displayListUser\',\'0\')"><i class="fa fa-fw fa-plus"></i> Courses</a>
				</li>
				<li>
					<a id="userRounds" href="javascript:roundsRequest(\'displayListUser\',\'0\')"><i class="fa fa-fw fa-edit"></i> Rounds</a>
				</li>
				';
				if($loginObj->isAdmin) {
					echo '
					<li>
						<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-cog"></i> Admin <i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="demo" class="collapse">
							<li>
								<a href="javascript:personsRequest(\'displayList\',\'0\')"><i class="fa fa-fw fa-edit"></i> Modify Users</a>
							</li>
							<li>
								<a href="javascript:coursesRequest(\'displayList\',\'0\')"><i class="fa fa-fw fa-edit"></i> Modify Courses</a>
							</li>
							<li>
								<a href="javascript:roundsRequest(\'displayList\',\'0\')"><i class="fa fa-fw fa-edit"></i> Modify Rounds</a>
							</li>
						</ul>
					</li>
					';
				}
			}
			else {
				echo '
				<li class="active">
                    <a><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
				</li>';
			}
		}

		function LoadDashboard() {
			echo '
				<div class="container-fluid">

					<!-- Page Heading -->
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header">
								Dashboard <small>TeeTime Overview</small>
							</h1>
						</div>
					</div>
					<!-- /.row -->
					<div class="row">
						<div class="col-lg-12">
							<img style="width:100%;" src="images/golf-banner.jpg"></image>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<h3>What Is TeeTime</h3>
							<h4>TeeTime is the one place to store all your golfing rounds. It has an awesome interactive tables that allow you to search your massive round collection in a matter of milliseconds. You can also upload a profile picture if you so desire. Security is important so only you can view your TeeTime rounds. TeeTime is built with the most advanced web dev languages, PHP, HTML, JavaScript, CSS and uses the most common web frameworks jquery and bootstrap.</h3>
							<h3>Features</h3>
							<ul>
								<li>Loing/regestration</li>
								<li>Score Storing</li>
								<li>Searchable Tables</li>
								<li>Andorid App Avaliable</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /.container-fluid -->
			';
		}

		function UpdateProfile($fname, $lname, $email, $phone, $address, $city, $password, $state, $zip) {
			Database::prepare(
				"UPDATE tt_persons SET fname = ?, lname = ?, password_hash = ?, phone = ?, address = ?, city = ?, state = ?, zip = ? WHERE email = ?",
				array($fname, $lname, $password, $phone, $address, $city, $state, $zip ,$email)
			);
			$this->LoadProfile();
		}

		function LoadProfile() {
			$rec = Database::prepare(
                "SELECT * FROM tt_persons WHERE id = ?", 
                array($_SESSION['userID'])
            )->fetch(PDO::FETCH_ASSOC);
			$image = 'images/goal.png';
			if($rec['hasImage']) {
				$image = 'profilepic/' . $rec['id'] . '.png?t=' . gmdate('Y-m-d h:i:s \G\M\T', time());;
			}
			echo '
				<div class="container-fluid">

					<!-- Page Heading -->
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header">
								Profile <small>TeeTime Profile</small>
							</h1>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-md-6" style="text-align:left;">
							<div class="input-group" style="margin-bottom:5px;width:100%;">
								<span class="input-group-addon" id="basic-addon1" style="width:150px;">First Name</span>
								<div class="input-group has-feedback" style="width:100%;">
									<input type="text" id="profilefirstname" value="' . $rec['fname'] . '" class="form-control" placeholder="" aria-describedby="basic-addon1">
									<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							</div>
							<div class="input-group" style="margin-bottom:5px;width:100%;">
								<span class="input-group-addon" id="basic-addon1" style="width:150px;">Last Name</span>
								<div class="input-group has-feedback" style="width:100%;">
									<input type="text" id="profilelastname" value="' . $rec['lname'] . '" class="form-control" placeholder="" aria-describedby="basic-addon1">
									<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							</div>
							<div class="input-group" style="margin-bottom:5px;width:100%;">
								<span class="input-group-addon" id="basic-addon1" style="width:150px;">Email</span>
								<div class="input-group has-feedback" style="width:100%;">
									<input type="text" id="profileemail" value="' . $rec['email'] . '" disabled class="form-control" placeholder="" aria-describedby="basic-addon1">
									<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							</div>
							<div class="input-group" style="margin-bottom:5px;width:100%;">
								<span class="input-group-addon" id="basic-addon1" style="width:150px;">Password</span>
								<div class="input-group has-feedback" style="width:100%;">
									<input type="password" id="profilepassword" value="' . $rec['password_hash'] . '" class="form-control" placeholder="" aria-describedby="basic-addon1">
									<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							</div>
							<div class="input-group" style="margin-bottom:5px;width:100%;">
								<span class="input-group-addon" id="basic-addon1" style="width:150px;">Re-enter Password</span>
								<div class="input-group has-feedback" style="width:100%;">
									<input type="password" id="profilepassword2" class="form-control" value="' . $rec['password_hash'] . '" placeholder="" aria-describedby="basic-addon1">
									<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							</div>
							<div class="input-group" style="margin-bottom:5px;width:100%;">
								<span class="input-group-addon" id="basic-addon1" style="width:150px;">Phone</span>
								<div class="input-group has-feedback" style="width:100%;">
									<input type="text" id="profilephone" value="' . $rec['phone'] . '" class="form-control" placeholder="" aria-describedby="basic-addon1">
									<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							</div>
							<div class="input-group" style="margin-bottom:5px;width:100%;">
								<span class="input-group-addon" id="basic-addon1" style="width:150px;">Address</span>
								<div class="input-group has-feedback" style="width:100%;">
									<input type="text" id="profileaddress" value="' . $rec['address'] . '" class="form-control" placeholder="" aria-describedby="basic-addon1">
									<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							</div>
							<div class="input-group" style="margin-bottom:5px;width:100%;">
								<span class="input-group-addon" id="basic-addon1" style="width:150px;">City</span>
								<div class="input-group has-feedback" style="width:100%;">
									<input type="text" id="profilecity" value="' . $rec['city'] . '" class="form-control" placeholder="" aria-describedby="basic-addon1">
									<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							</div>
							<div class="input-group" style="margin-bottom:5px;width:100%;">
								<span class="input-group-addon" id="basic-addon1" style="width:150px;">State</span>
								<select id="profilestate" class="form-control" placeholder="" aria-describedby="basic-addon1">
									<option value="AL"'.(($rec['state']=='AL')?'selected="selected"':"").'>Alabama</option>
									<option value="AK"'.(($rec['state']=='AK')?'selected="selected"':"").'>Alaska</option>
									<option value="AZ"'.(($rec['state']=='AZ')?'selected="selected"':"").'>Arizona</option>
									<option value="AR"'.(($rec['state']=='AR')?'selected="selected"':"").'>Arkansas</option>
									<option value="CA"'.(($rec['state']=='CA')?'selected="selected"':"").'>California</option>
									<option value="CO"'.(($rec['state']=='CO')?'selected="selected"':"").'>Colorado</option>
									<option value="CT"'.(($rec['state']=='CT')?'selected="selected"':"").'>Connecticut</option>
									<option value="DE"'.(($rec['state']=='DE')?'selected="selected"':"").'>Delaware</option>
									<option value="DC"'.(($rec['state']=='DC')?'selected="selected"':"").'>District Of Columbia</option>
									<option value="FL"'.(($rec['state']=='FL')?'selected="selected"':"").'>Florida</option>
									<option value="GA"'.(($rec['state']=='GA')?'selected="selected"':"").'>Georgia</option>
									<option value="HI"'.(($rec['state']=='HI')?'selected="selected"':"").'>Hawaii</option>
									<option value="ID"'.(($rec['state']=='ID')?'selected="selected"':"").'>Idaho</option>
									<option value="IL"'.(($rec['state']=='IL')?'selected="selected"':"").'>Illinois</option>
									<option value="IN"'.(($rec['state']=='IN')?'selected="selected"':"").'>Indiana</option>
									<option value="IA"'.(($rec['state']=='IA')?'selected="selected"':"").'>Iowa</option>
									<option value="KS"'.(($rec['state']=='KS')?'selected="selected"':"").'>Kansas</option>
									<option value="KY"'.(($rec['state']=='KY')?'selected="selected"':"").'>Kentucky</option>
									<option value="LA"'.(($rec['state']=='LA')?'selected="selected"':"").'>Louisiana</option>
									<option value="ME"'.(($rec['state']=='ME')?'selected="selected"':"").'>Maine</option>
									<option value="MD"'.(($rec['state']=='MD')?'selected="selected"':"").'>Maryland</option>
									<option value="MA"'.(($rec['state']=='MA')?'selected="selected"':"").'>Massachusetts</option>
									<option value="MI"'.(($rec['state']=='MI')?'selected="selected"':"").'>Michigan</option>
									<option value="MN"'.(($rec['state']=='MN')?'selected="selected"':"").'>Minnesota</option>
									<option value="MS"'.(($rec['state']=='MS')?'selected="selected"':"").'>Mississippi</option>
									<option value="MO"'.(($rec['state']=='MO')?'selected="selected"':"").'>Missouri</option>
									<option value="MT"'.(($rec['state']=='MT')?'selected="selected"':"").'>Montana</option>
									<option value="NE"'.(($rec['state']=='NE')?'selected="selected"':"").'>Nebraska</option>
									<option value="NV"'.(($rec['state']=='NV')?'selected="selected"':"").'>Nevada</option>
									<option value="NH"'.(($rec['state']=='NH')?'selected="selected"':"").'>New Hampshire</option>
									<option value="NJ"'.(($rec['state']=='NJ')?'selected="selected"':"").'>New Jersey</option>
									<option value="NM"'.(($rec['state']=='NM')?'selected="selected"':"").'>New Mexico</option>
									<option value="NY"'.(($rec['state']=='NY')?'selected="selected"':"").'>New York</option>
									<option value="NC"'.(($rec['state']=='NC')?'selected="selected"':"").'>North Carolina</option>
									<option value="ND"'.(($rec['state']=='ND')?'selected="selected"':"").'>North Dakota</option>
									<option value="OH"'.(($rec['state']=='OH')?'selected="selected"':"").'>Ohio</option>
									<option value="OK"'.(($rec['state']=='OK')?'selected="selected"':"").'>Oklahoma</option>
									<option value="OR"'.(($rec['state']=='OR')?'selected="selected"':"").'>Oregon</option>
									<option value="PA"'.(($rec['state']=='PA')?'selected="selected"':"").'>Pennsylvania</option>
									<option value="RI"'.(($rec['state']=='RI')?'selected="selected"':"").'>Rhode Island</option>
									<option value="SC"'.(($rec['state']=='SC')?'selected="selected"':"").'>South Carolina</option>
									<option value="SD"'.(($rec['state']=='SD')?'selected="selected"':"").'>South Dakota</option>
									<option value="TN"'.(($rec['state']=='TN')?'selected="selected"':"").'>Tennessee</option>
									<option value="TX"'.(($rec['state']=='TX')?'selected="selected"':"").'>Texas</option>
									<option value="UT"'.(($rec['state']=='UT')?'selected="selected"':"").'>Utah</option>
									<option value="VT"'.(($rec['state']=='VT')?'selected="selected"':"").'>Vermont</option>
									<option value="VA"'.(($rec['state']=='VA')?'selected="selected"':"").'>Virginia</option>
									<option value="WA"'.(($rec['state']=='WA')?'selected="selected"':"").'>Washington</option>
									<option value="WV"'.(($rec['state']=='WV')?'selected="selected"':"").'>West Virginia</option>
									<option value="WI"'.(($rec['state']=='WI')?'selected="selected"':"").'>Wisconsin</option>
									<option value="WY"'.(($rec['state']=='WY')?'selected="selected"':"").'>Wyoming</option>
								</select>		
							</div>
							<div class="input-group" style="margin-bottom:5px;width:100%;">
								<span class="input-group-addon" id="basic-addon1" style="width:150px;">Zip</span>
								<div class="input-group has-feedback" style="width:100%;">
									<input type="text" id="profilezip" value="' . $rec['zip'] . '" class="form-control" placeholder="" aria-describedby="basic-addon1">
									<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-md-6" style="text-align:left;">
							<img src="' . $image . '" style="width:100%;max-width:400px;border: 1px solid black;padding: 10px;"><image>
							<span id="fileUploadmsg"></span>
							<br />
							<br />
							<input type="file" id="file" name="file" onchange="$(\'#filename\').html(document.getElementById(\'file\').files[0].name);" class="form-control"  style="display:none;max-width:300px;"/>
							<div class="input-group" style="max-width:400px;width:100%;padding-bottom:5px;">
							  <span class="input-group-addon">
								File
							  </span>
							  <span id="filename" class="form-control" style="white-space: nowrap;"></span>
							  <span class="input-group-btn">
								<button class="btn btn-secondary" onclick="$(\'#file\').click();" type="button">Select File</button>
							  </span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div style="color:red;" id="updateProfileMessage"></div>
							<button type="button" onclick="updateProfile(event);" class="btn btn-primary pull-left">Update Proifle</button>
						</div>
					</div>
				</div>
				<!-- /.container-fluid -->
			';
		}
    }
?>
