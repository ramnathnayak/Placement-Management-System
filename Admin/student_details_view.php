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
        VIEW AND CHANGE STUDENT DETAILS
            <hr>
          <span>
          <div class="container-xl">
        <div class="container ">

        <form action="">
            <!-- ----------------------- -->
            <?php

$rollno=$_GET['rollno'];
$records = mysqli_query($con,"select * from studentdetails,studentmarks where rollno='$rollno' and studentdetails.email=studentmarks.email"); // fetch data from database
// echo $_SESSION['email'];
$valuex=mysqli_num_rows($records);
 if($valuex == 0)
 {
    header('location : student_details.php');
 }
while($data = mysqli_fetch_array($records))
{
?>
    <div  class="row">
      <div class="col-75">
        <p></p>
        <div class="container container1">
            Profile Image
          <img src="<?php echo $data['image']; ?>" alt="Profile pic" width="170" height="200">
          </div>
        </div>
        <div class="container container1">
            <!-- Resume  -->
            Click to view
          <br>
          <a href="<?php echo $data['resume']; ?>" target="_blank"><button class="btn btn-warning" type="button">Resume</button></a>  
        </div>
        <div class="container container1">
            Internship Details
          <br>
          <a href="student_internship.php?email=<?php echo $data['email'] ?>" ><button class="btn btn-info" type="button">Internship</button></a>  
        </div>
    </div>

    <div class="container">
    <div class="row">
        <label for="email">Email : </label>
        <?php echo $data['email']; ?>
    </div>
    <div class="row">
        <label for="fname">First Name : </label>
        <?php echo $data['fname']; ?>
        <p> 
        </p>
        <label for="lname">Last Name : </label>
        <?php echo $data['lname']; ?>
    </div>

        <div class="row">
            <label for="rollno">ROLL NO : </label>
            <?php echo $data['rollno']; ?>
        </div>
     
        <div class="row">
            <label for="upr">University Permanent Number : </label>
            <?php echo $data['upr']; ?>
        </div>
       
        <div class="row">
            <label for="semester">Semester : </label>
            <?php echo $data['semester']; ?>
        </div>
       
        <div class="row">
            <label for="department">Department : </label>
            <?php echo $data['department']; ?>

        </div>
  
        <div class="row">
            <label for="dob">Date of Birth : </label>
            <?php echo $data['dob']; ?>
        </div>
        
        <div class="row">
            <label for="gender">Gender : </label>
            <?php echo $data['gender']; ?>
        </div>
        
        <div class="row">
            <label for="address">Address : </label>
            <br>
        Street 1 : 
        <?php echo $data['street1']; ?>
            <br>
            <br>
        Street 2 :
        <?php echo $data['street2']; ?>
        <br>
        <br>
        City :
        <?php echo $data['city']; ?>
       <br>
       <br>
        Pincode :
        <?php echo $data['pincode']; ?>
        </div>
       
        <div class="row">
            <label for="phno">Phone No : </label>
            <?php echo $data['phno']; ?>
        </div>
        
        <div class="row">
            <label for="tenthmarks">10 standard percentage(%) : </label>
            <?php echo $data['tenthmarks']; ?>
        </div>
     
        <div class="row">
            <label for="twelvemarks">12 standard percentage(%) : </label>
            <?php echo $data['twelvemarks']; ?> 
        </div>
        <div class="row">
            <label for="backlogs">Any Backlogs : </label>
            <?php echo $data['backlogs']; ?>
        </div>
        
        <div class="row">
            <label for="placed">Placed or Not : </label>
            <?php echo $data['placed']; ?>
        </div>
        <!-- -----------------  -->
        <div class="row">
        <?php
        //   $recordmarks = mysqli_query($con,"select * from studentmarks where rollno='$rollno'"); // fetch data from database
        //   while($datamarks = mysqli_fetch_array($recordmarks))
        //   {
          
        ?>
        <br>
            <label for="Sem marks">Semester marks(CGPA) : </label>
        <div class="row">
            <label for="semmarks"> Semester 1: </label>
            <?php echo $data['sem1']; ?>
        </div>  
        <br>
        <div class="row">
            <label for="semmarks"> Semester 2: </label>
              <?php echo $data['sem2']; ?>
        </div>
        <br>
        <div class="row">
            <label for="semmarks"> Semester 3: </label>
            <?php echo $data['sem3']; ?>
        </div>
        <br>
        <div class="row">
            <label for="semmarks"> Semester 4: </label>
            <?php echo $data['sem4']; ?>
        </div>
        <br>
        <div class="row">
            <label for="semmarks"> Semester 5: </label>
            <?php echo $data['sem5']; ?>
        </div>
        <br>
        <div class="row">
            <label for="semmarks"> Semester 6: </label>
            <?php echo $data['sem6']; ?>
        </div>
        <br>
        <div class="row">
            <label for="semmarks"> Semester 7: </label>
            <?php echo $data['sem7']; ?>
        </div>
        <br>
        <div class="row">
            <label for="semmarks"> Semester8: </label>
            <?php echo $data['sem8']; ?>
                 </div>
        <br>
            <div class="row">
              <div class="col-25">
                <label for="CGPA">CGPA</label>
              </div>
              <div class="col-75">
                <input type="" name="cgpa"  value="<?php echo $data['cgpa']; ?>" readonly>
            </div>
            </div>
            <br>
         </div>

        </div>
        <br>
                <!-- -----------------  -->
        <a href="student_details_edit.php?email=<?php echo $data['email'] ?>"><button type="button" class="btn btn-success" >Edit</button></a>                                   
                <!-- <a href="">Edit</a  > -->
        </div>
        </div>
    <!-- ?id=echo $data['email']; "> -->
    <!-- <a href="delete.php?id=
    ">Delete</a> --
<?php
}
?>

<button> <a href="form.php">insert</a></button>
-------------- -->
</form>
        </div>
        </div>
        </div>
        </div>
            <!-- ----------------------- -->
        
        </div>
      
    <div>
            

        <html>
            <head>
                <title></title>
            </head>

            <body>
                
            </body>
        </html>

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