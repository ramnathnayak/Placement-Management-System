<?php

session_start();



?>
<!DOCTYPE html>
<html>

<body>
    
<p></p>

<script>
function myFunction() {
  var txt;
  var r = confirm("Confirm to Delete Account!");
  if (r == true) 
  {
    <?php
      
      session_destroy();

    ?>
    window.location="studentdel.php";
  } 
  else 
  {
    window.history.back(-1);
  }

}
window.onload=myFunction;

</script> 

</body>
</html>
