<?php

$server = "localhost";
$user = "root";
$password = "";
$db = "placement";

$con = mysqli_connect($server,$user,$password,$db);

if($con){
    
}else{
    ?>
        <script>
            alert("No Connection");
        </script>
    <?php
}

?>