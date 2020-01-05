<?php
require_once('functions.php');
echo makePageStart("Welcome to North Events!","review.css");
echo makeHeader("North Events");
echo login("loginProcess.php","logout.php");
echo makeNavMenu("", array("index.php" => "Home", "bookEventsForm.php" => "Events", "credits.php" => "Credits", "form.php" => "Admin"));
echo startMain();
?>
<h1 id="credits">References used</h1>
<p id="credits1">1.stackoverflow. (2019, December 15). "Back to previous page with header( “Location: ” ); in PHP". Retrieved from : https://stackoverflow.com/questions/5285031/back-to-previous-page-with-header-location-in-php.</p>
<p id="credits2">2.w3schools. (2019, December 15). Retrieved from: https://www.w3schools.com/.</p>
<?php
echo endMain();
echo makeFooter("The North Events Company, Copyright ©<br> Aida Campean w18002348");
echo makePageEnd();
?>
