<?php
session_start();
include('mylogin.html');
             $host = "localhost";		         // host = localhost because database hosted on the same server where PHP files are hosted
             $dbname = "cable_fault_detector";              // Database name
             $username = "root";		// Database username
             $password = "";	 
             $conn = new mysqli($host, $username, $password, $dbname);
             $full_name=$_POST['full_name'];
             $service_area=$_POST['service_area'];
             $username=$_POST['username'];
             $email=$_POST['email'];
             $phno=$_POST['phno'];
             $dob=$_POST['dob'];
             $pswd=$_POST['pswd'];
             $gender=$_POST['gender'];
             $flag=0;
             if($conn->connect_error)
             {
                 die('connection failed :'.$conn->connect_error);
             }
             else{
                $check_email="select * from user_details where email='$email'";
                $check_username="select * from user_details where username='$username'";
                $insert="insert into user_details(full_name,service_area,username,email,phno,dob,password,gender) values('$full_name','$service_area','$username','$email','$phno','$dob','$pswd','$gender')";
                $result=mysqli_query($conn,$check_email);
                $result2=mysqli_query($conn,$check_username);
                $count=mysqli_num_rows($result);
                echo"
                <script>
                    document.getElementById('email').style.borderColor='black';
                    document.getElementById('username').style.borderColor='black';
                    </script>";
                if($count>0)
                {
                echo"<script>
                document.getElementById('email').focus();
                    document.getElementById('email').style.borderColor='red';
                    document.getElementById('er_msg').innerHTML='A user with this email address already exists';
                    document.querySelector('#rotate').style.cssText='transform:perspective(500px) rotateY(180deg)';
                    document.getElementById('full_name').value='$full_name';
                    document.getElementById('service_area').value='$service_area';
                    document.getElementById('username').value='$username';
                    document.getElementById('email').value='$email';
                    document.getElementById('phno').value='$phno';
                    document.getElementById('dob').value='$dob';
                    document.getElementById('pswd').value='$pswd';
                    document.getElementById('cnf_pswd').value='$pswd';
                    </script>";
                    if($gender=="Male"){
                        echo"<script>
                        document.getElementById('Male').checked='true';
                        </script>";
                    }
                    else{
                        echo"<script>
                        document.getElementById('Female').checked='true';
                        </script>";
                    }
                    $flag=1;
                }
                $count2=mysqli_num_rows($result2);
                    if($count2>0)
                {
                    echo"<script>
                    document.getElementById('username').focus();
                    document.getElementById('username').style.borderColor='red';
                    document.getElementById('er_msg').innerHTML='This username is already taken ';
                    document.querySelector('#rotate').style.cssText='transform:perspective(500px) rotateY(180deg)';
                    document.getElementById('full_name').value='$full_name';
                    document.getElementById('service_area').value='$service_area';
                    document.getElementById('username').value='$username';
                    document.getElementById('email').value='$email';
                    document.getElementById('phno').value='$phno';
                    document.getElementById('dob').value='$dob';
                    document.getElementById('pswd').value='$pswd';
                    document.getElementById('cnf_pswd').value='$pswd';
                    </script>";
                    if($gender=="Male"){
                        echo"<script>
                        document.getElementById('Male').checked='true';
                        </script>";
                    }
                    else{
                        echo"<script>
                        document.getElementById('Female').checked='true';
                        </script>";
                    }
                    $flag=1;
                }
                if($flag==0){
                mysqli_query($conn,$insert);
                $_SESSION["username"]=$username;
                if(isset($_SESSION["username"])){
                    echo "<script>location.replace('home2.php')</script>";
                }
                }
                }
             ?>