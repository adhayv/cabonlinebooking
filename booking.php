<!-- This file deals with the database functionality on the booking side. It creates a table and inserts the user entered data -->
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

	// Checking if table exists, if not create it 
	$bookingTable = "CREATE TABLE IF NOT EXISTS booking(
		BookingRef INT PRIMARY KEY AUTO_INCREMENT,
		CusName VARCHAR(100) NOT NULL,
		PhoneNo INT(15) NOT NULL,
		UnitNo INT(10),
		StreetNo INT(10) NOT NULL,
		StreetName VARCHAR(100) NOT NULL,
		SubName VARCHAR(100) NOT NULL,
		DesSubName VARCHAR(100) NOT NULL,
		PUDate DATE NOT NULL,
		PUTime TIME NOT NULL,
		TimeBooked DATETIME NOT NULL,
		Status VARCHAR(50) DEFAULT 'unassigned'
		);";

	$create = mysqli_query($conn, $bookingTable);
	
	//Checking if creating the table works
	if (!$create) {
		
		//If previous query doesn't work send this message
		echo "Database query failure.";
	} else {

		//Getting values needed for database
		$name = $_POST['cname'];
		$phone = $_POST['phone'];
		$unitNo = $_POST['unumber'];
		$streetNo = $_POST['snumber'];
		$streetName = $_POST['stname'];
		$subName = $_POST['sbname'];
		$desSubName = $_POST['dsbname'];
		$time = $_POST['time'];
		$date = $_POST['date'];
		$timeBooked = date("Y-m-d h:i:sa");
		$status = "unassigned";

		$enterBooking = "INSERT INTO booking (CusName, PhoneNo, UnitNo, StreetNo, StreetName, SubName, DesSubName, PUDate, PUTime, TimeBooked, Status)
		VALUES ('$name', '$phone', '$unitNo', '$streetNo', '$streetName', '$subName', '$desSubName', '$date', '$time', '$timeBooked', '$status');";

		// Inserting data into database query
		$addEntry = mysqli_query($conn, $enterBooking);

		//If entering data works continue with program
		if (!$addEntry) {
			echo "Database query failure, data cannot be inserted";

		} else {
			echo "<h2>Your booking has been made!</h2>";

			//Query for getting the newly entered data
			$newData = "SELECT BookingRef, PUTime, PUDate 
						FROM booking 
						ORDER BY BookingRef DESC 
						LIMIT 1;";
			
			$getNewData = mysqli_query($conn, $newData);

			//If data has been entered showing conformation information
			while ($row = mysqli_fetch_assoc($getNewData)) {
				echo "<br><h3>Thank you! Your booking reference number is <i style=\"color:green;\">" . $row["BookingRef"] . "</i>. You will be picked up in front of your provided address
				at <i style=\"color:green;\">" . $row["PUTime"] . "</i> on <i style=\"color:green;\">" . $row["PUDate"] . "</i></h3>";
			}
		}
	}
}

mysqli_close($conn);

?>