<?php
session_start();
include('adminlogin.html');
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
                $pswd=$_POST['pswd'];
                $check_username="select * from user_details where username='$username'";
                $checkuser="select * from user_details where username='$username' and password='$pswd'";
                $result=mysqli_query($conn,$check_username);
                $result2=mysqli_query($conn,$checkuser);
                $count=mysqli_num_rows($result);
                if($count==0){
                    echo"<script>
                    document.getElementById('er_msg1').innerHTML='Username does not exist';
                    document.getElementById('user_name').value='$username';
                    document.getElementById('password').value='$pswd';
                    document.getElementById('username').focus();
                    </script>";
                    $flag=1;
                }
                else{
                    $count=mysqli_num_rows($result2);
                    if($count==0){
                        echo"<script>
                        document.getElementById('er_msg1').innerHTML='Incorrect password';
                        document.getElementById('user_name').value='$username';
                        document.getElementById('password').value='$pswd';
                        </script>";
                        $flag=1;
                    }
                }
                $row=mysqli_fetch_assoc($result2);
                if($flag==0){
                if($row['service_area']!="Admin"){
                    echo"<script>
                    document.getElementById('er_msg1').innerHTML='Access Denied. You are not an admin';
                    document.getElementById('user_name').value='$username';
                    document.getElementById('password').value='$pswd';
                    </script>";
                    $flag=1;
                }    
                }


                if($flag==0){
                    $_SESSION["username"]=$username;
                    if(isset($_SESSION["username"])){
                        echo "<script>location.replace('home page1.php')</script>";
                    }
                }
        }

             ?>