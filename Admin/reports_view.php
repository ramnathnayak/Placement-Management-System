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
      <div class="text">Reports</div>

 
      <?php
          include 'dbcon.php';
  
    $ids = $_GET['id'];


    // $showquery = "select * from company_details where id=$ids";
    // $showdata = mysqli_query($con,$showquery);
    // $arrdata = mysqli_fetch_array($showdata);

?>        

<div class="table-responsive">

<caption><h3>List of Applied Students</h3></caption>
<caption><h4>Job Id=<?php echo $ids ?> </h4></caption>
     
<table class="styled-table">
    <thead>  
            <tr>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Round01</th>
                            <th>Round02</th>
                            <th>Round03</th>
                            <th>Round04</th>
                            <th>Result</th>
                            <th>Update</th>
                            <th>Delete</th>
               
            </tr>
        </thead>
        <tbody>
            <?php

                    

                        // $selectquery = " select * from company_department,company_id,company_details where company_department.id=company_id.id and company_id.id=company_details.id  and company_department.d_id=1 ";
                        $selectquery = "select * from studentapplied,studentdetails where j_id='$ids' and studentapplied.email=studentdetails.email ";
                        $query = mysqli_query($con,$selectquery);

                        // $emailx = $res['email'];
                        // $selectqueryx = "select * from studentdetails where email='$emailx' ";
                        // $queryx = mysqli_query($con,$selectqueryx);
                        $student_count = mysqli_num_rows($query);
                        // $selectqueryx = "select count(*) from studentapplied,studentdetails where j_id='$ids' and studentapplied.email=studentdetails.email ";
                        // $queryx = mysqli_query($con,$selectqueryx);
                        // $resx = mysqli_fetch_array($queryx);
                        echo "Number of Students : ".$student_count;

                        while($res = mysqli_fetch_array($query)){

                    ?>
                          <tr>
                            <td><?php echo $res['email']; ?></td>
                            <td><?php echo $res['fname'];
                            echo " ".$res['lname'];
                            ?></td>
                            
                            <td><?php echo $res['round1']; ?></td>
                            <td><?php echo $res['round2']; ?></td>
                            <td><?php echo $res['round3']; ?></td>
                            <td><?php echo $res['round3']; ?></td>
                            <td><?php echo $res['result']; ?></td>
                            <td><a href="reports_update.php?email=<?php echo $res['email']; ?>&id=<?php echo $ids ?> " data-toggle="tooltip" data-placement="bottom" title="Update"><i class="fa fa-edit" aria-hidden="true"></i></a></td>
                            <td><a href="#" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                          </tr>

                          <?php
                        }
                          ?>

        </tbody>
    </table>
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