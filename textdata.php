<?php
$email=$_POST['email'];
$text=$_POST['text'];
if (!empty($email) || !empty($text)) {

$host='localhost';
$user='root';
$pass='';
$db='mydb3';
$conn= new mysqli($host,$user,$pass,$db);
if (mysqli_connect_error()) 
{
	die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
}
else{
	$SELECT="SELECT email  From mydata Where email=? Limit 1";
	$INSERT="INSERT Into mydata(email,text)value(?,?)";
	//prepare statement
	$stmt=$conn->prepare($SELECT);
	$stmt->bind_param("s",$email);
	$stmt->execute();
	$stmt->bind_result($email);
	$stmt->store_result();
	$rnum=$stmt->num_rows;
	if ($rnum==0) {
		$stmt->close();
		$stmt=$conn->prepare($INSERT);
	    $stmt->bind_param("ss",$email,$text);
	    $stmt->execute();
	    echo "new record inserted successfully";
	}
	else
	{
		echo "someone already registered";
	}
	$stmt->close();
	$conn->close();;
}
}
else
	{
		echo "All feild are required";
		die();
	}
?>