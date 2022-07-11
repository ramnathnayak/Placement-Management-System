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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="new_table.css">
    <link rel="stylesheet" href="form.css">
    <title>Company | Admin</title>

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" 
    integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0" crossorigin="anonymous" />
    <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>


   </head>
<body>
<?php  
$username = $_SESSION['username']; 
include 'dbcon.php';
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
      <div class="text">Companies Registered</div>

    
<hr>
      <div class="table-responsive">
<a href="create_new_company.php" class="btn btn-success" data-toggle="tooltip"><i class="material-icons"></i> <span>Add New Company</span></a>
<hr>

<br>
<hr>
<caption><h3>Computer Department</h3></caption>
     <hr>
<table class="styled-table">
    <thead>  
            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>CTC</th>
                            <th>Name Of HR</th>
                            <th>Email Of HR</th>
                            <th>Contact Number of HR</th>
                            <th>Address</th>
                            <th>Test Mode</th>
                            <th>View</th>
                            <th>Delete</th>
               
            </tr>
        </thead>
        <tbody>
            <?php

               

                        $selectquery = " select * from company_department,company_id,company_details where company_department.id=company_id.id and company_id.id=company_details.id  and company_department.d_id=1 ";
                        $query = mysqli_query($con,$selectquery);
                
                        while($res = mysqli_fetch_array($query)){

                    ?>
                          <tr>
                            <td><?php echo $res['id']; ?></td>
                            <td><?php echo $res['name']; ?></td>
                            <td><?php echo $res['location']; ?></td>
                            <td><?php echo $res['ctc']; ?></td>
                            <td><?php echo $res['hr_name']; ?></td>
                            <td><?php echo $res['hr_email']; ?></td>
                            <td><?php echo $res['hr_contact']; ?></td>
                            <td><?php echo $res['address']; ?></td>
                            <td><?php echo $res['test_mode']; ?></td>
                            <td><a href="update_company.php?id=<?php echo $res['id']; ?>&dept=computer" data-toggle="tooltip" data-placement="bottom" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            <td><a href="delete_companyfromdept.php?id=<?php echo $res['id']; ?>&dept=1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                          </tr>

                          <?php
                        }
                          ?>

        </tbody>
    </table>
     </div>
