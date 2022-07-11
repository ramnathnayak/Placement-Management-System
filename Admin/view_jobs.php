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
    <title>Jobs | Admin</title>
 
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" 
    integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0" crossorigin="anonymous" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
<?php
include 'dbcon.php';
$j_id = $_GET['id'];
$showquery = "select * from post_job,company_details where post_job.id=company_details.id and j_id=$j_id";
$showdata = mysqli_query($con,$showquery);
$arrdata = mysqli_fetch_array($showdata);
$username = $_SESSION['username'];
?>




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
      <div class="text">Posted Job Details</div>

      <div class="container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
          <div class="row">
            <div class="col-25">
              <label for="companyname">Name of Company</label>
            </div>
            <div class="col-75">
            <input type="text" id="companyname" name="companyname" placeholder="Company Name" value="<?php echo $arrdata['name']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="sector">Sector</label>
            </div>
            <div class="col-75">
              <input type="text" id="sector" name="sector" placeholder="Sector" value="<?php echo $arrdata['sector']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="post_date">Post Date</label>
            </div>
            <div class="col-75">
              <input type="text" id="post_date" name="post_date" placeholder="Post date" value="<?php echo $arrdata['post_date']; ?>" readonly>
            </div>
          </div>

          
          <div class="row">
            <div class="col-25">
              <label for="deadline">Deadline Date For Students</label>
            </div>
            <div class="col-75">
              <input type="text" id="deadline" name="deadline" placeholder="Last date to apply" value="<?php echo $arrdata['deadline']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="vacancy">Vacancies</label>
            </div>
            <div class="col-75">
              <input type="text" id="vacancy" name="vacancy" placeholder="Vacancies" value="<?php echo $arrdata['vacancy']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="critera">Criteria (Enter CGPA)</label>
            </div>
            <div class="col-75">
              <input type="text" id="criteria" name="criteria" placeholder="Criteria(Enter CGPA)" value="<?php echo $arrdata['criteria']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="post">Post</label>
            </div>
            <div class="col-75">
              <input type="text" id="post" name="post" placeholder="Post Available" value="<?php echo $arrdata['post']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="companylocation">Company Location</label>
            </div>
            <div class="col-75">
              <input type="text" id="companylocation" name="companylocation" placeholder="Company location" value="<?php echo $arrdata['location']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="ctc">Cost to the Company</label>
            </div>
            <div class="col-75">
              <input type="number" id="ctc" name="ctc" placeholder="CTC" value="<?php echo $arrdata['ctc']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="hrname">Name of HR</label>
            </div>
            <div class="col-75">
              <input type="text" id="hrname" name="hrname" placeholder="HR Name" value="<?php echo $arrdata['hr_name']; ?>" readonly>
            </div>
          </div>
          
          <div class="row">
            <div class="col-25">
              <label for="hremail">Email of HR</label>
            </div>
            <div class="col-75">
              <input type="email" id="hremail" name="hremail" placeholder="HR Email" value="<?php echo $arrdata['hr_email']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="hrcontact">Contact Number of HR</label>
            </div>
            <div class="col-75">
              <input type="tel" id="hrcontact" name="hrcontact" placeholder="HR Contact number" value="<?php echo $arrdata['hr_contact']; ?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="address">Address</label>
            </div>
            <div class="col-75">
              <textarea id="address" name="address" placeholder="Address" readonly><?php echo $arrdata['address']; ?></textarea>
            </div>
          </div>

          

          <div class="row">
            <div class="col-25">
              <label for="information">Additional Information (if any)</label>
            </div>
            <div class="col-75">
              <textarea id="information" name="information" placeholder="Additional Information" style="height: 150px;" readonly><?php echo $arrdata['information']; ?></textarea>
            </div>
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