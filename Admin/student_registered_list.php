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
       <h5>STUDENT DETAILS</h5>
            <hr>
          <span>
          <table class="styled-table">
                        <thead>
                            <tr>
                                <th>Roll No  </th>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Semester</th>
                                <th>Department</th>
                                <th>CGPA</th>
                                <!-- <th>More details</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <!-- select * from  recruiters LIMIT 3 -->
                        <?php 
                        include 'dbcon.php';
                        $queryx="SELECT * FROM studentdetails,studentmarks where studentdetails.email=studentmarks.email";
                        $records = mysqli_query($con,$queryx); // fetch data from database
                        $valuex=mysqli_num_rows($records);
                        if($valuex != 0)
                        {
                          while($data = mysqli_fetch_array($records))
                          {
                            ?>
                            <tr class="active-row">
                            <td>
                              <?php
                                echo $data['rollno'];
                              ?>   
                            </td>
                            <td>
                              <?php
                                echo $data['fname']." ".$data['lname'];
                              ?>   
                            </td>
                            <td>
                              <?php
                                echo $data['email'];
                              ?>   
                            </td>
                            <td>
                              <?php
                                echo $data['semester'];
                              ?>   
                            </td>
                            <td>
                              <?php
                                echo $data['department'];
                              ?>   
                            </td>
                            <td>
                              <?php
                                echo $data['cgpa'];
                              ?>   
                            </td>
                            
                          </tr>
                        <?php 
                          } 
                          
                        }
                        ?>
                           
                        </tbody>
                    </table>
          </span>        
          <a href="student_details.php" class="btn btn-success" data-toggle="tooltip">
                      Go back
                      <a>
        </span>
        </span>
        </div>
           
        </span>
           
        </span>
             
           
        </span>
        </span>
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