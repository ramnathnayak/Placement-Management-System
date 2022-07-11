<?php

include "dbcon.php"; // Using database connection file here

$id = $_GET['id']; 
$dept = $_GET['dept'];

$del = mysqli_query($con,"delete from company_department where id = '$id' and d_id= '$dept' "); // delete query

if($del)
{
    mysqli_close($con); // Close connection
    header("location:new_company.php"); // redirects to all records page
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
