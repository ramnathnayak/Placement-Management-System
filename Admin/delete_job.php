<?php

include "dbcon.php"; // Using database connection file here

$id = $_GET['id']; 

$del = mysqli_query($con,"delete from post_job where j_id = '$id' "); // delete query

if($del)
{
    mysqli_close($con); // Close connection
    header("location:display_jobs.php"); // redirects to all records page
    exit;	
}
else
{
    ?>
    <script>
        alert("Error deleting record, Please try again ");
    </script>
    <?php
}
?>
