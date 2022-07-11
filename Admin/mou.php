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
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="new_table.css">
    <title>MOU | Admin</title>

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" 
    integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0" crossorigin="anonymous" />



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
     <li class="active">
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
      <div class="text">MEMORANDUM OF UNDERSTANDING </div>

      <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>VIEW MOU'S </h2>
                        </div>
                    </div>
                </div>
                <a href="mouadd.php" class="btn btn-success" data-toggle="tooltip">
                <span>Add New MOU</span></a>

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>MEMORANDUM OF UNDERSTANDING NAME</th>
                            <th>READ MOU</th>
                            <th>DELETE MOU </th>
                        </tr>
                    </thead>
                    <tbody>
                            
                    <?php

                        include 'dbcon.php';

                        $selectquery = " select * from mou ";
                        $query = mysqli_query($con,$selectquery);

                        $nums = mysqli_num_rows($query);
                
                        while($res = mysqli_fetch_array($query)){

                    ?>
                          <tr>
                            <td><?php echo $res['mouname']; ?></td>
                            <!-- <td><a href="addmou.php" data-toggle="tooltip" data-placement="top" title="Update!"><i class="fa fa-edit" aria-hidden="true"></a></i></td> -->
                            <td><a href="<?php echo $res['moulocation'];?>" class="btn btn-success" target="_blank" data-toggle="tooltip">
                <span>View MOU</span></a></td>
                            <!-- <td><a href="delmou.php" data-toggle="tooltip" data-placement="top" title="Update!"><i class="fa fa-trash" aria-hidden="true"></a></i></td> -->
                            <!-- <td><i class="fa fa-trash" aria-hidden="true"></i></td> -->
                            <td><a href="moudelete.php?mouid=<?php echo $res['mouid'];?>" class="btn btn-danger"  data-toggle="tooltip">
                <span>DELETE MOU</span></a></td>
                          </tr>

                          <?php
                        }
                          ?>

                    </tbody>
                </table>
            </div>
        </div>        
    </div>

      

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

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