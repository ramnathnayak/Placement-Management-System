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
    <title>Reports | Admin</title>

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" 
    integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0" crossorigin="anonymous" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>

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
     <li>
       <a href="new_admin.php">
         <i class='bx bx-user-plus'></i>
         <span class="links_name">New Admin Credentials</span>
       </a>
       <span class="tooltip">New Admin Credentials</span>
     </li>
     <li class="active">
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
      <div class="text">Update Rounds </div>

      <div class="container">
        <form action="" method="POST">
          <div class="row">


<?php
          include 'dbcon.php';
  
    $email = $_GET['email'];
    $ids = $_GET['id'];


    // $showquery = "select * from studentapplied where email='$email' and j_id='$ids' ";
    $showquery = "select * from studentapplied,studentdetails where studentapplied.email='$email' and studentdetails.email='$email' and j_id='$ids' ";
    $showdata = mysqli_query($con,$showquery);
    $arrdata = mysqli_fetch_array($showdata);

    if(isset($_POST['submit'])){

        $round1 = mysqli_real_escape_string($con, $_POST['round1'] );
        $round2 = mysqli_real_escape_string($con, $_POST['round2'] );
        $round3 = mysqli_real_escape_string($con, $_POST['round3'] );
        $round4 = mysqli_real_escape_string($con, $_POST['round4'] );
        $result = mysqli_real_escape_string($con, $_POST['result'] );
        

  
    if($result=="Placed")
    {
      $update_studentdetails = "UPDATE `studentdetails` SET `placed`='$result' WHERE email='$email' ";
        $queryx = mysqli_query($con, $update_studentdetails); 
    }

        $update_company = "UPDATE `studentapplied` SET `round1`='$round1',`round2`='$round2',`round3`='$round3',`round4`='$round4',`result`='$result' WHERE email='$email' and j_id='$ids' ";
        $query = mysqli_query($con, $update_company);


    }

?>   

            <div class="col-25">
              <label for="email">Email</label>
            </div>
            <div class="col-75">
              <input type="text" id="email" name="email" value="<?php echo $arrdata['email']; ?>" readonly>
            </div>
            </div>

            <br><br>
            <div class="row">
            <div class="col-25">
              <label for="email">Name</label>
            </div>
            <div class="col-75">
              <input type="text" id="email" name="email" value="<?php echo $arrdata['fname'];
                            echo " ".$arrdata['lname'];
                            ?>" readonly>
            </div>
            </div>

            

            <br><br>
            <div class="row">
            <div class="col-25">
              <label for="j_id">Job ID</label>
            </div>
            <div class="col-75">
              <input type="text" id="j_id" name="j_id" value="<?php echo $arrdata['j_id']; ?>" readonly>
            </div>
          </div>

          <br><br>
          <div class="row">
            <div class="col-25">
              <label for="round1">Round 01</label>
            </div>
            <div class="col-75">
              <input type="date" id="round1" name="round1" value="<?php echo $arrdata['round1']; ?>">
              <h5>***Enter the corresponding date if the student has cleared Round 1</h5>
            </div>
          </div>

          <br><br>
          <div class="row">
            <div class="col-25">
              <label for="round2">Round 02</label>
            </div>
            <div class="col-75">
              <input type="date" id="round2" name="round2" value="<?php echo $arrdata['round2']; ?>">
              <h5>***Enter the corresponding date if the student has cleared Round 2</h5>
            </div>
          </div>

          <br><br>
          <div class="row">
            <div class="col-25">
              <label for="round3">Round 03</label>
            </div>
            <div class="col-75">
              <input type="date" id="round3" name="round3" value="<?php echo $arrdata['round3']; ?>">
              <h5>***Enter the corresponding date if the student has cleared Round 3</h5>
            </div>
          </div>

          <br><br>
          <div class="row">
            <div class="col-25">
              <label for="round4">Round 04</label>
            </div>
            <div class="col-75">
              <input type="date" id="round4" name="round4" value="<?php echo $arrdata['round4']; ?>">
              <h5>***Enter the corresponding date if the student has cleared Round 4</h5>
            </div>
          </div>


<br>
          <div class="row">
            <div class="col-25">
              <label for="mode">Result</label>
            </div>
            <div class="col-75">
            <br>
            <?php
              if( $arrdata['result']=="Placed" ){
                ?><input type="radio" name="result" value="Placed" checked> Placed<br><?php
              }
              else{
                ?><input type="radio" name="result" value="Placed"> Placed<br><?php
              }
              
              if( $arrdata['result']=="Not Placed"){
                ?><input type="radio" name="result" value="Not Placed" checked> Not Placed<br><?php
              }
              else{
                ?><input type="radio" name="result" value="Not Placed"> Not Placed<br><?php
              }

            ?>
            
          
          <div class="row">
            <input type="submit" name="submit" value="Update">
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

