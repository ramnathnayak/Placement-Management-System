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
    <title>STUDENT | SIGN UP</title>
</head>

<body>
        

<?php

include 'dbcon.php' ;

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($con, $_POST['username'] );
    $email = mysqli_real_escape_string($con, $_POST['email'] );
    $mobile =mysqli_real_escape_string($con, $_POST['mobile'] );
    $password = mysqli_real_escape_string($con, $_POST['password'] );
    $cpassword =mysqli_real_escape_string($con, $_POST['cpassword'] );
    
    $userquery = "select * from registration where username='$username'";
    $uquery = mysqli_query($con,$userquery);

    $usercount = mysqli_num_rows($uquery);

    if($usercount>0){
        ?>
            <script>
                alert("Username already Exists Please Enter new one");
             </script>
        <?php
    }
    else
    {

        if(strlen(trim($password)) < 8)
        {
            ?>
                <script>
                    alert("Password cannot be less than 8 characters !");
                </script>
            <?php
        }
        else
        {
            $pass = password_hash($password, PASSWORD_BCRYPT);
            $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

            // $token = bin2hex(random_bytes(15));
            $token = rand(100000,999999);

            $emailquery = "select * from registration where email='$email'";
            $query = mysqli_query($con,$emailquery);

            $emailcount = mysqli_num_rows($query);

            if($emailcount>0){
                ?>
                    <script>
                        alert("Email already Exists");
                    </script>
                <?php
            }
            else{
                if($password === $cpassword){
                    $insertquery = "insert into registration(username,email,mobile,password,token,status) values
                    ('$username','$email','$mobile','$pass','$token','inactive')";

                    $iquery = mysqli_query($con, $insertquery);
                   
                    $insertquerya = "insert into studentdetails(email,phno) values
                    ('$email','$mobile')";

                    $iquerya = mysqli_query($con, $insertquerya);
                   
                    $insertqueryb = "insert into studentmarks(email) values
                    ('$email')";

                    $iqueryb = mysqli_query($con, $insertqueryb);

                    if($iquery){
                        $subject = "GEC Placements";
                        $body = "Hi, $username. OTP for your account verification is : $token";
                        $sender = "From: placementcellgec2@gmail.com";

                        if(mail($email,$subject,$body,$sender)) {
                            $_SESSION['msg']="Check your mail to activate your account $email";
                            header('location: otpverify.php');
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
                    
                }else{
                    ?>
                            <script>
                                alert("Passwords are not matching");
                            </script>
                        <?php
                }
            }
        }
    }
}

?>

<div class="container" id="container">
	<div class="form-container sign-in-container">
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
        <h1>REGISTER</h1>
			<input type="text" placeholder="Name" name="username" required />
			<input type="email" placeholder="Email" name="email" required/>
			<input type="contact number" placeholder="Contact Number" name="mobile"/>
			<input type="password" placeholder="Password" name="password" required/>
			<input type="password" placeholder="Confirm Password" name="cpassword" required/>
			<button type="submit" name="submit">Create Account</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
				<h1>Welcome Back</h1>
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
