<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
require_once "../../config.php";

// get the post records
$s_type = $_POST['seat'];
$rs = $_POST['match'];

mysqli_autocommit($link,FALSE);
// database insert SQL code
$sql = "INSERT INTO `ticket` (`ticket_id`, `reservation_id`, `seat_type`) VALUES ('0', '$rs', '$s_type')";

// insert in database 
$rs = mysqli_query($link, $sql);

if($rs)
{
	mysqli_commit($link);
	echo "Ticket booked Successfully";
}
else
{
	mysqli_rollback($link);
	echo "no success";
}


?>