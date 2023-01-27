<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cable fault record</title>
    <link rel="stylesheet" href="home page2styles.css">
</head>
<body onload="check(),username()">
<div class="top">
        <div class="inside-top">
            <div class="top-box"> <img src="profile.png" alt="" style="width:30px;height:30px"> &nbsp;&nbsp; <p id="username">Hi user</p></div>
            <div class="inside-top2">
                <a href="home page1.php"><div  class="top-box">Home</div></a>
                <a href="home page2.php"><div class="top-box">View or update record</div></a>
                <div class="top-box">About</div>
                <a href="logout.php"><div class="top-box">Logout &nbsp;&nbsp;&nbsp; <img src="log-out.png" alt="" style="width:20px;height:20px"></div></a>
            </div>
        </div>
    </div>
    <div class="table-container">
    <table>
        <thead>
        <th>Sno</th>
        <th>Wire</th>
        <th>Dist</th>
        <th>Date</th>
        <th>Time</th>
        <th>Status</th>
        <th>Completed Date</th>
        <th>Completed Time</th>
        <?php
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
            $checkservice_area="select * from user_details where username='$username'";
            $service_area=mysqli_query($conn,$checkservice_area);
            $rows=mysqli_fetch_assoc($service_area);
            $service_area=$rows['service_area'];
            if($service_area=="Service_area1"){
                $dist=1;
            }
            elseif($service_area=="Service_area2"){
                $dist=2;
            }
            elseif($service_area=="Service_area3"){
                $dist=3;
            }
            else{
                $dist="admin";
            }
            if($dist=="admin"){
                echo"<th>Updated by</th>";
                echo"<th>Update status</th> </thead>";
            }
            else{
                echo"<th>Update status</th> </thead>";
            }
            $checkuser="select * from faults_record where dist='$dist'";
            $user=mysqli_query($conn,$checkuser);
            $count=1;
            if($dist!="admin"){
            while($row=mysqli_fetch_assoc($user))
            {
             echo "<tr>";
             echo "<td>".$count."</td>";
             echo "<td>".$row['wire']."</td>";
             echo "<td>".$row['dist']."</td>";
             echo "<td>".$row['date']."</td>";
             echo "<td>".$row['time']."</td>";
             echo "<td class=td-size><p class=size id=status-$count>".$row['status']."</p></td>";
             if($row['completed_date']==NULL){
                echo "<td>-</td>";
             }
             else{
             echo "<td>".$row['completed_date']."</td>";
             }
             if($row['completed_time']==NULL){
                echo "<td>-</td>";
             }
             else{
                echo "<td>".$row['completed_time']."</td>";
             }
             if($row['update_status']=='0'){
                $sno=$row['sno'];
                echo "<td><form action='add.php' method='post'><button type='submit' name='btn' class='btn td-size' value=$sno>Click here to update</button></form></td>";
             }
             else{
                echo "<td>-</td>";
             }
             echo "</tr>";
             $count++;
             }
             if($count==1){
            echo "<tr>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "</tr>";
             }
            }
            else{
            $faults="select * from faults_record";
            $values=mysqli_query($conn,$faults);
            $count=1;
            while($row=mysqli_fetch_assoc($values))
            {
             echo "<tr>";
             echo "<td>".$count."</td>";
             echo "<td>".$row['wire']."</td>";
             echo "<td>".$row['dist']."</td>";
             echo "<td>".$row['date']."</td>";
             echo "<td>".$row['time']."</td>";
             echo "<td class=td-size><p class=size id=status-$count>".$row['status']."</p></td>";
             if($row['completed_date']==NULL){
                echo "<td>-</td>";
             }
             else{
             echo "<td>".$row['completed_date']."</td>";
             }
             if($row['completed_time']==NULL){
                echo "<td>-</td>";
             }
             else{
             echo "<td>".$row['completed_time']."</td>";
             }
             if($row['updated_by']==NULL){
                echo "<td>-</td>";
             }
             else{
             echo "<td>".$row['updated_by']."</td>";
             }
             if($row['update_status']=='0'){
                $sno=$row['sno'];
                echo "<td><form action='add.php' method='post'><button type='submit' name='btn' class='btn td-size' value=$sno>Click here to update</button></form></td>";
             }
             else{
                echo "<td>-</td>";
             }
             echo "</tr>";
             $count++;
             }
             if($count==1){
            echo "<tr>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "</tr>";
             }
            }
        }
            ?>
    </table>
        </div>
            <script>
                function check(){
                    let len=(<?php echo$count?>)-1;
                    for(let i=1;i<=len;i++){
                        let id="status-";
                        id+=i;
                        let msg=document.getElementById(id).innerHTML;
                        id="#"+id;
                    if (msg=="IN PROGRESS"){
                        document.querySelector(id).style.cssText="color:red;background-color:rgb(253, 186, 186)";
                    }
                    else{
                        document.querySelector(id).style.cssText="color:#004d1a;background-color:rgb(102 255 153)";
                    }
                    }
                }

                function username(){
                   document.getElementById("username").innerHTML="Hi "+"<?php echo $_SESSION["username"] ?>";
                }
            </script>
</body>
</html>