<!-- Created By Victor Jereza, universal nav bar-->
<!-- Currently affects, teacher and student main pages, and student class page -->

<div id="wrapper2">
	 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
		   <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<a href="#menu-toggle" class="navbar-brand" id="menu-toggle">
					<div id="logo-area">
						<img src="images/golfBallLogo.jpg" alt="Our Logo" height="45" width="45">
						<span class="TestRepublic">Fantasy Golf</span>
					</div>
				</a>
			</div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
					<?php // Added by David Hughen
						  // to display student's name in top right corner

							if ($topRightStatement = $database->prepare($topRightQuery)) 
														{
															$topRightStatement->bind_param("s", $id);
														}
														else {
															printf("Errormessage: %s\n", $database->error);
														}							
											$topRightStatement->bind_result($first_name, $last_name);
											$topRightStatement->execute();
											while($topRightStatement->fetch())
											{
												echo $first_name . " " . $last_name . ", ". $id." ";
											}
											$topRightStatement->close();?><b class="caret"></b></a>
						
                    <ul class="dropdown-menu">
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
	</div>	