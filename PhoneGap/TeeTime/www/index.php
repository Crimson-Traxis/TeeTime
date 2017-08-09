<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
?>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../TeeTime">TeeTime</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown" id="userDropdown">
				<?php
				require("php/login.php");
				$loginObj = new login();
				if($loginObj->LoginWithSessionVariable()) {
					echo 
					'<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>&nbsp; Welcome ' . $loginObj->fname . ' ' . $loginObj->lname . '<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="javascript:loadProfile();"><i class="fa fa-fw fa-user"></i> Profile</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="javascript:logout();"><i class="fa fa-fw fa-power-off""></i> Log Out</a>
						</li>
					</ul>';
				} else {
					echo 
					'<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>&nbsp;Login/Signup<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<div class="container" style="width:400px;padding:10px;">
								<div class="row">
									<div class="col-xs-12">
										<div class="input-group" style="margin-bottom:5px;width:100%;">
											<span class="input-group-addon" id="basic-addon1" style="width:100px;">Username</span>
											<input type="text" id="loginusername" onkeypress="testEnter(event);" class="form-control" placeholder="Email" aria-describedby="basic-addon1">
										</div>
										<div class="input-group" style="margin-bottom:5px;width:100%;">
											<span class="input-group-addon" id="basic-addon1" style="width:100px;">Password</span>
											<input type="password" id="loginpassword" onkeypress="testEnter(event);" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
										</div>
										<div id="loginMessage" style="width:100%;padding-bottom:5px;"></div>
										<button type="button" onclick="login(event);" class="btn btn-success pull-left">Login</button>
										<button type="button" id="btnShowSignupArea" onclick="showSignupArea(event)" class="btn btn-default pull-right">Signup</button>
										
									</div>
								</div>
								<div class="row" id="signupArea" style="display:none">
									<hr />
									<div class="col-xs-12">
										<div class="input-group" style="margin-bottom:5px;width:100%;">
											<span class="input-group-addon" id="basic-addon1" style="width:150px;">First Name</span>
											<div class="input-group has-feedback" style="width:100%;">
												<input type="text" id="firstname" class="form-control" placeholder="" aria-describedby="basic-addon1">
												<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
											</div>
										</div>
										<div class="input-group" style="margin-bottom:5px;width:100%;">
											<span class="input-group-addon" id="basic-addon1" style="width:150px;">Last Name</span>
											<div class="input-group has-feedback" style="width:100%;">
												<input type="text" id="lastname" class="form-control" placeholder="" aria-describedby="basic-addon1">
												<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
											</div>
										</div>
										<div class="input-group" style="margin-bottom:5px;width:100%;">
											<span class="input-group-addon" id="basic-addon1" style="width:150px;">Email</span>
											<div class="input-group has-feedback" style="width:100%;">
												<input type="text" id="email" class="form-control" placeholder="" aria-describedby="basic-addon1">
												<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
											</div>
										</div>
										<div class="input-group" style="margin-bottom:5px;width:100%;">
											<span class="input-group-addon" id="basic-addon1" style="width:150px;">Password</span>
											<div class="input-group has-feedback" style="width:100%;">
												<input type="password" id="password" class="form-control" placeholder="" aria-describedby="basic-addon1">
												<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
											</div>
										</div>
										<div class="input-group" style="margin-bottom:5px;width:100%;">
											<span class="input-group-addon" id="basic-addon1" style="width:150px;">Re-enter Password</span>
											<div class="input-group has-feedback" style="width:100%;">
												<input type="password" id="password2" class="form-control" placeholder="" aria-describedby="basic-addon1">
												<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
											</div>
										</div>
										<div class="input-group" style="margin-bottom:5px;width:100%;">
											<span class="input-group-addon" id="basic-addon1" style="width:150px;">Phone</span>
											<div class="input-group has-feedback" style="width:100%;">
												<input type="text" id="phone" class="form-control" placeholder="" aria-describedby="basic-addon1">
												<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
											</div>
										</div>
										<div class="input-group" style="margin-bottom:5px;width:100%;">
											<span class="input-group-addon" id="basic-addon1" style="width:150px;">Address</span>
											<div class="input-group has-feedback" style="width:100%;">
												<input type="text" id="address" class="form-control" placeholder="" aria-describedby="basic-addon1">
												<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
											</div>
										</div>
										<div class="input-group" style="margin-bottom:5px;width:100%;">
											<span class="input-group-addon" id="basic-addon1" style="width:150px;">City</span>
											<div class="input-group has-feedback" style="width:100%;">
												<input type="text" id="city" class="form-control" placeholder="" aria-describedby="basic-addon1">
												<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
											</div>
										</div>
										<div class="input-group" style="margin-bottom:5px;width:100%;">
											<span class="input-group-addon" id="basic-addon1" style="width:150px;">State</span>
											<select id="state" onclick="event.stopPropagation();" class="form-control" placeholder="" aria-describedby="basic-addon1">
												<option value="AL">Alabama</option>
												<option value="AK">Alaska</option>
												<option value="AZ">Arizona</option>
												<option value="AR">Arkansas</option>
												<option value="CA">California</option>
												<option value="CO">Colorado</option>
												<option value="CT">Connecticut</option>
												<option value="DE">Delaware</option>
												<option value="DC">District Of Columbia</option>
												<option value="FL">Florida</option>
												<option value="GA">Georgia</option>
												<option value="HI">Hawaii</option>
												<option value="ID">Idaho</option>
												<option value="IL">Illinois</option>
												<option value="IN">Indiana</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
												<option value="LA">Louisiana</option>
												<option value="ME">Maine</option>
												<option value="MD">Maryland</option>
												<option value="MA">Massachusetts</option>
												<option value="MI">Michigan</option>
												<option value="MN">Minnesota</option>
												<option value="MS">Mississippi</option>
												<option value="MO">Missouri</option>
												<option value="MT">Montana</option>
												<option value="NE">Nebraska</option>
												<option value="NV">Nevada</option>
												<option value="NH">New Hampshire</option>
												<option value="NJ">New Jersey</option>
												<option value="NM">New Mexico</option>
												<option value="NY">New York</option>
												<option value="NC">North Carolina</option>
												<option value="ND">North Dakota</option>
												<option value="OH">Ohio</option>
												<option value="OK">Oklahoma</option>
												<option value="OR">Oregon</option>
												<option value="PA">Pennsylvania</option>
												<option value="RI">Rhode Island</option>
												<option value="SC">South Carolina</option>
												<option value="SD">South Dakota</option>
												<option value="TN">Tennessee</option>
												<option value="TX">Texas</option>
												<option value="UT">Utah</option>
												<option value="VT">Vermont</option>
												<option value="VA">Virginia</option>
												<option value="WA">Washington</option>
												<option value="WV">West Virginia</option>
												<option value="WI">Wisconsin</option>
												<option value="WY">Wyoming</option>
											</select>		
										</div>
										<div class="input-group" style="margin-bottom:5px;width:100%;">
											<span class="input-group-addon" id="basic-addon1" style="width:150px;">Zip</span>
											<div class="input-group has-feedback" style="width:100%;">
												<input type="text" id="zip" class="form-control" placeholder="" aria-describedby="basic-addon1">
												<span style="display:none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
											</div>
										</div>
										<div style="color:red;" id="signupMessage"></div>
										<button type="button" onclick="signup(event);" class="btn btn-primary pull-right">Signup</button>
										<button type="button" onclick="hideSignup(event);" class="btn btn-default pull-left">Cancel</button>
									</div>
								</div>
							</div>
						</li>
					</ul>';
				}
				?>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <?php
					require('php/functions.php');
					$func = new functions();
					$func->GetSideBar();
				?>
            </ul>
        </div>
    </nav>

    <div id="page-wrapper" style="position:relative;">
		<div id="page-contents">

		</div>
		<div id="loading">
			<table>
				<tr>
					<td>
						<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
					</td>
					<td>
						<span style="font-size:18px;">Loading...</span>
					</td>
				</tr>
			</table>
		</div>
    </div>
    <!-- /#page-wrapper -->

	<script>
		loadDashboard();
	</script>

</div>

