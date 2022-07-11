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
     <title>STUDENT | JOB APPLIED</title>
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
     <li class="active">
       <a href="studentja.php">
         <i class='bx bx-pie-chart-alt-2 active' ></i>
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
        require'dbcon.php';
        $emailx=$_SESSION['email'];
				$query = mysqli_query($con, "SELECT * FROM `studentapplied` WHERE `email`='$emailx'") or die(mysqli_error());

         // <?php echo"$applycount"?>
        <div class="text">Jobs Applied</div>
        
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
            <!-- <p class="container container1 box2">INTERVIEW CALLS :
            <?php
              // $result= mysqli_query($con, "SELECT * FROM `studentapplied` WHERE `email`='$emailx' AND `round3` is NOT NULL");
              // $rows = mysqli_num_rows($result);
              // echo "$rows";
              ?>
            </p> -->
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
        </div>
        <div class="container">
        <span>
        APPLIED DETAILS
            <hr>
          <span>
          <table class="styled-table">
                        <thead>
                            <tr>
                                <th>Job id</th>
                                <th>Round 1</th>
                                <th>Round 2</th>
                                <th>Round 3</th>
                                <th>Round 4</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- select * from  recruiters LIMIT 3 -->
                        <?php $records = mysqli_query($con,"SELECT * FROM `studentapplied` where `email`='$emailx'"); // fetch data from database
                        $valuex=mysqli_num_rows($records);
                        if($valuex != 0)
                        {
                          while($data = mysqli_fetch_array($records))
                          {
                            ?>
                            <tr class="active-row">
                            <td>
                              <?php
                                echo $data['j_id'];
                              ?>   
                            </td>
                            <td>
                              <?php
                                echo $data['round1'];
                              ?>   
                            </td>
                            <td>
                              <?php
                                echo $data['round2'];
                              ?>   
                            </td>
                            <td>
                              <?php
                                echo $data['round3'];
                              ?>   
                            </td>
                            <td>
                              <?php
                                echo $data['round4'];
                              ?> 
                            </td>
                            <td>
                              <?php
                                echo $data['result'];
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
        </span>
        </span>
        </div>
        <div class="container">
        <span>
        JOBS SELECTED
            <hr>
          <span>
          <table class="styled-table">
                        <thead>
                            <tr>
                                <th>Job id</th>
                                <th>Round 1</th>
                                <th>Round 2</th>
                                <th>Round 3</th>
                                <th>Round 4</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- select * from  recruiters LIMIT 3 -->
                        <?php $records = mysqli_query($con,"SELECT * FROM `studentapplied` where `email`='$emailx' AND `result`='placed'");
                        // $result= mysqli_query($conn, "SELECT * FROM `studentapplied` WHERE `email`='$emailx' AND `result` is NOT NULL");
                        // fetch data from database
                        $valuex=mysqli_num_rows($records);
                        if($valuex != 0)
                        {
                          while($data = mysqli_fetch_array($records))
                          {
                            ?>
                            <tr class="active-row">
                            <td>
                              <?php
                                echo $data['j_id'];
                              ?>   
                            </td>
                            <td>
                              <?php
                                echo $data['round1'];
                              ?>   
                            </td>
                            <td>
                              <?php
                                echo $data['round2'];
                              ?>   
                            </td>
                            <td>
                              <?php
                                echo $data['round3'];
                              ?>   
                            </td>
                            <td>
                              <?php
                                echo $data['round4'];
                              ?> 
                            </td>
                            <td>
                              <?php
                                echo $data['result'];
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