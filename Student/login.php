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
    <title>STUDENT | SIGN IN</title>
</head>
<body>
<?php

include 'dbcon.php';

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $namequery = "select * from registration where email='$email'";
    $nquery = mysqli_query($con,$namequery);

    $namecount = mysqli_num_rows($nquery);

    if($namecount == 0){
        echo "Account Doesnt exist so create an account first! ";
        ?>
            <script>
                alert("Account Doesnt exist so create an account first! ");
            </script>
            
        <?php
         header('location: registration.php');
    }
    else
    {
        $statusquery = "select * from registration where email='$email' and status='active'";
        $squery = mysqli_query($con,$statusquery);

        $statuscount = mysqli_num_rows($squery);

        if($statuscount == 0){
            //echo "Email not verified Please verify it first! ";
            ?>
                <script>
                   // alert("Email not verified Please verify it first! ");
                </script>
            <?php
            header('location otpverify.php');
        }
        else
        {

            $username_search = "select * from registration where email='$email' ";
            $query = mysqli_query($con,$username_search);

            $username_count = mysqli_num_rows($query);

            if($username_count){
                $username_pass = mysqli_fetch_assoc($query);

                $db_pass = $username_pass['password'];

                $_SESSION['username'] = $username_pass['username'];
                $_SESSION['email'] = $username_pass['email'];
                // $_SESSION['username'] = $username_pass[''];

                $pass_decode = password_verify($password, $db_pass);

                if($pass_decode){
                    echo "Login successful";
                    header('location: studentdash.php');
                }else{
                    echo "Incorrect password";
                }

            }else{
                echo "Invalid Email";
            }
       }
    }
}

?>

        <div class="card bg-light">
                <div>
                    <p> <?php 
                    
                    if(isset($_SESSION['email'])){
                        echo $_SESSION['email'];
                        echo " has been Verified Sucessfully please Login to continue";
                        // echo $_SESSION['msgx'];
                    }
                      ?> </p>
                </div>

        <div class="container" id="container">
	<div class="form-container sign-in-container">
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
			<h1>LOGIN</h1>
            <br>
			<input type="email" placeholder="Email" name="email" required/>
			<input type="password" placeholder="Password" name="password" required/>
            <br>
			<button type="submit" name="submit">Sign In</button>
            
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Dont' have an account?</p>
				<button class="ghost" id="signUp"><a  class="linker" href="registration.php">Create Account</a></button>
                    
                <a href="forgotpass.php">Forgot password?</aGo>
                <a href="../Homepage/home.html">Go To Home Page</a>
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