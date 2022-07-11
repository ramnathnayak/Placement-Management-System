<?php
session_start();
include "dbcon.php"; // Using database connection file here
if(!ISSET($_SESSION['username'])){
  header('location:login.php');
}

$id = $_GET['id']; // get id through query string
$emailx=$_SESSION['email'];
$qry = mysqli_query($con,"select * from studentinternship where email ='$emailx' and id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    // $email = $_POST['email'];
  // $email = $_POST['email'];
    $company = $_POST['companyname'];
    $field = $_POST['field'];
    $designation = $_POST['designation'];
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
    $contactperson = $_POST['contactperson'];
    $contactnumber = $_POST['contactnumber'];
    $contactemail = $_POST['contactemail'];
    if($sdate=="mm/dd/yyyy" || $sdate==NULL)
    {
      $sdate=$data['sdate'];
    }
    if($edate=="mm/dd/yyyy" || $edate==NULL)
    {
      $edate=$data['edate'];
    }
    
    $sql = "UPDATE studentinternship SET  companyname ='$company' ,sdate ='$sdate',field ='$field',edate ='$edate',contactperson ='$contactperson', designation='$designation',contactemail='$contactemail' ,contactnumber='$contactnumber' WHERE email ='$emailx' and id='$id'";

    // ---------------------------

    if ($con->query($sql) === TRUE)
    {
          $con->close(); // Close connection
          header("location: studentint.php"); // redirects to all records page
          exit;
    }
    else
    {
        // echo mysqli_error();
        ?>
        <div class=" body-section container">
        <?php 
        echo "Error updating record: " . $con->error;
        ?>
        </div><?php
    }    	
    
    // -------- marks-------------------
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="studentdash.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>STUDENT | INTERNSHIP EDIT </title>
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
          <div class="text">Dashboard</div>
      </header>
      <section class="cbody-section">
          <div class="container">
            STUDENT DETAILS
            <hr>
        <!-- <div class="fhtml fbody fdiv"> -->

          <div class="">
           <!-- -------------- -->
           <form method="post" enctype="multipart/form-data">
            <br>
            <div class="row">
            <div class="col-25">
            <label for="email">Email</label>
            </div>
            <div class="col-75">
            <?php echo $data['email'] ?>
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="fname">Company Name</label>
            </div>
            <div class="col-75">
            <input type="text" id="fname" name="companyname"  value="<?php echo $data['companyname'] ?>" placeholder="Your First name..">
            </div>
            </div>
            <br>
            Entered Value: <?php echo $data['sdate'] ?>
            <div class="row">
              <div class="col-25">
                <label for="dob">Start Date </label>
              </div>
              <div class="col-75">
                <input type="date" name="sdate" placeholder="Start date">
              </div>
            </div>
            <br>
            Entered Value: <?php echo $data['edate'] ?>
            <div class="row">
              <div class="col-25">
                <label for="dob">End Date </label>
              </div>
              <div class="col-75">
                <input type="date" name="edate" placeholder="End date">
              </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="lname">Field of Internship</label>
            </div>
            <div class="col-75">
            <input type="text" id="field" name="field"  value="<?php echo $data['field'] ?>" placeholder="Field">
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="lname">Name of Contact Person from Company</label>
            </div>
            <div class="col-75">
            <input type="text" name="contactperson"  value="<?php echo $data['contactperson'] ?>" placeholder="Name">
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="lname">Designation Person from Company</label>
            </div>
            <div class="col-75">
            <input type="text" name="designation"  value="<?php echo $data['designation'] ?>" placeholder="Number">
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="lname">Email of Person from Company</label>
            </div>
            <div class="col-75">
            <input type="email" name="contactemail"  value="<?php echo $data['contactemail'] ?>" placeholder="email">
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="lname">Phone Number Person from Company</label>
            </div>
            <div class="col-75">
            <input type="text" name="contactnumber"  value="<?php echo $data['contactnumber'] ?>" placeholder="Number">
            </div>
            </div>
            <br>
            <input type="submit" name="update" value="update">
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