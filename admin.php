<!-- This file deals with the database functionality on the booking side. It creates a table and inserts the user entered data -->
<script type="text/javascript" src="admin.js"></script>
<?php
require_once("../../conf/settings.php");

// Connects to database 
$conn = @mysqli_connect(
    $host,
    $user,
    $pswd,
    $dbnm
);

if (!$conn) {
    // Displays an error message if connections fails
    echo "<p>Database connection failure. Services may be down.</p>";
} else {

    $refNo = $_POST['bsearch'];
    
    //Creating the query for finding the entered input
    $findData = "SELECT * FROM booking 
        WHERE BookingRef=$refNo;";

    $getFoundData = mysqli_query($conn, $findData);

    //Checking if query has anything entered, if not it displays something else
    if (!$getFoundData) {

        //Creating query to select unassigned and record that need pickup within 2 hours from now
        $getUnassigned = "SELECT *
        FROM booking
        WHERE STATUS = 'unassigned'
        AND (CAST( PUDate AS DATETIME ) + CAST( PUTime AS DATETIME))
        BETWEEN NOW() AND DATE_ADD( NOW() , INTERVAL 2 HOUR );";

        $sqlGetUnassigned = mysqli_query($conn, $getUnassigned);

        //Creating a table to display the output
        echo "<h2 class=\"betterText\" style=\"font-size:20px\">Found Reference</h2>";
        echo "<table>";
        echo "<tr>\n"
            . "<th scope=\"col\">Booking Reference Number</th>"
            . "<th scope=\"col\">Customer Name</th>"
            . "<th scope=\"col\">Phone</th>"
            . "<th scope=\"col\">Pick-up Suburb</th>"
            . "<th scope=\"col\">Destination Suburb</th>"
            . "<th scope=\"col\">Pick-Up Date/Time</th>"
            . "<th scope=\"col\">Status</th>"
            . "<th scope=\"col\">Assign</th>"
            . "</tr>\n";

        while ($row = mysqli_fetch_assoc($sqlGetUnassigned)) {
            //Putting values in table, the last value is a button which can be pressed to change the corresponding unassigned to assigned 
            echo "<tr>
                <td>" . $row["BookingRef"] . "</td>
                <td>" . $row["CusName"] . "</td>
                <td>" . $row["PhoneNo"] . "</td>
                <td>" . $row["SubName"] . "</td>
                <td>" . $row["DesSubName"] . "</td>
                <td>" . $row["PUDate"] . $row["PUTime"] . "</td>
                <td id=\"assign" . $row["BookingRef"] . "\">" . $row["Status"] . "</td>
                <td><input type=\"button\" styles=\"width:70%;\" name=\"assignbutton\" 
                onclick=\"updateAssign('adminassign.php' , 'assign" . $row["BookingRef"] . "', '" . $row["BookingRef"] . "')\" value=\"Assign\"></td></tr>
        ";
        }
        echo "</table>";
        mysqli_free_result($sqlGetUnassigned);
    } else {
        //This displays the output if a booking reference is entered
        echo "<h2 class=\"betterText\" style=\"font-size:20px\">Found Reference</h2>";
        echo "<table>";
        echo "<tr>\n"
            . "<th scope=\"col\">Booking Reference Number</th>"
            . "<th scope=\"col\">Customer Name</th>"
            . "<th scope=\"col\">Phone</th>"
            . "<th scope=\"col\">Pick-up Suburb</th>"
            . "<th scope=\"col\">Destination Suburb</th>"
            . "<th scope=\"col\">Pick-Up Date/Time</th>"
            . "<th scope=\"col\">Status</th>"
            . "</tr>\n";

        while ($row = mysqli_fetch_assoc($getFoundData)) {
            echo "<tr>
                <td>" . $row["BookingRef"] . "</td>
                <td>" . $row["CusName"] . "</td>
                <td>" . $row["PhoneNo"] . "</td>
                <td>" . $row["SubName"] . "</td>
                <td>" . $row["DesSubName"] . "</td>
                <td>" . $row["PUDate"] . $row["PUTime"] . "</td>
                <td>" . $row["Status"] . "</td>
            ";
        }
        echo "</table>";
        mysqli_free_result($getFoundData);
    }
}

mysqli_close($conn);

?>