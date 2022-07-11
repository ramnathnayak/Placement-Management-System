<?php
	session_start();
	include 'dbcon.php';
  if(!ISSET($_SESSION['username'])){
		header('location:finallogin.php');
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="studentdash.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>STUDENT | PLACEMENT DRIVES</title>
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
         <i class='bx bx-calendar-check active' ></i>
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
          <div class="text">Placement Drives</div>
      </header>
      <section class="body-section">
        <div class="container">
        <span>
            <p>Job Openings </p>
            <hr>
            <span>
                <p>
                  <script>
                    $("#tableid").width($(window).width());
                  </script>
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>Date of Post</th>
                                <th>Company Name</th>
                                <th>Sector</th>
                                <th>Vacancy</th>
                                <th>Deadline to Apply</th>
                                <th>Read in Details</th>
                                <th>Apply Now</th>
                            </tr>
                        </thead>
                        <tbody>
                           
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
                            
                            $records = mysqli_query($con,"select * from post_job,company_id,company_department where post_job.id=company_id.id and company_department.d_id='$dept_id' and post_job.id=company_department.id   order by post_date desc"); // fetch data from database
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
                                  // $data['link'];
                                ?>   
                              </td>    
                              <td>
                               <!-- <a href="$data['link'];" target="_blank"><button type="button">READ MORE</button></a> -->
                               <a href="studentapplyrm.php?jobid=<?php echo $data['j_id'];?>"><button type="button">READ MORE</button></a>  
                                  <!-- <?php
                                      // echo ".data['link']";   
                                  ?> -->
                                </td>
                              <td>
                                <a href="studentapply.php?jobid=<?php echo $data['j_id'];?>"><button type="button">APPLY NOW</button></a>                                   
                               </td>
                              <?php
                              // echo "<td><a href='$data['link']'>View More</a>' . '</td>";
                            }
                            ?>
                            </tr>
                                  <!-- <td><a href="" target="_blank"><button type="button">READ MORE</button></a</td>-->
                        </tbody>
                    </table>
                    <!-- <p> <a href="studentpd.html"><button type="button">SEE MORE JOBS</button></a> </p> -->
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