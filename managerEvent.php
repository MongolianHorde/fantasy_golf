<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="shortcut icon" href="images/golfBallLogo.ico">

    <title>Fantasy Golf - Event</title>

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
@$eventId = $_GET['eventId'];


$id = $_SESSION['username'];

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
$query = "select datediff(date_end, date_begin) + 1 as count
from event
where event.id = ?";

$eventQuery = "select event_name from event where event.id = ?";

// Student first and last name to display on top right of screen
$topRightQuery = "select first_name, last_name from manager where manager_id = ?";

$tableDateQuery = "select * from 
(select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v
where selected_date between (select date_begin from event where event.id = ?) and (select date_end from event where event.id = ?)";

// The @ is for ignoring PHP errors. Replace "database_down()" with whatever you want to happen when an error happens.
@ $database->select_db(DATABASENAME);

// The statement variable holds your query      
$stmt = $database->prepare($query);
$topRightStatement = $database->prepare($topRightQuery);
$eventStatement = $database->prepare($eventQuery);
$tableDateStmt = $database->prepare($tableDateQuery);


?>

	<!-- Added by Victor -->
	<?php require("Nav.php");?>
	
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
				<li>
                    <a href="#" id="student-summary"></a>
                </li>
                <li class="sidebar-brand">
                    Select a Day:
                </li>
               
				<?php 
				// Added by David Hughen
				// The code to fetch the manager's events and put them in the sidebar to the left
				$stmt->bind_param("s", $id);
				$stmt->bind_result($count);
				$stmt->execute();

				while($stmt->fetch())
				{
					for($day = 1; $day <= $count; $day++)
					{
						echo '<li><div class=subject-name>Day: '.$day.'</div></li>';
					}
				}
				$stmt->close();
				?>
            </ul>
        </div>
		
        <!-- /#sidebar-wrapper -->

		  
		  <?php
			$eventStatement->bind_param("s", $eventId);
			$eventStatement->bind_result($eventName);
			$eventStatement->execute();
			while($eventStatement->fetch())
			{
				echo '<div class="course_header">
			<div class="class_name">'
				. $eventName . 
			'</div>
			</div>';
			}
			$eventStatement->close();
		?>
			
        <!-- Page Content -->
        <div id="page-content-wrapper">
		<!-- Keep page stuff under this div! -->
            <div class="container-fluid">
                <div class="row">
					
                                      
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<!-- our code starts here :) -->
					<table class="student_summary">
					
						<colgroup>
							<col class="classes" />
							<col class="recent_updates" />
						</colgroup>
						
						<thead>
						<tr>
							<th>Day</th>
							<th>Players</th>
							<th>Score</th>
						</tr>
						</thead>
						
						<tbody>
						<?php 
							// Code for table here
							$tableDateStmt->bind_param("ss", $eventId, $eventId);
							$tableDateStmt->bind_result($date);
							$tableDateStmt->execute();
							while($tableDateStmt->fetch())
							{
								echo '<tr><td>' . $date . '</td></tr>';
							}
							$tableDateStmt->close();
							
							
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