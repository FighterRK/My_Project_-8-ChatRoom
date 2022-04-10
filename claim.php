<?php
$Room=$_POST['Room'];


if (strlen($Room)>20 or strlen($Room)<2)
{
	$message="Please Choose A Name Between 2 to 20 character";
	echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom"';

	echo '</script>';

}
elseif (!ctype_alnum($Room)) 
{
	$message="Please Choose Alphanumeric Room Name";
	echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom"';
	echo '</script>';
}

else
{
	// connecting to db
	include 'db_connect.php';
}

// check room already exist in database

$sql = " SELECT * FROM `rooms` WHERE roomname = '$Room'";
$result = mysqli_query($conn, $sql);
if($result)
{
	if (mysqli_num_rows($result)>0)
	 {
		$message="Please Choose a Different room This Room Is Already Claimed";
		echo '<script language="javascript">';
	    echo 'alert("'.$message.'");';
	    echo 'window.location="http://localhost/chatroom"';
		echo '</script>';
	}

	else
	{
		$sql = "INSERT INTO `rooms` ( `roomname`, `stime`) VALUES ( '$Room', current_timestamp()); ";

		if (mysqli_query($conn,$sql)) 
		{
			$message="Your Room Is Ready And Can Chat Now !!!";
			echo '<script language="javascript">';
		    echo 'alert("'.$message.'");';
		    echo 'window.location="http://localhost/chatroom/rooms.php?roomname=' . $Room . '";';
			echo '</script>';
		}
	}
}

else
{
	echo "Error: ".mysqli_error($conn);
}

?>

