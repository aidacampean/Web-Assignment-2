<?php
include 'functions.php';      // make db connection
echo makePageStart("Welcome to North Events!", "review.css");
echo makeHeader("North Events");
echo login("loginProcess.php", "logout.php");
echo makeNavMenu("", array("index.php" => "Home", "bookEventsForm.php" => "Events", "" => "Credits", "form.php" => "Admin"));
echo startMain();

if (isset($_SESSION['username'])) {
    echo startMain();
    echo "<h3>Event Details</h3>";
    echo "<p>Choose an event to edit</p>";
    echo "<div style=\"overflow-x:auto;\">
      <table>
            <tr>
                    <th class='eventName'>Event</th>
                    <th class='venueName'>Venue</th>
                    <th class='catDesc'>Category</th>
                    <th class='eventStartdate'>Start Date</th>
                    <th class='eventEndDate'>End Date</th>
                    <th class='eventPrice'>Price</th>
            </tr>
      </table>
      </div>\n";
    try {
        require_once('functions.php');
        $dbConn = getConnection();

        $selectSQL = "SELECT eventID, eventTitle, venueName, catDesc,
                             eventStartDate, eventEndDate, eventPrice FROM NE_events
                             JOIN NE_category ON NE_events.catID = NE_category.catID
                             JOIN NE_venue ON NE_events.venueID = NE_venue.venueID
                             ORDER BY eventTitle";
        $stmt = $dbConn->query($selectSQL);

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo "<div>
                    <table>
                    <tr>
                    <td class='e1'><a href='editEvent.php?eventID={$row[0]}'>$row[1]</a></td>
                    <td class='e2'>$row[2]</td>
                    <td class='e3'>$row[3]</td>
                    <td class='e4'>$row[4]</td>
                    <td class='e5'>$row[5]</td>
                    <td class='e6'>$row[6]</td>
                    </tr>
                    </table>
                </div>\n";
        }
    } catch (Exception $e) {
        log_error($e);
        $errors[] = "Connection error";
        echo "Error " . $e->getMessage();
    }
} else {
    echo "<p>You have to log in before accessing the data.</p>";
}
echo endMain();
echo makeFooter("The North Events Company, Copyright ©<br> Aida Campean w18002348");
echo makePageEnd();




