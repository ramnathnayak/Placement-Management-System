<?php

session_start();
if(!ISSET($_SESSION['username'])){
  header('location:login.php');
}
include 'dbcon.php' ;

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="studentdash.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
     
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>STUDENT | CHANGE DETAILS</title>
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
        <h2 class="logo_name">STUDENT</h2>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="studentdash.php">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
      <li class="active">
       <a href="studentcd.php">
         <i class='bx bx-user active' ></i>
         <span class="links_name">Change Details</span>
       </a>
       <span class="tooltip">Change Details</span>
     </li>
     <li>
       <a href="studentint.php">
         <i class='bx bx-customize' ></i>
         <span class="links_name">Internship Details</span>
       </a>
       <span class="tooltip">Internship Details</span>
     </li>
     <li>
       <a href="studentja.php">
         <i class='bx bx-pie-chart-alt-2' ></i>
         <span class="links_name">Analytics</span>
       </a>
       <span class="tooltip">Analytics</span>
     </li>
     <li>
       <a href="studentpd.php">
         <i class='bx bx-calendar-check' ></i>
         <span class="links_name">Placement Drives</span>
       </a>
       <span class="tooltip">Placement Drives</span>
     </li>
     <li>
       <a href="studentsetting.php">
         <i class='bx bx-cog' ></i>
         <span class="links_name">Setting</span>
       </a>
       <span class="tooltip">Setting</span>
     </li>
     <li>
       <a href="logout.php">
         <i class='bx bx-log-out' id="log_out" ></i>
         <span class="links_name">Logout</span>
       </a>
       <span class="tooltip">Logout</span>
     </li>
    </ul>
  </div>
  <section class="home-section">
      <header class="header-section">
          <div class="text">Change Details</div>
      </header>
      <section class="xbody-section">
          <div class="container box3">
            <h1 align="center"> STUDENT DETAILS</h1>  
            <hr>
        <!-- <div class="fhtml fbody fdiv"> -->

          <div class="container">
           <!-- -------------- -->
           <?php

$emailx=$_SESSION['email'];
$records = mysqli_query($con,"select * from studentdetails where email='$emailx'"); // fetch data from database
// echo $_SESSION['email'];
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
          <a href="<?php echo $data['resume']; ?>" target="_blank"><button type="button">Resume</button></a>  
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
          $recordmarks = mysqli_query($con,"select * from studentmarks where email='$emailx'"); // fetch data from database
          while($datamarks = mysqli_fetch_array($recordmarks))
          {
          
        ?>
            <label for="Sem marks">Semester marks(CGPA) : </label>
        <div class="row">
            <label for="semmarks"> Semester 1: </label>
            <?php echo $datamarks['sem1']; ?>
        </div>  
        <div class="row">
            <label for="semmarks"> Semester 2: </label>
              <?php echo $datamarks['sem2']; ?>
        </div>
        <div class="row">
            <label for="semmarks"> Semester 3: </label>
            <?php echo $datamarks['sem3']; ?>
        </div>
        <div class="row">
            <label for="semmarks"> Semester 4: </label>
            <?php echo $datamarks['sem4']; ?>
        </div>
        <div class="row">
            <label for="semmarks"> Semester 5: </label>
            <?php echo $datamarks['sem5']; ?>
        </div>
        <div class="row">
            <label for="semmarks"> Semester 6: </label>
            <?php echo $datamarks['sem6']; ?>
        </div>
        <div class="row">
            <label for="semmarks"> Semester 7: </label>
            <?php echo $datamarks['sem7']; ?>
        </div>
        <div class="row">
            <label for="semmarks"> Semester8: </label>
            <?php echo $datamarks['sem8']; ?>
                 </div>
        <div class="row">
            <label for="semmarks"> <h3>CGPA: </label>
            <?php echo $datamarks['cgpa']; ?></h3>
                 </div>
        <?php
        
          }
          ?>
        </div>
                <!-- -----------------  -->
        <a href="studentedit.php"><button type="button" >Edit</button></a>                                   
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
        </div>
        </div>
        </div>
        </div>
      </section>
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