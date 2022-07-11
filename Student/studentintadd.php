<?php
session_start();
include "dbcon.php"; // Using database connection file here
if(!ISSET($_SESSION['username'])){
  header('location:login.php');
}

// $id = $_GET['id']; // get id through query string
$emailx=$_SESSION['email'];
$qry = mysqli_query($con,"select * from studentdetails where email ='$emailx'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['submit']))
{		
    $email = $emailx;
    $companyname = $_POST['companyname'];
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
    $field = $_POST['field'];
    $contactperson = $_POST['contactperson'];
    $contactnumber = $_POST['contactnumber'];
    $contactemail = $_POST['contactemail'];
    $designation = $_POST['designation'];

    // $insert = mysqli_query($con,"INSERT INTO `studentdetails` (`fname`, `rollno`,`gender`) VALUES ('$fname','$rollno','$gender')");
    // $insert = mysqli_query($con,"INSERT INTO `studentdetails`(`email`,`fname`, `lname`, `rollno`, `upr`, `dob`, `gender`, `phno`, `department`, `semester`, `street1`, `street2`, `city`, `pincode`, `placed`, `backlogs`, `tenthmarks`, `twelvemarks`) VALUES ('$email','$fname','$lname','$rollno','$upr','$dob','$gender','$phno','$department','$semester','$street1','$street2','$city','$pincode','$placed','$backlogs','$tenthmarks','$twelvemarks')");

    $insert = mysqli_query($con,"INSERT INTO `studentinternship`(`email`,`companyname`,`sdate`,`edate`,`contactperson`,`contactnumber`,`contactemail`,`designation`,`field`) VALUES ('$email','$companyname','$sdate','$edate','$contactperson','$contactnumber','$contactemail','$designation','$field')");

    if(!$insert)
    {
      echo mysqli_error();
      echo "record adding failed";
    }
    else
    {
        echo "Records added successfully.";
        header('location: studentint.php');
    }
}

mysqli_close($con); // Close connection

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="studentdash.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
     <title>STUDENT | ADD INTERNSHIP DETAILS</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      <li>
       <a href="studentcd.php">
         <i class='bx bx-user' ></i>
         <span class="links_name">Change Details</span>
       </a>
       <span class="tooltip">Change Details</span>
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
         <i class='bx bx-menu' ></i>
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
          <div class="text">Internship Details</div>
      </header>
      <section class="cbody-section">
          <div class="container">
            ADD INTERNSHIP DETAILS
            <hr>
        <!-- <div class="fhtml fbody fdiv"> -->

          <div class="">
           <!-- -------------- -->
           <form action="" method="post">
  <div class="row">
      <div class="col-25">
        <label for="email">Email</label>
      </div>
      <div class="col-75">
        <!-- <input type="email" name="email"  placeholder="Email"/> -->
        <!-- <label for="email">Email : </label> -->
        <?php echo $data['email']; ?>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-25">
        <label for="companyname">Company Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="companyname" name="companyname" placeholder="Company name">
      </div>
    </div>
     <br>
    <div class="row">
      <div class="col-25">
        <label for="contactperson">Contact Person Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="contactperson" name="contactperson" placeholder="contact person name">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-25">
          <label for="lname">Field of Internship</label>
      </div>
      <div class="col-75">
        <input type="text" id="field" name="field" placeholder="Field">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-25">
        <label for="contactnumber">Contact Person Number</label>
      </div>
      <div class="col-75">
        <input type="text" id="contactnumber" name="contactnumber" placeholder="contact number">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-25">
        <label for="contactemail">Contact Person Email</label>
      </div>
      <div class="col-75">
        <input type="text" id="contactemail" name="contactemail" placeholder="contact person email">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-25">
        <label for="designation">Designation</label>
      </div>
      <div class="col-75">
        <input type="text" id="designation" name="designation" placeholder="designation">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-25">
        <label for="sdate">Date of Start</label>
      </div>
      <div class="col-75">
          <input type="date" name="sdate"  placeholder="start date">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-25">
        <label for="edate">Date of end</label>
      </div>
      <div class="col-75">
          <input type="date" name="edate"  placeholder="start date">
      </div>
    </div>
    <br>
    <div class="row">
      <input type="submit"name="submit" value="Submit">
    </div>
  </form>
           <!-- -------------- -->
          <!-- </div> -->
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