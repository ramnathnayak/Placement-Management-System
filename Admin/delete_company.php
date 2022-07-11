<?php

include "dbcon.php"; // Using database connection file here

$id = $_GET['id']; 

$del = mysqli_query($con,"delete from company_details where id = '$id'"); 
$del= mysqli_query($con,"delete from company_id where id ='$id' ");

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

