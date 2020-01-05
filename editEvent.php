<?php
include 'functions.php';	  // make db connection
echo makePageStart("Welcome to North Events!","review.css");
echo makeHeader("North Events");
echo login("loginProcess.php","logout.php");
echo makeNavMenu("", array("index.php" => "Home", "bookEventsForm.php" => "Events", "credits.php" => "Credits", "form.php" => "Admin"));
echo startMain();
if(isset($_SESSION['username'])) {
    try {
        require_once('functions.php');
        $row[0] = filter_has_var(INPUT_GET, 'eventID') ? $_GET['eventID'] : null;
        $dbConn = getConnection();
        $selectSQL = "SELECT eventID, eventTitle,eventDescription, venueName, catDesc,
                             eventStartDate, eventEndDate, eventPrice
                      FROM NE_events
                      JOIN NE_category ON NE_events.catID = NE_category.catID
                      JOIN NE_venue ON NE_events.venueID = NE_venue.venueID
                      WHERE eventID = $row[0]";
        $stmt = $dbConn->query($selectSQL);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        echo " 
        <form id='editForm' action='updateEvent.php' method='get'>
              <p>ID <input type='text' name='eventID' value='{$row[0]}' readonly/></p>
              <p>Title <input type='text' name='eventTitle' value='{$row[1]}'/></p>
              <p>Description <input type='text' name='eventDescription' value='{$row[2]}'/></p>
              <p>Venue
              <select name=\"venueName\">
                 <option value= '{$row[3]}'>Theatre Royal</option>
                 <option value='{$row[3]}'>BALTIC Centre for Contemporary Art</option>
                 <option value='{$row[3]}'>Laing Art Gallery</option>
                 <option value='{$row[3]}'>The Biscuit Factory</option>
                 <option value='{$row[3]}'>Discovery Museum</option>
                 <option value='{$row[3]}'>HMS Calliope</option>
                 <option value='{$row[3]}'>Utilita Arena Newcastle</option>
                 <option value='{$row[3]}'>Mill Volvo Tyne Theatre</option>
                 <option value='{$row[3]}'>PLAYHOUSE Whitley Bay</option>
                 <option value='{$row[3]}'>Shipley Art Gallery</option>
                 <option value='{$row[3]}'>Seven Stories</option>
                </select></p>
              
              <p>Category
              <select name=\"catDesc\">
                 <option value= '{$row[4]}'>Carnival</option>
                 <option value='{$row[4]}'>Theatre</option>
                 <option value='{$row[4]}'>Comedy</option>
                 <option value='{$row[4]}'>Exhibition</option>
                 <option value='{$row[4]}'>Family</option>
                 <option value='{$row[4]}'>Music</option>
                 <option value='{$row[4]}'>Sport</option>
                 <option value='{$row[4]}'>Dance</option>
                </select></p>
              <p>Start Date <input type='text' name='eventStartDate' value='{$row[5]}'/></p>
              <p>End Date <input type='text' name='eventEndDate' value='{$row[6]}'/></p>
              <p>Price <input type='text' name='eventPrice' value='{$row[7]}'/></p>
              <p><input type='submit' name='submit' value='Update Movie'></p>             
         </form>";
    } catch (Exception $e) {
        echo "<p>Movie details not found: ".$e->getMessage()."</p>\n";
    }
}
else {
    echo "<p>You have to log in before accessing the data.</p>";
}

echo endMain();
echo makeFooter("The North Events Company, Copyright ©<br> Aida Campean w18002348");
echo makePageEnd();



