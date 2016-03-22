<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="shortcut icon" href="images/golfBallLogo.ico">

    <title>Fantasy Golf - Manager</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
	
	   <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
</head>

<body>

<?php

session_start();

// Include the constants used for the db connection
require("constants.php");

// 'CSWEB.studentnet.int', 'team1_cs414', 'CS414t1', 'cs414_team_1')
@$sid = $_POST['studentId'];


$id = isset($_POST['studentId']) ? $_POST['studentId'] : $_SESSION['username'];

//$id = $_SESSION['username']; // Just a random variable gotten from the URL

if($id == null)
    header('Location: login.html');
    
// The database variable holds the connection so you can access it
$database = mysqli_connect(DATABASEADDRESS,DATABASEUSER,DATABASEPASS);

if (mysqli_connect_errno())
{
   echo "<h1>Connection error</h1>";
}

$_SESSION['username'] = $id;

if($id == null)
    header('Location: login.html');

// Class id and description query
$query = "select event.id, event_name
from event_list
join event
on event.id = event_list.event_id
where manager_id = ?";

// Student first and last name to display on top right of screen
$topRightQuery = "select first_name, last_name from manager where manager_id = ?";

$classQuery = "select event_id from event_list where manager_id = ?";

// event, etc, to display on manager main page
$tableQuery = "select count(test_id) - count(date_taken) from test_list
join test using(test_id)
where student_id = ? and class_id = ? and datediff(date_begin, sysdate()) <= 0 and datediff(date_end, sysdate()) >= 0";

// Display any events that will occur within 7 days
$warningQuery = "select class_id, datediff(date_end, sysdate()) as days_left from enrollment
join class using (class_id)
join test using(class_id)
join test_list using(student_id, test_id)
where student_id = ? and datediff(date_end, sysdate()) <= 7 and datediff(date_end, sysdate()) >= 0 and date_taken is null";

// The @ is for ignoring PHP errors. Replace "database_down()" with whatever you want to happen when an error happens.
@ $database->select_db(DATABASENAME);

// The statement variable holds your query      
$stmt = $database->prepare($query);
$topRightStatement = $database->prepare($topRightQuery);
$table = $database->prepare($tableQuery);
$warningstmt = $database->prepare($warningQuery);
$classStatement = $database->prepare($classQuery);

?>

	<!-- Added by Victor -->
	<?php require("Nav.php");?>
	
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
				<li>
                    <a href="#" id="student-summary">Summary</a>
                </li>
                <li class="sidebar-brand">
                    Select an Event:
                </li>
               
				<?php 
				// Added by David Hughen
				// The code to fetch the manager's events and put them in the sidebar to the left
				$stmt->bind_param("s", $id);
				$stmt->bind_result($clid, $clde);
				$stmt->execute();

				while($stmt->fetch())
				{
                    echo '<li><a href=studentClassPage.php?classId='.$class_id = str_replace(" ", "%20", $clid).'><div class=subject-name>'.$clde.'</div></a></li>';
				}
				$stmt->close();
				?>
            </ul>
        </div>
		
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
		<!-- Keep page stuff under this div! -->
            <div class="container-fluid">
                <div class="row">
					<h2 class="warning_sign_msg"> Notifications: </h2>
                     
                                <?php
                                // Display warnings if a test has seven days or less to take
                                $classArray = array();
                                $warningstmt->bind_param("s", $id);
                                $warningstmt->bind_result($class_id, $days_left);
                                $warningstmt->execute();
                                while($warningstmt->fetch())
                                {
                                    $classArray[] = $class_id;
                                    $classArray[] = $days_left;
                                    
                                }
                                if(count($classArray) == 0)
                                {
                                    echo'<div class="col-md-12" id="warning_box2">
                                        <div class="warning_box">
                                            <p class="warning_msg">';
                                    echo 'No notifications';
                                    echo'</p>
                                        </div>
                                    </div>';
                                }
                                else
                                {
                                    echo'<div style="overflow-y:auto;overflow-x:hidden" class="col-md-12" id="warning_box1">
                                        <div class="warning_box">
                                            <p class="warning_msg">';
                                    for($i = 0; $i < count($classArray); $i += 2)
                                    {
                                        if($classArray[$i+1] == 0)
                                            echo $classArray[$i] . ' test expires today.';
                                        else
                                            echo $classArray[$i] . ' test will expire in ' . $classArray[$i+1] . ' day(s).';
                                        
                                        echo '<br />';
                                    }
                                    echo'</p>
                                        </div>
                                    </div>';
                                }
                                $warningstmt->close();
                            ?>
                                
					
					<!-- our code starts here :) -->
					<table class="student_summary">
					
						<colgroup>
							<col class="classes" />
							<col class="recent_updates" />
						</colgroup>
						
						<thead>
						<tr>
							<th>Events</th>
							<th>Tests to Take</th>
						</tr>
						</thead>
						
						<tbody>
						<?php 
							// Code added by David Hughen to display class id, update, and date
							// inside the table in the middle of the page
							$classStatement->bind_param("s", $id);
							$classStatement->bind_result($clid);
							$classStatement->execute();
							while($classStatement->fetch())
							{
                                $tableArray[] = $clid;
							}
							$classStatement->close();
                            
                            for($i = 0; $i < count($tableArray); $i++)
                            {
                                $table->bind_param("ss", $id, $tableArray[$i]);
                                $table->bind_result($count);
                                $table->execute();
                                while($table->fetch())
                                {
                                    echo '<tr><td><button type="button" class="course_button" onclick="location.href=\'studentClassPage.php?classId='.str_replace(" ", "%20", $tableArray[$i]).'\'">'.$tableArray[$i].'</button></td>
                                          <td>You have '.$count.' test(s) to take</td></tr>';
                                }
                            }
                            $table->close();
							?>
							</tbody>
					</table>
                </div>

            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>