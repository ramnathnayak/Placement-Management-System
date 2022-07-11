<?php
session_start();
?>

<?php
include 'dbcon.php' ;

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($con, $_POST['email'] );
    $otp = mysqli_real_escape_string($con, $_POST['otp'] );

    $otpquery = "select * from registration where email='$email' and token='$otp'";
    $query = mysqli_query($con,$otpquery);

    $otpcount = mysqli_num_rows($query);
	if(empty($email)||empty($otp))
	{
		echo "<script>
                
			alert('Email or otp cannot be empty');

             </script>";
	}
    else if($otpcount>0){
		echo "<script>    
		alert('Email verified Successfully to continue please login to your account');
		 </script>";
		 $insertquery = "update registration set status='active' where email='$email'";
		 $insertquery = mysqli_query($con,$insertquery);
		 if($insertquery)
		 {
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
                        echo 'Otp has been sent to your Mail id ';
						echo $_SESSION['msg'];
						$_SESSION['msg']='$email';
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
			<input type="email" placeholder="Email" name="email" required/>
			<input type="text" placeholder="OTP" name="otp" required/>
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