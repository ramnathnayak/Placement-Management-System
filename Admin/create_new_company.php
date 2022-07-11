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
    <link rel="stylesheet" href="new_table.css">
    <link rel="stylesheet" href="form.css">
    <title>New Company | Admin</title>
 
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" 
    integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0" crossorigin="anonymous" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>

<?php
$username = $_SESSION['username']; 

include 'dbcon.php';

if(isset($_POST['submit'])){

    $companyname = mysqli_real_escape_string($con, $_POST['companyname'] );
    $companylocation = mysqli_real_escape_string($con, $_POST['companylocation'] );
    $ctc = mysqli_real_escape_string($con, $_POST['ctc'] );
    $hrname = mysqli_real_escape_string($con, $_POST['hrname'] );
    $hremail = mysqli_real_escape_string($con, $_POST['hremail'] );
    $hrcontact = mysqli_real_escape_string($con, $_POST['hrcontact'] );
    $address = mysqli_real_escape_string($con, $_POST['address'] );
    $mode = mysqli_real_escape_string($con, $_POST['mode'] );
    
    counter:
    $id = rand(1000,9999);

    $idquery = "select * from company_id where id='$id' ";
    $id_query = mysqli_query($con,$idquery);

    $idcount = mysqli_num_rows($id_query);

    if($idcount>0){
      goto counter;
    }

    else{
    
    
    $companyquery = "select * from company_id where name='$companyname' ";
    $cquery = mysqli_query($con,$companyquery);

    $companycount = mysqli_num_rows($cquery);

    if($companycount>0){
      ?>
          <script>
              alert("Company already Exists Please Enter new one");
           </script>
      <?php
    }
    else{
      
      $insert_company = "INSERT INTO `company_id`(`id`, `name`) VALUES ('$id','$companyname')";
      $query = mysqli_query($con, $insert_company);

      $insertquery = "INSERT INTO `company_details`(`id`, `name`, `location`, `ctc`, `hr_name`, `hr_email`, `hr_contact`, `address`, `test_mode`) 
      VALUES ('$id','$companyname','$companylocation','$ctc','$hrname','$hremail','$hrcontact','$address','$mode')";
      $iquery = mysqli_query($con, $insertquery); 
      
      $departments = $_POST['department'];
      
      foreach ($departments as $department){
        
        if($department=="computer"){
          $insertquery = "INSERT INTO `company_department`(`id`, `name`, `d_id` , `d_name`)
          VALUES ('$id','$companyname','1','Computer')";

          $iquery = mysqli_query($con, $insertquery);        
        }

        if($department=="IT"){
          $insertquery = "INSERT INTO `company_department`(`id`, `name`, `d_id` , `d_name`)
          VALUES ('$id','$companyname',2,'IT')";
    
          $iquery = mysqli_query($con, $insertquery);
        }

        if($department=="civil"){
          $insertquery = "INSERT INTO `company_department`(`id`, `name`, `d_id` , `d_name`)
          VALUES ('$id','$companyname',6,'Civil')";
    
          $iquery = mysqli_query($con, $insertquery);
        }

        if($department=="mech"){
          $insertquery = "INSERT INTO `company_department`(`id`, `name`, `d_id` , `d_name`)
          VALUES ('$id','$companyname',5,'Mechanical')";
    
          $iquery = mysqli_query($con, $insertquery);
        }

        if($department=="ene"){
          $insertquery = "INSERT INTO `company_department`(`id`, `name`, `d_id` , `d_name`)
          VALUES ('$id','$companyname',4,'ENE')";
    
          $iquery = mysqli_query($con, $insertquery);
        }

        if($department=="etc"){
          $insertquery = "INSERT INTO `company_department`(`id`, `name`, `d_id` , `d_name`)
          VALUES ('$id','$companyname',3,'ETC')";

          $iquery = mysqli_query($con, $insertquery);
        }

        if($department=="mining"){
          $insertquery = "INSERT INTO `company_department`(`id`, `name`, `d_id` , `d_name`)
          VALUES ('$id','$companyname',7,'Mining')";
    
          $iquery = mysqli_query($con, $insertquery);
        }
        
      }
      ?>
          <script>
              alert("New Company added successfully");
           </script>
        <?php
    

    }
      
  }
}



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
     <li>
       <a href="reports.php">
         <i class='bx bx-pie-chart-alt-2' ></i>
         <span class="links_name">Reports</span>
       </a>
       <span class="tooltip">Reports</span>
     </li>
     <li class="active">
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
      <div class="text">Enter Company Details</div>

      <div class="container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
          <div class="row">
            <div class="col-25">
              <label for="companyname">Name of Company</label>
            </div>
            <div class="col-75">
              <input type="text" id="companyname" name="companyname" placeholder="Company Name" required>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="companylocation">Company Location</label>
            </div>
            <div class="col-75">
              <input type="text" id="companylocation" name="companylocation" placeholder="Company location" required>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="ctc">Cost to the Company</label>
            </div>
            <div class="col-75">
              <input type="number" id="ctc" name="ctc" placeholder="CTC" required>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="hrname">Name of HR</label>
            </div>
            <div class="col-75">
              <input type="text" id="hrname" name="hrname" placeholder="HR Name" required>
            </div>
          </div>
          
          <div class="row">
            <div class="col-25">
              <label for="hremail">Email of HR</label>
            </div>
            <div class="col-75">
              <input type="email" id="hremail" name="hremail" placeholder="HR Email" required>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="hrcontact">Contact Number of HR</label>
            </div>
            <div class="col-75">
              <input type="tel" id="hrcontact" name="hrcontact" placeholder="HR Contact number" required>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="address">Address</label>
            </div>
            <div class="col-75">
              <textarea id="address" name="address" placeholder="Address" style="height: 150px;"></textarea>
            </div>
          </div>

          <div class="col-25">
            <label>Departments Hiring:</label>
          </div>
          <div class="col-75">
            <br>
            <input type="checkbox" name="department[]" value="computer"> Computer<br>
            <input type="checkbox" name="department[]" value="IT"> Information Technology<br>
            <input type="checkbox" name="department[]" value="civil"> Civil<br>
            <input type="checkbox" name="department[]" value="mech"> Mechanical<br>
            <input type="checkbox" name="department[]" value="ene"> Electrical and Electronics<br>
            <input type="checkbox" name="department[]" value="etc"> Electronics and Telecommunication<br>
            <input type="checkbox" name="department[]" value="mining"> Mining<br>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="mode">Mode Of Test</label>
            </div>
            <div class="col-75">
            <br>
            <input type="radio" name="mode" value="online"> Online<br>
            <input type="radio" name="mode" value="offline"> Offline<br>
            </div>
          </div>

          <div class="row">
            <input type="submit" name="submit" value="Add Company">
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

