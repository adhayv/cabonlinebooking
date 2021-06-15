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
    echo "<script>alert(\"Connection failure\")</script>";
} else {

    $refNo = $_POST['bookingRef'];
    //Updating the unassigned to assigned for the corresponding reference number
    $findData = "UPDATE booking
        SET Status = 'assigned'
        WHERE BookingRef=$refNo;";

    //Running query and checking if it runs. If it does change to assigned otherwise alert the user.
    $getFoundData = mysqli_query($conn, $findData);
    if (!$getFoundData) {
        echo "<script>alert(\"Assigning failed, try again\")</script>";
    } else {
        echo "assigned";
    }
}

mysqli_close($conn);