<br><br>
    <table class="styled-table">
    <hr>       
    <h3>Information Technology Department</h3> 
    <hr>
        <thead>
            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>CTC</th>
                            <th>Name Of HR</th>
                            <th>Email Of HR</th>
                            <th>Contact Number of HR</th>
                            <th>Address</th>
                            <th>Test Mode</th>
                            <th>View</th>
                            <th>Delete</th>
               
            </tr>
        </thead>
        <tbody>
            <?php

                    

                        $selectquery = " select * from company_department,company_id,company_details where company_department.id=company_id.id and company_id.id=company_details.id  and company_department.d_id=2 ";
                        $query = mysqli_query($con,$selectquery);
                
                        while($res = mysqli_fetch_array($query)){

                    ?>
                          <tr>
                            <td><?php echo $res['id']; ?></td>
                            <td><?php echo $res['name']; ?></td>
                            <td><?php echo $res['location']; ?></td>
                            <td><?php echo $res['ctc']; ?></td>
                            <td><?php echo $res['hr_name']; ?></td>
                            <td><?php echo $res['hr_email']; ?></td>
                            <td><?php echo $res['hr_contact']; ?></td>
                            <td><?php echo $res['address']; ?></td>
                            <td><?php echo $res['test_mode']; ?></td>
                            <td><a href="update_company.php?id=<?php echo $res['id']; ?>&dept=IT" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye" aria-hidden="true"></a></i></td>
                            <td><a href="delete_companyfromdept.php?id=<?php echo $res['id']; ?>&dept=2" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                          </tr>

                          <?php
                        }
                          ?>

        </tbody>
    </table>
    <br><br>
    <table class="styled-table">
      <hr>
           <h3>Civil Department</h3> 
           <hr>
        <thead>
            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>CTC</th>
                            <th>Name Of HR</th>
                            <th>Email Of HR</th>
                            <th>Contact Number of HR</th>
                            <th>Address</th>
                            <th>Test Mode</th>
                            <th>View</th>
                            <th>Delete</th>
               
            </tr>
        </thead>
        <tbody>
            <?php

                  

                        $selectquery = " select * from company_department,company_id,company_details where company_department.id=company_id.id and company_id.id=company_details.id  and company_department.d_id=6 ";
                        $query = mysqli_query($con,$selectquery);
                
                        while($res = mysqli_fetch_array($query)){

                    ?>
                          <tr>
                            <td><?php echo $res['id']; ?></td>
                            <td><?php echo $res['name']; ?></td>
                            <td><?php echo $res['location']; ?></td>
                            <td><?php echo $res['ctc']; ?></td>
                            <td><?php echo $res['hr_name']; ?></td>
                            <td><?php echo $res['hr_email']; ?></td>
                            <td><?php echo $res['hr_contact']; ?></td>
                            <td><?php echo $res['address']; ?></td>
                            <td><?php echo $res['test_mode']; ?></td>
                            <td><a href="update_company.php?id=<?php echo $res['id']; ?>&dept=civil" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye" aria-hidden="true"></a></i></td>
                            <td><a href="delete_companyfromdept.php?id=<?php echo $res['id']; ?>&dept=6" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                          </tr>

                          <?php
                        }
                          ?>

        </tbody>
    </table>
     </div>
     <br><br>
     <table class="styled-table">
       <hr>
           <h3>Mechanical Department</h3> 
           <hr>
        <thead>
            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>CTC</th>
                            <th>Name Of HR</th>
                            <th>Email Of HR</th>
                            <th>Contact Number of HR</th>
                            <th>Address</th>
                            <th>Test Mode</th>
                            <th>View</th>
                            <th>Delete</th>
               
            </tr>
        </thead>
        <tbody>
            <?php

                      

                        $selectquery = " select * from company_department,company_id,company_details where company_department.id=company_id.id and company_id.id=company_details.id  and company_department.d_id=5 ";
                        $query = mysqli_query($con,$selectquery);
                
                        while($res = mysqli_fetch_array($query)){

                    ?>
                          <tr>
                            <td><?php echo $res['id']; ?></td>
                            <td><?php echo $res['name']; ?></td>
                            <td><?php echo $res['location']; ?></td>
                            <td><?php echo $res['ctc']; ?></td>
                            <td><?php echo $res['hr_name']; ?></td>
                            <td><?php echo $res['hr_email']; ?></td>
                            <td><?php echo $res['hr_contact']; ?></td>
                            <td><?php echo $res['address']; ?></td>
                            <td><?php echo $res['test_mode']; ?></td>
                            <td><a href="update_company.php?id=<?php echo $res['id']; ?>&dept=mech" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye" aria-hidden="true"></a></i></td>
                            <td><a href="delete_companyfromdept.php?id=<?php echo $res['id']; ?>&dept=5" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                          </tr>

                          <?php
                        }
                          ?>

        </tbody>
    </table>
     </div>
     <br><br>
     <table class="styled-table">
       <hr>
           <h3>Electrical and Electronics Department</h3> 
           <hr>
        <thead>
            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>CTC</th>
                            <th>Name Of HR</th>
                            <th>Email Of HR</th>
                            <th>Contact Number of HR</th>
                            <th>Address</th>
                            <th>Test Mode</th>
                            <th>View</th>
                            <th>Delete</th>
               
            </tr>
        </thead>
        <tbody>
            <?php


                        $selectquery = " select * from company_department,company_id,company_details where company_department.id=company_id.id and company_id.id=company_details.id  and company_department.d_id=4 ";
                        $query = mysqli_query($con,$selectquery);
                
                        while($res = mysqli_fetch_array($query)){

                    ?>
                          <tr>
                            <td><?php echo $res['id']; ?></td>
                            <td><?php echo $res['name']; ?></td>
                            <td><?php echo $res['location']; ?></td>
                            <td><?php echo $res['ctc']; ?></td>
                            <td><?php echo $res['hr_name']; ?></td>
                            <td><?php echo $res['hr_email']; ?></td>
                            <td><?php echo $res['hr_contact']; ?></td>
                            <td><?php echo $res['address']; ?></td>
                            <td><?php echo $res['test_mode']; ?></td>
                            <td><a href="update_company.php?id=<?php echo $res['id']; ?>&dept=ene" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye" aria-hidden="true"></a></i></td>
                            <td><a href="delete_companyfromdept.php?id=<?php echo $res['id']; ?>&dept=4" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                          </tr>

                          <?php
                        }
                          ?>

        </tbody>
    </table>
     </div>
     <br><br>
     <table class="styled-table">
       <hr>
           <h3>Electrical and Telecommunication Department</h3> 
           <hr>
        <thead>
            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>CTC</th>
                            <th>Name Of HR</th>
                            <th>Email Of HR</th>
                            <th>Contact Number of HR</th>
                            <th>Address</th>
                            <th>Test Mode</th>
                            <th>View</th>
                            <th>Delete</th>
               
            </tr>
        </thead>
        <tbody>
            <?php

                       

                        $selectquery = " select * from company_department,company_id,company_details where company_department.id=company_id.id and company_id.id=company_details.id  and company_department.d_id=3 ";
                        $query = mysqli_query($con,$selectquery);
                
                        while($res = mysqli_fetch_array($query)){

                    ?>
                          <tr>
                            <td><?php echo $res['id']; ?></td>
                            <td><?php echo $res['name']; ?></td>
                            <td><?php echo $res['location']; ?></td>
                            <td><?php echo $res['ctc']; ?></td>
                            <td><?php echo $res['hr_name']; ?></td>
                            <td><?php echo $res['hr_email']; ?></td>
                            <td><?php echo $res['hr_contact']; ?></td>
                            <td><?php echo $res['address']; ?></td>
                            <td><?php echo $res['test_mode']; ?></td>
                            <td><a href="update_company.php?id=<?php echo $res['id']; ?>&dept=etc" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye" aria-hidden="true"></a></i></td>
                            <td><a href="delete_companyfromdept.php?id=<?php echo $res['id']; ?>&dept=3" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                          </tr>

                          <?php
                        }
                          ?>

        </tbody>
    </table>
     </div>
     <br><br>
     <table class="styled-table">
       <hr>
           <h3>Mining Department</h3> 
           <hr>
        <thead>
            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>CTC</th>
                            <th>Name Of HR</th>
                            <th>Email Of HR</th>
                            <th>Contact Number of HR</th>
                            <th>Address</th>
                            <th>Test Mode</th>
                            <th>View</th>
                            <th>Delete</th>
               
            </tr>
        </thead>
        <tbody>
            <?php

                    

                        $selectquery = " select * from company_department,company_id,company_details where company_department.id=company_id.id and company_id.id=company_details.id and company_department.d_id=7 ";
                        $query = mysqli_query($con,$selectquery);
                
                        while($res = mysqli_fetch_array($query)){

                    ?>
                          <tr>
                            <td><?php echo $res['id']; ?></td>
                            <td><?php echo $res['name']; ?></td>
                            <td><?php echo $res['location']; ?></td>
                            <td><?php echo $res['ctc']; ?></td>
                            <td><?php echo $res['hr_name']; ?></td>
                            <td><?php echo $res['hr_email']; ?></td>
                            <td><?php echo $res['hr_contact']; ?></td>
                            <td><?php echo $res['address']; ?></td>
                            <td><?php echo $res['test_mode']; ?></td>
                            <td><a href="update_company.php?id=<?php echo $res['id']; ?>&dept=mining" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye" aria-hidden="true"></a></i></td>
                            <td><a href="delete_companyfromdept.php?id=<?php echo $res['id']; ?>&dept=7" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                          </tr>

                          <?php
                        }
                          ?>

        </tbody>
    </table>
     </div>
