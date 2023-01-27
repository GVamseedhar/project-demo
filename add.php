<?php
session_start();
$host = "localhost";		         // host = localhost because database hosted on the same server where PHP files are hosted
$dbname = "cable_fault_detector";              // Database name
$username = "root";		// Database username
$password = "";	 
$conn = new mysqli($host, $username, $password, $dbname);
if($conn->connect_error)
{
    die('connection failed :'.$conn->connect_error);
}
else{
    $username=$_SESSION["username"];
    $val=$_POST["btn"];
    date_default_timezone_set('Asia/Kolkata');  
    $d = date("Y-m-d");
    $t = date("H:i:s");
    $sql="UPDATE faults_record SET status='COMPLETED',update_status='1',completed_date='".$d."',completed_time='".$t."',updated_by='".$username."' WHERE sno=$val";
    if ($conn->query($sql) === TRUE) {
        echo "Values inserted in MySQL database table.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } 
    header('Location:home page2.php');
}

?>