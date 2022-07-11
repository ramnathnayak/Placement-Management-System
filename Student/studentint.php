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
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>STUDENT | INTERNSHIP DETAILS</title>
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
     <li class="active">
       <a href="studentint.php">
         <i class='bx bx-customize active' ></i>
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
          <div class="text">Internship Details</div>
      </header>
      <section class="xbody-section">
          <div class="container">
            <h1>STUDENT INTERNSHIP DETAILS</h1>
            <hr>
        <!-- <div class="fhtml fbody fdiv"> -->

          <div class="">
           <!-- -------------- -->
           <?php

            include "dbcon.php"; // Using database connection file here
            $emailx=$_SESSION['email'];
            $records = mysqli_query($con,"select * from studentinternship where email='$emailx'"); // fetch data from database
            //  echo $_SESSION['email'];
            while($data = mysqli_fetch_array($records))
            {
              ?>
              <div class="container">
                <div class="row">
                    <label for="email">Email : </label>
                    <?php echo $data['email']; ?>
                </div>

                <div class="row">
                    <label for="fname">Company Name : </label>
                    <?php echo $data['companyname']; ?>
                </div>

                <div class="row">
                <label for="dob">Start Date : </label>
                <?php echo $data['sdate']; ?>
                </div>

                <div class="row">
                <label for="dob">End Date: </label>
                <?php echo $data['edate']; ?>
                </div>
                <div class="row">
                <label for="dob">Field of Internship: </label>
                <?php echo $data['field']; ?>
                </div>

                <div class="row">
                <label for="phno">Name of Contact Person from Company : </label>
                <?php echo $data['contactperson']; ?>
                </div>
                <div class="row">
                <label for="phno">Designation of Person from Company : </label>
                <?php echo $data['designation']; ?>
                </div>
                <div class="row">
                <label for="phno">Email id of Person from Company : </label>
                <?php echo $data['contactemail']; ?>
                </div>
                <div class="row">
                <label for="phno">Contact Number of Person from Company : </label>
                <?php echo $data['contactnumber']; ?>
                </div>
                
                            <!-- -----------------  -->
                    <a href="studentintedit.php?id=<?php echo $data['id'];?>"><button type="button">Edit</button></a>                                   
                    <a href="studentintdel.php?id=<?php echo $data['id'];?>"><button type="button">DELETE ENTRY</button></a>                                   
                    <!-- <a href="">Edit</a  > -->
                  </div>                                  
            <?php
            }
            ?>
                    </div>
                    <a href="studentintadd.php"><button type="button">ADD ENTRY</button></a> 
                  
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