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
    <title>Post Jobs | Admin</title>
 
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
  $companyname = mysqli_real_escape_string($con, $_POST['companyname'] );
  $sector = mysqli_real_escape_string($con, $_POST['sector'] );
  $post_date = mysqli_real_escape_string($con, $_POST['post_date'] );
  $deadline = mysqli_real_escape_string($con, $_POST['deadline'] );
  $vacancy = mysqli_real_escape_string($con, $_POST['vacancy'] );
  $criteria = mysqli_real_escape_string($con, $_POST['criteria'] );
  $post = mysqli_real_escape_string($con, $_POST['post'] );
  $information = mysqli_real_escape_string($con, $_POST['information'] );

  $idq = "select id from company_id where name='$companyname' ";
  $locationq = "select location from company_details where name='$companyname' ";
  $ctcq = "select ctc from company_details where name='$companyname' ";
  $testmodeq = "select test_mode from company_details where name='$companyname' ";

  $idr = mysqli_query($con,$idq);
  $array = mysqli_fetch_array($idr);
  $id = $array['id'];

  $locationr = mysqli_query($con,$locationq);
  $array = mysqli_fetch_array($locationr);
  $location = $array['location'];

  $ctcr = mysqli_query($con,$ctcq);
  $array = mysqli_fetch_array($ctcr);
  $ctc = $array['ctc'];

  $testmoder = mysqli_query($con,$testmodeq);
  $array = mysqli_fetch_array($testmoder);
  $testmode = $array['test_mode'];

  counter:
    $job_id = rand(100,999);

    $idquery = "select * from job_id where j_id='$job_id' ";
    $id_query = mysqli_query($con,$idquery);

    $idcount = mysqli_num_rows($id_query);

    if($idcount>0){
      goto counter;
    }

    else{

      $insert_jid = "INSERT INTO `job_id`(`j_id`, `id`) VALUES ('$job_id','$id')";
      $query = mysqli_query($con,$insert_jid);
      
      $insert_job = "INSERT INTO `post_job`(`j_id`, `id`, `sector`, `vacancy`, `criteria`, `post`, `information`, `post_date`, `deadline`) VALUES ('$job_id','$id','$sector','$vacancy','$criteria','$post','$information','$post_date','$deadline')";
      $iquery = mysqli_query($con, $insert_job);

      ?>

        <script>        
            alert("Job Posted Successfully");
        </script>
      <?php

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
     <li class="active">
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
      <div class="text">Post A Job</div>

      <div class="container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
          <div class="row">
            <div class="col-25">
              <label for="companyname">Name of Company</label>
            </div>
            <div class="col-75">
            <select name="companyname">
            <option disabled selected>-- Select Company --</option>
        <?php 
        $records = mysqli_query($con, "select name from company_details");   

        while($data = mysqli_fetch_array($records))
        {
            echo "<option  value='". $data['name'] ."'>" .$data['name'] ."</option>";  
        }	
      ?>  
      
          </select>
          <h5>*** If your Company is not present in the list then please go and add that new company first</h5>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="sector">Sector</label>
            </div>
            <div class="col-75">
              <input type="text" id="sector" name="sector" placeholder="Sector" required>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="post_date">Post Date</label>
            </div>
            <div class="col-75">
              <input type="date" id="post_date" name="post_date" placeholder="Post date" required>
            </div>
          </div>

          
          <div class="row">
            <div class="col-25">
              <label for="deadline">Deadline Date For Students</label>
            </div>
            <div class="col-75">
              <input type="date" id="deadline" name="deadline" placeholder="Last date to apply" required>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="vacancy">Vacancies</label>
            </div>
            <div class="col-75">
              <input type="text" id="vacancy" name="vacancy" placeholder="Vacancies" required>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="critera">Criteria (Enter CGPA)</label>
            </div>
            <div class="col-75">
              <input type="text" id="criteria" name="criteria" placeholder="Criteria(Enter CGPA)" required>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="post">Post</label>
            </div>
            <div class="col-75">
              <input type="text" id="post" name="post" placeholder="Post Available" required>
            </div>
          </div>

          

          <div class="row">
            <div class="col-25">
              <label for="information">Additional Information (if any)</label>
            </div>
            <div class="col-75">
              <textarea id="information" name="information" placeholder="Additional Information" style="height: 150px;"></textarea>
            </div>
          </div>

          <div class="row">
            <input type="submit" name="submit" value="Post Job">
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