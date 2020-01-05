<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book events</title>
</head>
<body>

<?php
include 'functions.php';
echo makePageStart("Welcome to North Events!","review.css");
echo makeHeader("North Events");
echo login("loginProcess.php","logout.php");
echo makeNavMenu("", array("index.php" => "Home", "bookEventsForm.php" => "Events", "credits.php" => "Credits", "form.php" => "Admin"));
echo startMain();
//Retrieve details for updating
// login admin1234
//password 45$Qr87$482d
$row[0] = filter_has_var(INPUT_GET, 'eventID') ? $_GET['eventID'] : null;
$row[1] = filter_has_var(INPUT_GET, 'eventTitle') ? $_GET['eventTitle'] : null;
$row[2] = filter_has_var(INPUT_GET, 'eventDescription') ? $_GET['eventDescription'] : null;
$row[3] = filter_has_var(INPUT_GET, 'venueName') ? $_GET['venueName'] : null;
$row[4] = filter_has_var(INPUT_GET, 'catDesc') ? $_GET['catDesc'] : null;
$row[5] = filter_has_var(INPUT_GET, 'eventStartDate') ? $_GET['eventStartDate'] : null;
$row[6] = filter_has_var(INPUT_GET, 'eventEndDate') ? $_GET['eventEndDate'] : null;
$row[7] = filter_has_var(INPUT_GET, 'eventPrice') ? $_GET['eventPrice'] : null;

$row[1] = trim($row[1]);
$row[2] = trim($row[2]);
$row[5] = trim($row[5]);
$row[6] = trim($row[6]);
$row[7] = trim($row[7]);

$row[1] = filter_var($row[1], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES );
$row[2] = filter_var($row[2], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$row[5] = filter_var($row[5], FILTER_SANITIZE_NUMBER_FLOAT);
$row[6] = filter_var($row[6], FILTER_SANITIZE_NUMBER_FLOAT);

$errors = false;

if (empty($row[1])) {
    echo "<p>You need to have selected a title.</p>\n";
    $errors = true;
}
if (empty($row[2])) {
    echo "<p>You need to choose a description.</p>\n";
    $errors = true;
}
if (empty($row[3])) {
    echo "<p>You need to choose a venue.</p>\n";
    $errors = true;
}

if (empty($row[5])) {
    echo "<p>You need to choose a start date.</p>\n";
    $errors = true;
}

if (empty($row[6])) {
    echo "<p>You need to choose an end date.</p>\n";
    $errors = true;
}
if (empty($row[7])) {
    echo "<p>You need to choose a price.</p>\n";
    $errors = true;
}
else if(!filter_var($row[7], FILTER_VALIDATE_FLOAT)) {
    echo "<p>The price should be a number</p>\n";
    $errors = true;

}
if ($errors === true) {
    echo "<p>Please try again.</p>\n";
}


else {
    try {
        require_once("functions.php");
        $dbConn = getConnection();
        $updateSQL = "UPDATE NE_events
                      JOIN NE_category ON NE_events.catID = NE_category.catID
                      JOIN NE_venue ON NE_events.venueID = NE_venue.venueID
                      SET eventID=:eventID, eventTitle = :eventTitle, eventDescription = :eventDescription, 
                         venueName = :venueName, catDesc =:catDesc, eventStartDate =:eventStartDate, eventEndDate = :eventEndDate, eventPrice = :eventPrice
                       WHERE eventID = :eventID";
        $stmt = $dbConn->prepare($updateSQL);
        $stmt->execute(array(
                             ':eventTitle' => $row [1],
                             ':eventDescription' => $row[2],
                             ':venueName' => $row[3],
                             ':catDesc' => $row[4],
                             ':eventStartDate' => $row[5] ,
                             ':eventEndDate' => $row[6],
                             ':eventPrice' => $row[7],
                             ':eventID' => $row[0]
                            )
                       );
        echo "<p>Movie updated</p>\n";
        }
    catch (Exception $e)
    {
        echo "<p>Movie not updated: " . $e->getMessage() . "</p>\n";
    }
}
echo endMain();
echo makeFooter("The North Events Company, Copyright ©<br> Aida Campean w18002348");
echo makePageEnd();
?>
</body>
</html>





