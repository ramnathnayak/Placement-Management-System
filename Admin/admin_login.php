<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginstyle.css">
    <title>Login | Admin</title>
</head>
<body>

<?php

include 'dbcon.php'; 

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $namequery = "select * from admin_login where email='$email'";
    $nquery = mysqli_query($con,$namequery);

    $namecount = mysqli_num_rows($nquery);

    if($namecount == 0){
        ?>
            <script>
                alert("Account Doesnt exist ");
            </script>
            
        <?php
        
    }
    else
    {
        

            $username_search = "select * from admin_login where email='$email' ";
            $query = mysqli_query($con,$username_search);

            $username_count = mysqli_num_rows($query);

            if($username_count){
                $username_pass = mysqli_fetch_assoc($query);

                $db_pass = $username_pass['password'];

                $_SESSION['username'] = $username_pass['username'];

                $pass_decode = password_verify($password, $db_pass);

                if($pass_decode){
                    echo "Login successful";

                    header('location:admin_home.php');
                }else{
                    echo "Incorrect password";
                }

            }else{
                echo "Invalid Email";
            }
       
    }
}


?>

<div class="container" id="container">
	<div class="form-container sign-in-container">
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
			<h1>LOGIN</h1>
			<input type="email" placeholder="Email" name="email" required/>
			<input type="password" placeholder="Password" name="password" required/>
			<button type="submit" name="submit">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
                <img src="adminimg.png" alt="">
				<h1>Hello, Admin</h1>
				<p>Please Login to access your Account</p>
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
</script>
</html>