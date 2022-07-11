<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login_style.css">
    <title>STUDENT | FORGOT PASSWORD</title>
</head>

<body>
        

<?php

include 'dbcon.php' ;

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($con, $_POST['email'] );
    // $token = bin2hex(random_bytes(15));
    $token = rand(100000,999999);

    $emailquery = "select * from registration where email='$email'";
    $query = mysqli_query($con,$emailquery);

    $emailcount = mysqli_num_rows($query);

    if($emailcount==0){
        ?>
            <script>
                alert("Email doesn't Exists so please register first");
             </script>
        <?php
    }
    else{
            $insertquery = "update registration set token='$token' where email='$email'";
            $iquery = mysqli_query($con, $insertquery);

            if($iquery){
                $subject = "GEC Placements";
                $body = "Hi,This is your otp for Password Change request from this email: $token" ;
                $sender = "From: placementcellgec2@gmail.com";

                if(mail($email,$subject,$body,$sender)) {
                    $_SESSION['msg']="Check your mail $email for otp";
                    header('location: fpassverify.php');
                }else{
                    echo "Email sending failed";
                }
            
            }else{
                ?>
                    <script>
                        alert("Insertion Unsuccessful");
                    </script>
                <?php
            }
            
        }
}

?>

<div class="container" id="container">
	<div class="form-container sign-in-container">
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
        <h1>SEND OTP</h1>
			<input type="email" placeholder="Email" name="email" required/>
			<button type="submit" name="submit">Send</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
				<h1>Enter your Email</h1>
				<p> To verify its you and then change password</p>

                <p>Already have an account ?</p>
				<button class="ghost" id="signIn"><a href="login.php">Log In</a></button>
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
