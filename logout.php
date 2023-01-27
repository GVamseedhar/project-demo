<?php
session_start();
if(isset($_SESSION["username"])){
    $_SESSION["username"]="please login";
    header("Location:index.html");
}
?>