<hr>
     <caption><h3>All Companies</h3></caption>
     <hr>
     
<table class="styled-table">
    <thead>  
            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>CTC</th>
                            <th>Name Of HR</th>
                            <th>Email Of HR</th>
                            <th>Contact Number of HR</th>
                            <th>Address</th>
                            <th>Test Mode</th>
                            <th>View</th>
                            <th>Delete</th>
               
            </tr>
        </thead>
        <tbody>
            <?php

               

                        $selectquery = " select * from company_details ";
                        $query = mysqli_query($con,$selectquery);
                
                        while($res = mysqli_fetch_array($query)){

                    ?>
                          <tr>
                            <td><?php echo $res['id']; ?></td>
                            <td><?php echo $res['name']; ?></td>
                            <td><?php echo $res['location']; ?></td>
                            <td><?php echo $res['ctc']; ?></td>
                            <td><?php echo $res['hr_name']; ?></td>
                            <td><?php echo $res['hr_email']; ?></td>
                            <td><?php echo $res['hr_contact']; ?></td>
                            <td><?php echo $res['address']; ?></td>
                            <td><?php echo $res['test_mode']; ?></td>
                            <td><a href="update_company.php?id=<?php echo $res['id']; ?>&dept=computer" data-toggle="tooltip" data-placement="bottom" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            <td><a href="delete_company?id=<?php echo $res['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                          </tr>

                          <?php
                        }
                          ?>

        </tbody>
    </table>
     </div>
<br><br>

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