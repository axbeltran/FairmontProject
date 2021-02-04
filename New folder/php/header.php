<div class="login-container">
 <div class="row">
 <div class="column">
<?php				
	session_start();
	
	if (isset($_SESSION['UID'])) {
		echo '<form action="http://localhost:8080/FairMont%20Community%20Project/php/logout.php" method="post">
			<div class="container">
				<button name="logout-submit" type="submit">Logout</button>
			</div>
			</form>';
	}
	else {
			echo '<form action="http://localhost:8080/FairMont%20Community%20Project/php/login.php" method="post">
				<label for="username" value="username"><b>Username or Email</b></label>
				<input type="text" placeholder="Enter Username or Email" name="username" required>
				<label for="psw"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="psw" required>
				<button name="login-submit" type="submit">Login</button>
				<a href="http://localhost:8080/FairMont%20Community%20Project/reset-password.html">Forgot password?</a><br>

			<button onclick="window.location.href="http://localhost:8080/FairMont%20Community%20Project/Registration.html"" /><a href="Registration.html">Register</a></button>
						</form>
			
			';
	}
?>	
</div>
  <div class="column">
  <img src="img/FCPG Logo.png" alt="FCPG Logo">
</div>
</div>
</div> 

<div class="topnav">
	<?php
		if (isset($_SESSION['UID'])) {
			echo '<h1> Hello'." ".$_SESSION['fName']." ".$_SESSION['lName']." ".$_SESSION['AccessLevel'].'</h1><a href="http://localhost:8080/FairMont%20Community%20Project/Profile.html"> Edit Profile</a>';
		}
	?>
	<nav><ul>
		<li><a href="Main.html">Home</a></li>
		<li><a href="Services.html">Services</a></li>
		<li><a href="https://www.paypal.com/paypalme/FairmontCommunity/">Donations</a></li>
		<li><a href="History.html">History</a></li>
		<li><a href="SocialWorker.html">Social&nbsp;Worker</a></li>
		<li><a href="eventsCalendar.php">Events</a></li>
		<li><a href="MonthlyMeetings.html">Monthly&nbsp;Meetings</a></li>
		<li><a href="https://www.fsd89.org/">School</a></li>
	</ul></nav>
</div>
