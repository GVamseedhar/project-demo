<?php
include('forgotpswd.html');
error_reporting(0);
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
                $flag=0;
                $username=$_POST['username'];
                $dob=$_POST['dob'];
                $pswd=$_POST['pswd'];
                $check_username="select * from user_details where username='$username'";
                $checkdob="select * from user_details where username='$username' and dob='$dob'";
                $updatepswd="update user_details set password='$pswd' where username='$username'";
                $result=mysqli_query($conn,$check_username);
                $result2=mysqli_query($conn,$checkdob);
                $count=mysqli_num_rows($result);
                if($count==0){
                    echo"<script>
                    document.querySelector('#lbl1').style.cssText='color:red';
                    document.getElementById('er_msg1').innerHTML='Username does not exist';
                    document.getElementById('user_name').value='$username';
                    document.getElementById('dob').value='$dob';
                    document.getElementById('pswd').value='$pswd';
                    document.getElementById('cnf_pswd').value='$pswd';
                    document.getElementById('username').focus();
                    </script>";
                    $flag=1;
                }
                else{
                    $count=mysqli_num_rows($result2);
                    if($count==0){
                        echo"<script>
                        document.querySelector('#lbl2').style.cssText='color:red';
                        document.getElementById('er_msg1').innerHTML='Incorrect date of birth';
                        document.getElementById('user_name').value='$username';
                        document.getElementById('dob').value='$dob';
                        document.getElementById('pswd').value='$pswd';
                        document.getElementById('cnf_pswd').value='$pswd';
                        </script>";
                        $flag=1;
                    }
                }
                if($flag==0){
                    mysqli_query($conn,$updatepswd);
                    $msg="password updated successfully";
                    echo"<script>
                    document.querySelector('#er_msg1').style.cssText='color:green';
                    document.getElementById('er_msg1').innerHTML='Password updated successfully<br>redirecting to login page in 5 seconds';
                    var text='Password updated successfully<br>redirecting to login page in ';
                    var text2=' seconds';
                    let time = 5; 
                    let counter;
                    function countDownTimer() {
	                let display = document.getElementById('er_msg1');
	                display.innerHTML = text+time+text2;
                	time--;
                	if (time < 0) {
		            clearInterval(counter);
            		window.location.href = 'adminlogin.html';
	                }
                    }		
                    function startTimer() {
                	counter = setInterval(countDownTimer, 1000);
                    }
                    startTimer();	
                    </script>";
                }

             }

             ?>