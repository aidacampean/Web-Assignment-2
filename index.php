<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book events</title>
    <link rel="stylesheet" href="review.css" type="text/css">
</head>
<body>
<?php
require_once('functions.php');
echo makePageStart("Welcome to North Events!","review.css");
echo makeHeader("North Events");
echo login("loginProcess.php","logout.php");
echo makeNavMenu("", array("index.php" => "Home", "bookEventsForm.php" => "Events", "credits.php" => "Credits", "form.php" => "Admin"));
echo startMain();
?>
<h2 id="sub">You will find the latest events and shows coming up on our website.</h2>
<script src = AJAX.js></script>
<aside id="offers"><h3 id="html">Offers</h3>
<div id="offerHTML"></div>
</aside>
<aside id="xmloffers"><h3 id="xml">XML Offers</h3>
<div id="offerXML"></div>
</aside>


<?php
echo endMain();
echo makeFooter("The North Events Company, Copyright ©<br> Aida Campean w18002348");
echo makePageEnd();
?>
</body>
</html>
