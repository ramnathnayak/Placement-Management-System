<?php

session_start();

if(!isset($_SESSION['username'])){
    ?>
            <script>
                alert("You are logged out! ");
            </script>
    <?php
    header('location:admin_login.php');
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="new_table.css">
    <title>New Admin | Admin</title>
 
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" 
    integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0" crossorigin="anonymous" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>

<?php


include 'dbcon.php';

if(isset($_POST['submit'])){
  $username = mysqli_real_escape_string($con, $_POST['username'] );
  $email = mysqli_real_escape_string($con, $_POST['email'] );
  $password = mysqli_real_escape_string($con, $_POST['password'] );
  
  $userquery = "select * from admin_login where email='$email'";
  $uquery = mysqli_query($con,$userquery);

  $usercount = mysqli_num_rows($uquery);

  if($usercount>0){
      ?>
          <script>
              alert("Email already Exists Please Enter new one");
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
                  $insertquery = "insert into admin_login(username,email,password) values
                  ('$username','$email','$pass')";

                  $iquery = mysqli_query($con, $insertquery);

                  if($iquery){
                      $subject = "GEC Placements";
                      $body = "Hi, $username. Your Admin Account was successfully created
                      Your Credentials:
                      Email ID- $email
                      Password- $password
                      You can now Login! ";
                      $sender = "From: placementcellgec2@gmail.com";

                      if(mail($email,$subject,$body,$sender)) {
                        ?>
                        <script>
                            alert("Account successfully created. New Admin has been mailed his credentials.");
                        </script>
                    <?php
                          
                      }else{
                        ?>
                        <script>
                            alert("Email sending Failed. ");
                        </script>
                    <?php
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
}


?>



<?php  $username = $_SESSION['username']; ?>  
<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">Admin</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      
      <li>
        <a href="admin_home.php" >
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
      <li>
       <a href="student_details.php">
         <i class='bx bx-user' ></i>
         <span class="links_name">Student Details</span>
       </a>
       <span class="tooltip">Student Details</span>
     </li>
     <li class="active">
       <a href="new_admin.php">
         <i class='bx bx-user-plus'></i>
         <span class="links_name">New Admin Credentials</span>
       </a>
       <span class="tooltip">New Admin Credentials</span>
     </li>
     <li>
       <a href="reports.php">
         <i class='bx bx-pie-chart-alt-2' ></i>
         <span class="links_name">Reports</span>
       </a>
       <span class="tooltip">Reports</span>
     </li>
     <li>
       <a href="new_company.php">
         <i class='bx bx-add-to-queue'></i>
         <span class="links_name">Add Company</span>
       </a>
       <span class="tooltip">Add Company</span>
     </li>
     <li>
       <a href="display_jobs.php">
         <i class='bx bx-repost'></i>
         <span class="links_name">Post Jobs</span>
       </a>
       <span class="tooltip">Post Jobs</span>
     </li>
     <li>
       <a href="mou.php">
         <i class='bx bxs-file-pdf'></i>
         <span class="links_name">MOU</span>
       </a>
       <span class="tooltip">MOU</span>
     </li>
     
     <li class="profile">
         <div class="profile-details">
           <<div class="name_job">
             <div class="name"><?php echo $username;  ?></div> 
           </div>
         </div> 
     </li>  

     <li>
          <a href="admin_logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log Out</span>
          </a>
          <span class="tooltip">Log out</span>
        </li>
    </ul>
  </div>
  <section class="home-section">
      <div class="text">Create New Admin Credentials</div>

      <div class="container">
  <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="row">
      <div class="col-25">
        <label for="username">Username</label>
      </div>
      <div class="col-75">
        <input type="text" id="username" name="username" placeholder="Username">
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="email">Email</label>
      </div>
      <div class="col-75">
        <input type="email" id="email" name="email" placeholder="Email">
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="password">Password</label>
      </div>
      <div class="col-75">
        <input type="password" id="password" name="password" placeholder="Password">
      </div>
    </div>
    
    
      <input type="submit" name="submit" value="Create New Account">
    </div>
  </form>
</div>

  </section>

    

  <script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });

  searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
    sidebar.classList.toggle("open");
    menuBtnChange(); //calling the function(optional)
  });

  // following are the code to change sidebar button(optional)
  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
   }
  }
  </script>
</body>
</html>