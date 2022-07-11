<?php
session_start();
?>

<?php
include 'dbcon.php' ;

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($con, $_POST['username'] );
    $otp = mysqli_real_escape_string($con, $_POST['otp'] );
    $password = mysqli_real_escape_string($con, $_POST['password'] );
    $cpassword =mysqli_real_escape_string($con, $_POST['cpassword'] );

    $otpquery = "select * from registration where username='$username' and token='$otp'";
    $query = mysqli_query($con,$otpquery);

    $otpcount = mysqli_num_rows($query);
	if(empty($username)||empty($otp))
	{
		echo "<script>
                
			alert('username or otp cannot be empty');

             </script>";
	}
    else if(strlen(trim($password)) < 8)
    {
            ?>
                <script>
                    alert("Password cannot be less than 8 characters !");
                </script>
            <?php
    }
    else if($password != $cpassword)
    {       
        ?>
                <script>
                    alert("Password are not matching!");
                </script>
            <?php

    }
    else if($otpcount>0){
		echo "<script>    
		alert('Email verified Successfully to continue please login to your account');
		 </script>";
         $pass = password_hash($password, PASSWORD_BCRYPT);
         $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

		 $insertquery = "update registration set password='$pass' where username='$username'";
		 $insertquery = mysqli_query($con,$insertquery);
		 if($insertquery)
		 {
            echo "<script>
            alert('Password successfully upadated');
            </script>";
			 sleep(5);
			header('location: login.php');

		 }
		 else
		 {
			echo "<script>
            alert('status not updated');
            </script>";

		 }
    }
    else{
        echo "<script>
            alert('otp are not matching');
            </script>";

     }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login_style.css">
    <title>STUDENT | OTP VERIFY</title>
</head>
<body>
                <div>
                    <p> <?php 
                    
                    if(isset($_SESSION['msg']))
                    {
                        echo $_SESSION['msg'];
                    }else{
                        echo $_SESSION['msg']="Not logged in";   
                    }
                      ?> </p>
                </div>
        <div class="card bg-light">
        <div class="container" id="container">
	<div class="form-container sign-in-container">
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
			<h1>OTP VERIFICATION</h1>
			<input type="text" placeholder="Username" name="username" required/>
			<input type="text" placeholder="OTP" name="otp" required/>
            <input type="password" placeholder="Password" name="password" required/>
			<input type="password" placeholder="Confirm Password" name="cpassword" required/>
			<button type="submit" name="submit">Submit</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Please Verify Your Email by Entering OTP</p>
				<button class="ghost" id="signUp"><a  href="resendotp.php">Resend OTP</a></button>

			</div>
		</div>
	</div>
</div>

<footer>
	<p>	

	</p>
</footer>

</body>

</html>