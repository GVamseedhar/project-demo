<?php
include('title.html');
$servername = "localhost";
$username = "root";
$password = "";
$dbname="cable_fault_detector";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else{
    $del_tbl1 = "DELETE FROM user_details WHERE 1;";
    echo"<script>
    let arr=[]
    arr.push('Clearing table User Details...');
    </script>";
    $flag=0;
    if ($conn->query($del_tbl1) === TRUE) {
        echo "<script>
                document.getElementById('out_msg').style.cssTEXT='color:rgb(6, 167, 6)';
                arr.push('Cleared table User details successfully');
              </script>";
      
      } else {
        echo "Error creating database: " . $conn->error;
        echo"<script>
            arr.push('Failed to cleared records');
          </script>";
        $flag=1;
      }


    $del_tbl2 = "DELETE FROM faults_record WHERE 1;";
    echo"<script>
    arr.push('Clearing table Faults record...');
    </script>";
    if ($conn->query($del_tbl1) === TRUE) {
        echo "<script>
                document.getElementById('out_msg').style.cssTEXT='color:rgb(6, 167, 6)';
                arr.push('Cleared table Faults record successfully');
              </script>";
      
      } else {
        echo "Error creating database: " . $conn->error;
        echo"<script>
            arr.push('Failed to cleared records');
          </script>";
        $flag=1;
      }

      
      $auto_inc = "ALTER TABLE faults_record AUTO_INCREMENT=1;";
    echo"<script>
    arr.push('Setting auto increment to 1...');
    </script>";
    if ($conn->query($auto_inc) === TRUE) {
        echo "<script>
                document.getElementById('out_msg').style.cssTEXT='color:rgb(6, 167, 6)';
                arr.push('Auto increment set to 1');
              </script>";
      
      } else {
        echo "Error creating database: " . $conn->error;
        echo"<script>
            arr.push('Failed to auto increment');
          </script>";
        $flag=1;
      }
      if($flag==0){
        echo "<script>
                document.getElementById('out_msg').style.cssTEXT='color:rgb(6, 167, 6)';
                arr.push('Cleared all records Successfully😀.');
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
}
?>
