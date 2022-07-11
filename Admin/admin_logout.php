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
  var r = confirm("Confirm to Logout!");
  if (r == true) 
  {
    window.location="admin_logoutx.php";
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
