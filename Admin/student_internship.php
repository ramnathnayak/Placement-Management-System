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

<?php

include 'dbcon.php';

if(isset($_POST['submit'])) // when click on Update button
{
   
    // ---------------------------
    $rollno=$_POST['rollno'];

    if($rollno!=NULL)
    {
        header("location: student_details_view.php?rollno=$rollno");
    }
    else
    {
      ?>
      <script>
        alert("Enter proper Roll no");
      </script>
      <?php
    }
    
}

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="new_table.css">
    <link rel="stylesheet" href="form.css">
    <title>Student Details | Admin</title>
 
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
      <li class="active">
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
        <div class="container">
        <span>
        VIEW  STUDENT INTERNSHIP DETAILS
            <hr>
          <span>
          <div class="container-xl">
        <div class="container ">
            <!-- ----------------------- -->
            <?php

include "dbcon.php"; // Using database connection file here
$emailx=$_GET['email'];
$records = mysqli_query($con,"select * from studentinternship where email='$emailx'"); // fetch data from database
//  echo $_SESSION['email'];
while($data = mysqli_fetch_array($records))
{
  ?>
  <div class="container">
    <!-- <div class="row">
        <label for="email">Email : </label>
        <?
        // php echo $data['email'];
             ?>
    </div> -->
<!-- ----------------------------------------  -->
          <div class="row">
            <div class="col-25">
              <label for="companylocation">Company Name</label>
            </div>
            <div class="col-75">
              <input type="text" id="companylocation" name="companylocation" value="<?php echo $data['companyname']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="companylocation">Start Date</label>
            </div>
            <div class="col-75">
              <input type="text" id="companylocation" name="companylocation" value="<?php echo $data['sdate']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="companylocation">End date</label>
            </div>
            <div class="col-75">
              <input type="text" id="companylocation" name="companylocation" value="<?php echo $data['edate']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="companylocation">Field of Internship</label>
            </div>
            <div class="col-75">
              <input type="text" id="companylocation" name="companylocation" value="<?php echo $data['field']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="companylocation">Name of Contact Person from Company</label>
            </div>
            <div class="col-75">
              <input type="text" id="companylocation" name="companylocation" value="<?php echo $data['contactperson']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="companylocation">Designation of Person from Company</label>
            </div>
            <div class="col-75">
              <input type="text" id="companylocation" name="companylocation" value="<?php echo $data['designation']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="companylocation">Email id of Person from Company</label>
            </div>
            <div class="col-75">
              <input type="text" id="companylocation" name="companylocation" value="<?php echo $data['contactemail']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="companylocation">Contact Number of Person from Company</label>
            </div>
            <div class="col-75">
              <input type="text" id="companylocation" name="companylocation" value="<?php echo $data['contactnumber']; ?>" readonly>
            </div>
          </div>
</div>
<br><br>

<!-- ----------------------------------------  -->
                            
<?php
}
?>
      
      
    <!-- ?id=echo $data['email']; "> -->
    <!-- <a href="delete.php?id=
    ">Delete</a> --
<button> <a href="form.php">insert</a></button>
-------------- -->
</div>
</div>
</div>
</div>
            <!-- ----------------------- -->

        </div>
        </div>
        </div>
        </div>
            <!-- ----------------------- -->
        
        </div>
                

        <html>
            <head>
                <title></title>
            </head>

            <body>
                
            </body>
        </html>

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