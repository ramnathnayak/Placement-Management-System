<?php

session_start();
if(!ISSET($_SESSION['username'])){
  header('location:login.php');
}
include 'dbcon.php' ;

$jobid=$_GET['jobid'];

$emailx=$_SESSION['email'];
$records = mysqli_query($con,"select * from studentmarks where email='$emailx'"); // fetch data from database
$data = mysqli_fetch_array($records);

$recordx = mysqli_query($con,"select * from studentdetails where email='$emailx'"); // fetch data from database
$datax = mysqli_fetch_array($recordx);

$recordm = mysqli_query($con,"select * from post_job where j_id='$jobid'"); // fetch data from database
$datam = mysqli_fetch_array($recordm);
// {

// }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="studentdash.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>STUDENT | STUDENT APPLY</title>
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
     <li class="active">
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
          <div class="text">Company Profile</div>
      </header>
      <section class="xbody-section">
          <div class="container">
            <h1>JOB APPLICATION</h1>
            <hr>
        <!-- <div class="fhtml fbody fdiv"> -->

          <div class="">
           <!-- -------------- -->
           <?php

              ?>
              <div class="container">
                <div class="row">
                 <?php 
                //  echo $data['cgpa'];
                    //  echo $datam['criteria'];
                    //  echo $datax['backlogs']; -->

                     $userquery = "select * from studentapplied where email='$emailx' and j_id='$jobid'";
                     $uquery = mysqli_query($con,$userquery);
                    $usercount = mysqli_num_rows($uquery);

        if($usercount>0){
        ?>
            <script>
                alert("You have already applied");
                window.history.back(-1);
             </script>
            <?php
     }
     else
        {        
                      $todayd=date("Y/m/d");
                      $deadlined=$datam['deadline'];
                      $deadlined = strtotime($deadlined);
                      $todayd = strtotime($todayd);
                      if($deadlined>=$todayd)
                      {
                            if($data['cgpa']>=$datam['criteria'] )
                            {
                              if($datax['backlogs']=='No')
                              {
                                echo "You are Eligible for Job\n";
                                    $insert = mysqli_query($con,"INSERT INTO `studentapplied`(`email`,`j_id`) VALUES ('$emailx','$jobid')");
                                      if(!$insert)
                                      {
                                          echo mysqli_error();
                                          echo "Not Applied Successfully";
                                      }
                                      else
                                      {
                                          echo ",Applied for Job successfully.";
                                      }
                               }
                               else
                               {
                                 echo "You are Not Eligible To apply for Job";
                               }
                            }
                            else
                            {
                                    echo "You are Not Eligible To apply for Job";
                            }
                        } 
                      else
                      {
                            echo "Sorry you cannot apply now Deadline is over for job. Explore New jobs on Portal ! ";
                      }
                            
     }
                ?>
                </div>
                
                            <!-- -----------------  -->
                    <!-- <a href="studentintedit.php?id="><button type="button">Edit</button></a>                                   
                    <a href="studentintdel.php?id="><button type="button">DELETE ENTRY</button></a>                                   
                    <a href="">Edit</a  > -->
                  </div>                                  
            <?php
            
            ?>
                    </div>
                    <a href="studentpd.php"><button type="button">Go Back</button></a> 
                  
                <!-- ?id=echo $data['email']; "> -->
                <!-- <a href="delete.php?id=
                ">Delete</a> --
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