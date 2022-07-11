<?php
	session_start();
	if(!ISSET($_SESSION['username'])){
		header('location:login.php');
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="studentdash.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>STUDENT | DASHBOARD</title>
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
        <h2 class="logo_name">STUDENT</h2>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li class="active">
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
     <li>
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
        <?php
        include 'dbcon.php';
        $emailx=$_SESSION['username']; 
        // <?php echo"$applycount"?>
        <div class="text">Dashboard <?php echo "<h5 class='righter' style='text-align: right'>Hello ".$emailx."</h5>";
        

        // ---------------
        $emailx=$_SESSION['email'];
				$query = mysqli_query($con, "SELECT * FROM `studentdetails` WHERE `email`='$emailx'") or die(mysqli_error());
       
        // ---------------
        ?>
      </div>
        
        <!-- ?> -->
      </header>
      <section class="body-section">
          <div class="container">
            STUDENT ACTIVITY
            <hr>
        <span>
            <p class="container container1 box1">JOBS APPLIED :
              <?php
              $result= mysqli_query($con, "SELECT * FROM `studentapplied` WHERE `email`='$emailx'");
              $rows = mysqli_num_rows($result);
              echo "$rows";
              ?>
            </p>
            <!-- <p class="container container1 box2">INTERVIEW CALLS : -->
            <!-- <?php
              // $result= mysqli_query($con, "SELECT * FROM `studentapplied` WHERE `email`='$emailx' AND `round3` is NOT NULL");
              // $rows = mysqli_num_rows($result);
              // echo "$rows";
              ?> -->
            <!-- </p> -->
            <!-- <p class="container container1 box3">JOB COMPLETE:
            <?php
              // $result= mysqli_query($con, "SELECT * FROM `studentapplied` WHERE `email`='$emailx' AND `result` is NOT NULL"); 
              // $rows = mysqli_num_rows($result);
              // echo "$rows";
              ?>
            </p> -->
            <p class="container container1 box4">JOBS SELECTED :
            <?php
              $result= mysqli_query($con, "SELECT * FROM `studentapplied` WHERE `email`='$emailx' AND `result`='Placed'");
              $rows = mysqli_num_rows($result);
              echo "$rows";
              ?>
            </p>
        </span>
        <p>
               <a href="studentja.php"><button type="button">Details</button></a>
        </p>
        </div>
        <div class="container">
        <span>
            <p>PLACEMENT DRIVES </p>
            <hr>
            <span>
                <p>
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>Date of Post</th>
                                <th>Company Name</th>
                                <th>Sector</th>
                                <th>Vacancy</th>
                                <th>Deadline to Apply</th>
                                <th></th>
                            </tr>  
                          </thead> 
                        <tbody>
                        <!-- --------------------------------- -->
                        <?php

                          $emailx=$_SESSION['email'];
                                                      
                          $recordsdept = mysqli_query($con,"select * from studentdetails where email='$emailx'"); // fetch data from database
                          $datadept = mysqli_fetch_array($recordsdept);
                          $dept=$datadept['department'];
                          $dept_id=0;
                          // echo $dept;
                          switch($dept)
                          {
                            case 'Computer': $dept_id=1;
                                              break;
                            case 'IT': $dept_id=2;
                                              break;
                            case 'ETC': $dept_id=3;
                                              break;
                            case 'ENE': $dept_id=4;
                                              break;
                            case 'Mechanical': $dept_id=5;
                                              break;
                            case 'Civil': $dept_id=6;
                                              break;
                            case 'Mining': $dept_id=7;
                                              break;
                          }

                          $records = mysqli_query($con,"select * from post_job,company_id,company_department where post_job.id=company_id.id and company_department.d_id='$dept_id' and post_job.id=company_department.id order by post_date desc limit 3"); 
                                                  ?>
                        <!-- --------------------------------- -->

                        <!-- select * from  recruiters LIMIT 3 -->
                        <?php
                         // fetch data from database
                      
                          while($data = mysqli_fetch_array($records))
                            {
                              ?>
                              <tr class="active-row">
                              <td>
                                <?php
                                  echo $data['post_date'];
                                ?>   
                              </td>
                              <td>
                                <?php
                                  echo $data['name'];
                                ?>   
                              </td>
                              <td>
                                <?php
                                  echo $data['sector'];
                                ?>   
                              </td>
                              <td>
                                <?php
                                  echo $data['vacancy'];
                                ?>   
                              </td>
                              <td>
                                <?php
                                  echo $data['deadline'];
                                  //$data['link'];
                                ?> 
                              </td>
                            </tr>
                          <?php 
                            } ?>
                        </tbody>
                    </table>
                    <p>
                        <a href="studentpd.php"><button type="button">SEE MORE JOBS</button></a>
                    </p>
                </p>
            </span>
        </span>
        </div>
      </section>
  </section>

  <script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();
  });

  searchBtn.addEventListener("click", ()=>{ 
    sidebar.classList.toggle("open");
    menuBtnChange(); 
  });

  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");
   }
  }
  </script>
</body>
</html>