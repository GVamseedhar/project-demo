
<?php
include('title.html');
$servername = "localhost";
$username = "root";
$password = "";
$dbname="cable_fault_detector";
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$flag=0;
// Create database
$create_db = "CREATE DATABASE IF NOT EXISTS cable_fault_detector";
echo"<script>
let arr=[]
arr.push('Creating Database...');
</script>";
if ($conn->query($create_db) === TRUE) {
  echo "<script>
          document.getElementById('out_msg').style.cssTEXT='color:rgb(6, 167, 6)';
          arr.push('Database created successfully');
        </script>";

} else {
  echo "Error creating database: " . $conn->error;
  echo"<script>
      arr.push('Database creation failed');
    </script>";
  $flag=1;
}
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
$create_user_details="CREATE TABLE IF NOT EXISTS user_details(full_name text,service_area text,username text,email text,phno text,dob date,password text,gender text,time datetime DEFAULT current_timestamp())";
echo"<script>
  arr.push('Creating table User details...');
</script>";
if ($conn->query($create_user_details) === TRUE) {
  echo "<script>
          document.getElementById('out_msg').style.cssTEXT='color:rgb(6, 167, 6)';
          arr.push('Table User details created successfully');
        </script>";

  } else {
    echo "Error creating table: " . $conn->error;
    echo"<script>
      arr.push('Failed creating table User details');
    </script>";
    $flag=1;
  }
$create_faults_record="CREATE TABLE IF NOT EXISTS faults_record(sno int(11) AUTO_INCREMENT PRIMARY KEY,wire text,dist text,date date,time time,status text DEFAULT 'IN PROGRESS',update_status varchar(10) DEFAULT 0,completed_date date,completed_time time,updated_by text)";
echo"<script>
      arr.push('Creating table Faults record...');
    </script>";
if ($conn->query($create_faults_record) === TRUE) {
  echo "<script>
          document.getElementById('out_msg').style.cssTEXT='color:rgb(6, 167, 6)';
          arr.push('Table faults record created successfully');
        </script>";

  } else {
    echo "Error creating table: " . $conn->error;
    echo"<script>
      arr.push('Failed creating table Faults record');
    </script>";
    $flag=1;
  }
  if($flag==0){
  echo "<script>
          document.getElementById('out_msg').style.cssTEXT='color:rgb(6, 167, 6)';
          arr.push('Project installed successfully 😀.');
          let time = 6; 
          let i=0;
                    let counter;
                    function countDownTimer() {
	                let display = document.getElementById('out_msg');
	                display.innerHTML = arr[i];
                	time--;
                  i++;
                	if (time < 0) {
		            clearInterval(counter);
	                }
                    }		
                    function startTimer() {
                	counter = setInterval(countDownTimer, 800);
                    }
                    startTimer();	
        </script>";
  }
  else{
    echo "<script>
          document.getElementById('out_msg').style.cssTEXT='color:red';
          document.getElementById('out_msg').innerHTML='Project installation failed';
        </script>";
  }
?>