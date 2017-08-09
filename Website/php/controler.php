<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

    if(isset($_POST['table'])) {
        if ($_POST['table'] == "courses") 
		{
            require("courses.php");
            $table = new Courses(
                $_POST['id'],
                $_POST['address'],
				$_POST['city'],
                $_POST['description'],
                $_POST['email'],
				$_POST['name'],
				$_POST['par01'],
				$_POST['par02'],
				$_POST['par03'],
				$_POST['par04'],
				$_POST['par05'],
				$_POST['par06'],
				$_POST['par07'],
				$_POST['par08'],
				$_POST['par09'],
				$_POST['par10'],
				$_POST['par11'],
				$_POST['par12'],
				$_POST['par13'],
				$_POST['par14'],
				$_POST['par15'],
				$_POST['par16'],
				$_POST['par17'],
				$_POST['par18'],
				$_POST['phone'],
				$_POST['state'],
				$_POST['zip']
            );
			        // Select Action
			if($_POST['action'] == "displayList"  ) $table->displayListScreen();
			elseif($_POST['action'] == "displayListUser"  ) $table->displayListScreenUser();
			elseif($_POST['action'] == "displayCreate") $table->displayCreateScreen();
			elseif($_POST['action'] == "displayCreateUser") $table->displayCreateScreenUser();
			elseif($_POST['action'] == "createRecord" ) $table->createRecord();
			elseif($_POST['action'] == "displayRead"  ) $table->displayReadScreen();
			elseif($_POST['action'] == "displayReadUser"  ) $table->displayReadScreenUser();
			elseif($_POST['action'] == "displayUpdate") $table->displayUpdateScreen();
			elseif($_POST['action'] == "updateRecord" ) $table->updateRecord();
			elseif($_POST['action'] == "displayDelete") $table->displayDeleteScreen();
			elseif($_POST['action'] == "deleteRecord" ) $table->deleteRecord();
        }
		else if($_POST['table'] == "rounds") {
		
			require("rounds.php");
            $table = new Rounds(
                $_POST['id'], 
				$_POST['course_id'], 
				$_POST['person_id'], 
				$_POST['strokes01'], 
				$_POST['strokes02'], 
				$_POST['strokes03'], 
				$_POST['strokes04'], 
				$_POST['strokes05'], 
				$_POST['strokes06'], 
				$_POST['strokes07'], 
				$_POST['strokes08'], 
				$_POST['strokes09'], 
				$_POST['strokes10'], 
				$_POST['strokes11'], 
				$_POST['strokes12'], 
				$_POST['strokes13'], 
				$_POST['strokes14'], 
				$_POST['strokes15'], 
				$_POST['strokes16'], 
				$_POST['strokes17'], 
				$_POST['strokes18'], 
				$_POST['teedate'],
				$_POST['teetime']
            );
			        // Select Action
			if($_POST['action'] == "displayList"  ) $table->displayListScreen();
			elseif($_POST['action'] == "displayListUser"  ) $table->displayListScreenUser();
			elseif($_POST['action'] == "displayCreate") $table->displayCreateScreen();
			elseif($_POST['action'] == "displayCreateUser") $table->displayCreateScreenUser();
			elseif($_POST['action'] == "createRecord" ) $table->createRecord();
			elseif($_POST['action'] == "createRecordUser" ) $table->createRecordUser();
			elseif($_POST['action'] == "displayRead"  ) $table->displayReadScreen();
			elseif($_POST['action'] == "displayUpdate") $table->displayUpdateScreen();
			elseif($_POST['action'] == "updateRecord" ) $table->updateRecord();
			elseif($_POST['action'] == "displayDelete") $table->displayDeleteScreen();
			elseif($_POST['action'] == "deleteRecord" ) $table->deleteRecord();
			elseif($_POST['action'] == "displayReadUser"  ) $table->displayReadScreenUser();
			elseif($_POST['action'] == "displayUpdateUser") $table->displayUpdateScreenUser();
			elseif($_POST['action'] == "updateRecordUser" ) $table->updateRecordUser();
			elseif($_POST['action'] == "displayDeleteUser") $table->displayDeleteScreenUser();
			elseif($_POST['action'] == "deleteRecordUser" ) $table->deleteRecordUser();
		}
		else if($_POST['table'] == "persons") {
			require("persons.php");
            $table = new Persons(
                $_POST['id'],
                $_POST['fname'],
				$_POST['lname'],
                $_POST['email'],
                $_POST['phone'],
				$_POST['address'],
				$_POST['city'],
				$_POST['password'],
				$_POST['state'],
				$_POST['zip']
            );
        

			// Select Action
            if($_POST['action'] == "displayList"  ) $table->displayListScreen();
			elseif($_POST['action'] == "displayCreate") $table->displayCreateScreen();
			elseif($_POST['action'] == "createRecord" ) $table->createRecord();
			elseif($_POST['action'] == "displayRead"  ) $table->displayReadScreen();
			elseif($_POST['action'] == "displayUpdate") $table->displayUpdateScreen();
			elseif($_POST['action'] == "updateRecord" ) $table->updateRecord();
			elseif($_POST['action'] == "displayDelete") $table->displayDeleteScreen();
			elseif($_POST['action'] == "deleteRecord" ) $table->deleteRecord();
		}
	}
	else 
	{
		if ($_POST['action'] == "login") {
			require("login.php");
			$login = new login();
			$login->LoginWithUserPass($_POST['username'],$_POST['password']);
		}
		else if($_POST['action'] == "signup") {
			require("login.php");
			$login = new login();
			$login->Signup($_POST['fname'],
							$_POST['lname'],
							$_POST['email'],
							$_POST['phone'],
							$_POST['address'],
							$_POST['city'],
							$_POST['password'],
							$_POST['state'],
							$_POST['zip']);
		}
		else if ($_POST['action'] == "logout") {
			require("login.php");
			$login = new login();
			$login->Logout();
		}
		else if ($_POST['action'] == "signup") {
			require("login.php");
			$login = new login();
			$login->Signup($_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['phone'],$_POST['address'],$_POST['city'],$_POST['password'],$_POST['state'],$_POST['zip']);
		}
		else if ($_POST['action'] == 'loadsidebar') {
			require("functions.php");
			$func = new functions();
			$func->GetSideBar();
		}
		else if ($_POST['action'] == 'loadprofile') {
			require("functions.php");
			$func = new functions();
			$func->LoadProfile();
		}
		else if ($_POST['action'] == 'loaddashboard') {
			require("functions.php");
			$func = new functions();
			$func->LoadDashboard();
		}
		else if ($_POST['action'] == 'updateprofile') {
			require("functions.php");
			$func = new functions();
			$func->UpdateProfile($_POST['fname'],
							$_POST['lname'],
							$_POST['email'],
							$_POST['phone'],
							$_POST['address'],
							$_POST['city'],
							$_POST['password'],
							$_POST['state'],
							$_POST['zip']);

			if (isset($_FILES['file']['name'])) {
				if (0 < $_FILES['file']['error']) {
					
				} 
				else 
				{
					if (file_exists('profilepic/' . $_SESSION['userID'] . '.png')) {
						chmod('profilepic/' . $_SESSION['userID'] . '.png', 0755);
						unlink('profilepic/' . $_SESSION['userID'] . '.png');
					} 
					else 
					{
					
					}
					move_uploaded_file($_FILES['file']['tmp_name'],realpath(dirname(__FILE__) . '/..') . '/profilepic/' . $_SESSION['userID'] . '.png');
					Database::prepare(
                    "UPDATE tt_persons SET hasImage = ? WHERE id = ?",
                    array(true,$_SESSION['userID'])
                );
				}
			}
		}
	}
	
?>