<?php
session_start();
include "dbcon.php"; // Using database connection file here
if(!ISSET($_SESSION['username'])){
  header('location:login.php');
}

$emailx=$_SESSION['email'];
$qry = mysqli_query($con,"select * from studentdetails where email ='$emailx'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

$delr = mysqli_query($con,"delete from registration where email = '$emailx'"); 
$deld = mysqli_query($con,"delete from studentdetails where email = '$emailx'"); 
$deli = mysqli_query($con,"delete from studentinternship where email = '$emailx'"); 
$dela = mysqli_query($con,"delete from studentapplied where email = '$emailx'"); 
$dels = mysqli_query($con,"delete from studentmarks where email = '$emailx'"); 
$delapp = mysqli_query($con,"delete from studentapplied where email = '$emailx'"); 

if($delr && $deld && $deli && $dela && $dels && $delapp)
{
    session_destroy();
    mysqli_close($con); // Close connection
    header("location:login.php"); 
    exit;	
}
else
{
    echo "Error deleting record"; 
}
?>
