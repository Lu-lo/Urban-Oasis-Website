<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Main</title>
    <link rel="stylesheet" href="css/skel.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php 
session_start();

// if there is no logged in session, redirect to login page
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit();
}

//open sql connection
$mysqli = new mysqli ("localhost", "dbuser", "password", "userdb");
								
if ($mysqli->connect_error) {
    print "Error is: " . $mysqli->connect_error;
    exit();
}
else {
    // get username and id from session array
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];

    // get user's count from db and assign to $count variable
    $stmt = $mysqli->prepare("SELECT count FROM user WHERE userid = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($count);
    $stmt->fetch();
}

?>
	<div id="header">
		<div class="container">
						
			<!-- Logo -->
			<h1><a href="index.html"><img src="images/logo.png" width="400"></a></h1>
					
			<!-- Nav -->
			<nav id="nav">
				<ul>
					<li><a href="index.html">Home</a>
						<ul>
							<li><a href="main.php">Dashboard</a></li>
						</ul>
					</li>
					<li><a href="left-sidebar.html">About Us</a></li>
					<li>
						<a href="Services.html">Services</a>
						<ul>
							<li><a href="ServicesDetails.html#bartending">Bartending</a></li>
							<li><a href="ServicesDetails.html#catering">Catering</a></li>
							<li><a href="ServicesDetails.html#entertainment">Entertainment</a></li>
							<li><a href="ServicesDetails.html#photography">Photography</a></li>
						</ul>
					</li>
					<li><a href="contact-us.html">Contact Us</a></li>
				</ul>
			</nav>
		</div>
	</div>

	<div class="wrapper style1">
		<div class="container">

			<br>
			<h2>Welcome back, <?php print $username; ?>!</h2>
			<br>

			<!--when button clicked, go to code for incrementing count-->
			<form action="code.php" method="post">
    			<button type="submit" class="button alt" name="click">CLICK ME!</button>
				<br><br>
    			<div id="content" class="8u skel-cell-important">
   		 			<!--display user's current count-->
    				<p> Count: <?php print $count; ?></p>
				</div>
			</form>
			<br>

			<form action="logout.php" method="post">
    			<button type="submit" class="button small" name="logout">logout</button>
				<br><br>
			</form>
		</div>
	</div>

	<!-- Footer -->
	<div id="footer">
		<div class="container">

		<!-- Lists -->
			<div class="row">
				<div class="8u">
					<section>
						<header class="major">
							<h2>Urban Oasis</h2>
							<span class="byline">Event Venue</span>
						</header>
						<div class="row">
							<section class="6u">
								<ul class="default">
									<li><a href="Services.html#inquiryButton">Submit An Inquiry</a></li>
									<li><a href="Services.html">Check Out Our Services</a></li>
									<li><a href="ServicesDetails.html">View Available Service Packages</a></li>
								</ul>
							</section>
						</div>
					</section>
				</div>
				<div class="4u">
					<section>
						<header class="major">
							<h2>Get In Touch</h2>
							<span class="byline">Book With Us Today</span>
						</header>
						<ul class="contact">
							<li>
								<span class="address">Address</span>
								<span>1811 Nordhoff St <br />Northridge, CA 91330</span>
							</li>
							<li>
								<span class="mail">Mail</span>
								<span><a href="contact-us.html">Contact US</a></span>
							</li>
							<li>
								<span class="phone">Phone</span>
								<span>(123) 456-7890</span>
							</li>
						</ul>	
					</section>
				</div>
			</div>

					<!-- Copyright
						<div class="copyright">
							Design: <a href="http://templated.co">TEMPLATED</a> Images: <a href="http://unsplash.com">Unsplash</a> (<a href="http://unsplash.com/cc0">CC0</a>)
						</div> -->

		</div>
	</div>

</body>
</html>
