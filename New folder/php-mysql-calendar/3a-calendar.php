<?php
// MONTHS
$months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

// DEFAULT MONTH/YEAR = TODAY
$unix = strtotime("today");
$monthNow = date("M", $unix);
$yearNow = date("Y", $unix); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Simple PHP Calendar</title>
    <script src="public/3b-calendar.js"></script>
    <link href="public/3c-theme.css" rel="stylesheet">
  </head>
  <body>
<h1>
Fairmount
<br>
Community
</h1>
<!--<img src=".jpg" alt="" width="600" height="600">-->
<h2>
Hello
</h2>
<script>
document.write(); // Name goes here
</script>
<nav><ul>
    <li><a href="../Services.html">Services</a></li>
    <li><a href="../Donations.html">Donations</a></li>
	<li><a href="../History.html">History</a></li>
	<li><a href="../SocialWorker.html">Social&nbsp;Worker</a></li>
	<li><a href="3a-calendar.php">Events</a></li>
	<li><a href="../MonthlyMeetings.html">Monthly&nbsp;Meetings</a></li>
	<li><a href="../School.html">School</a></li>
</ul></nav>
    <!-- [DATE SELECTOR] -->
    <div id="selector">
      <select id="month"><?php
        foreach ($months as $m) {
          printf("<option %svalue='%s'>%s</option>", 
            $m==$monthNow ? "selected='selected' " : "", $m, $m
          );
        }
      ?></select>
      <select id="year"><?php
        // 10 years range - change if not enough for you
        for ($y=$yearNow-10; $y<=$yearNow+10; $y++) {
          printf("<option %svalue='%s'>%s</option>",
            $y==$yearNow ? "selected='selected' " : "", $y, $y
          );
        }
      ?></select>
      <input type="button" value="SET" onclick="cal.list()"/>
    </div>

    <!-- [CALENDAR] -->
    <div id="container"></div>

    <!-- [EVENT] -->
    <div id="event"></div>
  </body>
</html>