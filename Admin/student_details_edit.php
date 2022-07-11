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

include "dbcon.php"; // Using database connection file here


// $id = $_GET['id']; // get id through query string
$emailx=$_GET['email'];
$qry = mysqli_query($con,"select * from studentdetails where email ='$emailx'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

// $recordmarks = mysqli_query($con,"select * from studentmarks where email='$emailx'"); // fetch data from database
// $datam = mysqli_fetch_array($recordmarks); 

$qrym = mysqli_query($con,"select * from studentmarks where email ='$emailx'"); // select query    
$datam = mysqli_fetch_array($qrym); 

if(isset($_POST['update'])) // when click on Update button
{
    // $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $rollno = $_POST['rollno'];
    $upr = $_POST['upr'];
    $dob = $_POST['dob'];
    if($dob=="mm/dd/yyyy" || $dob==NULL)
    {
      $dob=$data['dob'];
    }
    $gender = $_POST['gender'];
    if($gender==NULL)
    {
      $gender=$data['gender'];

    }
    $phno = $_POST['phno'];
    $department = $_POST['department'];
    if($department=="")
    {
      $department=$data['department'];

    }
    $semester = $_POST['semester'];
    if($semester=="")
    {
      $semester=$data['semester'];

    }
     $street1 = $_POST['street1'];
    $street2 = $_POST['street2'];
    $city = $_POST['city'];
    // $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $placed = $_POST['placed'];
    if($placed=="")
    {
      $placed=$data['placed'];

    }
    $backlogs = $_POST['backlogs'];
    if($backlogs=="")
    {
      $backlogs=$data['backlogs'];

    }
    $tenthmarks = $_POST['tenthmarks'];
    $twelvemarks = $_POST['twelvemarks'];
	
    $sem1 = $_POST['sem1'];
    $sem2 = $_POST['sem2'];
    $sem3 = $_POST['sem3'];
    $sem4 = $_POST['sem4'];
    $sem5 = $_POST['sem5'];
    $sem6 = $_POST['sem6'];
    $sem7 = $_POST['sem7'];
    $sem8 = $_POST['sem8'];
    $cgpa = $_POST['cgpa'];
    // ---------------------------
    // $imagen=$_POST['imagename'];
    // if($imagen==NULL)
    // {
    //   $dst_db=$data['image'];
    // }
    // else
    // {
    //   $var1 = rand(111,999);  // generate random number in $var1 variable
    //   $var2 = rand(111,999);  // generate random number in $var2 variable
    
    //   $var3 = $var1.$var2;  // concatenate $var1 and $var2 in $var3
    //   $var3 = md5($var3);   // convert $var3 using md5 function and generate 32 characters hex number
  
    //   $fnm = $_FILES["image"]["name"];    // get the image name in $fnm variable
    //   $dst = "./all_images/".$var3.$fnm;  // storing image path into the {all_images} folder with 32 characters hex number and file name
    //   $dst_db = "all_images/".$var3.$fnm; // storing image path into the database with 32 characters hex number and file name
  
    //   move_uploaded_file($_FILES["image"]["tmp_name"],$dst);  // move image into the {all_images} folder with 32 characters hex number and image name
      
    // }

    
    // ---------------------------
    
    // ---------------------------
    // $resumen=$_POST['resumen'];
    // if($resumen==NULL)
    // {
    //   $dst_db1=$data['resume'];
    // }
    // else
    // {
    //   $var11 = rand(111,999);  // generate random number in $var1 variable
    //   $var21 = rand(111,999);  // generate random number in $var2 variable
    
    //   $var31 = $var11.$var21;  // concatenate $var1 and $var2 in $var3
    //   $var31 = md5($var31);   // convert $var3 using md5 function and generate 32 characters hex number
  
    //   $fnm1 = $_FILES["resume"]["name"];    // get the image name in $fnm variable
    //   $dst1 = "./all_images/".$var31.$fnm1;  // storing image path into the {all_images} folder with 32 characters hex number and file name
    //   $dst_db1 = "all_images/".$var31.$fnm1; // storing image path into the database with 32 characters hex number and file name
  
    //   move_uploaded_file($_FILES["resume"]["tmp_name"],$dst1);  // move image into the {all_images} folder with 32 characters hex number and image name
      
    // }

    
    $sendmail= $data['email'];
    // ---------------------------
    
    $id=$data['email'];
    // $edit = mysqli_query($con,"update studentdetails set name ='$name' ,gender='$gender' where rollno ='$id'");
    // $edit = mysqli_query($con,"UPDATE studentdetails set fname ='$fname' ,lname ='$lname',rollno ='$rollno',upr ='$upr',dob ='$dob',gender ='$gender',street1 ='$street1',street2 ='$street2',city ='$city',pincode ='$pincode',placed ='$placed',backlogs ='$backlogs',tenthmarks ='$tenthmarks',twelvemarks ='$twelvemarks',department='$department' ,semester='$semester',image='$dst_db' where email='$id'");
    $sql = "UPDATE studentdetails SET  fname ='$fname' ,lname ='$lname',rollno ='$rollno',upr ='$upr',dob ='$dob',gender ='$gender',phno ='$phno',street1 ='$street1',street2 ='$street2',city ='$city',pincode ='$pincode',placed ='$placed',backlogs ='$backlogs',tenthmarks ='$tenthmarks',twelvemarks ='$twelvemarks',department='$department' ,semester='$semester' WHERE email='$id'";

    // ---------------------------
    if ($con->query($sql) === TRUE)
    {
      $sql = "UPDATE studentmarks SET sem1 ='$sem1',sem2 ='$sem2',sem3 ='$sem3',sem4 ='$sem4',sem5 ='$sem5',sem6 ='$sem6',sem7 ='$sem7', sem8 ='$sem8' , cgpa='$cgpa' WHERE email='$id'";
      if ($con->query($sql) === TRUE)
      {

          $con->close(); // Close connection
          header("location: student_details_edit.php?email=$sendmail"); // redirects to all records page
          exit;
      }
      else
      {
        ?>
        <div class=" body-section container">
        <?php 
        echo "Error updating record: " . $con->error;
        ?>
        </div><?php
      }
    }
    else
    {
        // echo mysqli_error();
        ?>
        <div class=" body-section container">
        <?php 
        echo "Error updating record: " . $con->error;
        ?>
        </div><?php
    }    	
    
    // -------- marks-------------------
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
        EDIT STUDENT DETAILS
            <hr>
          <span>
          <div class="container-xl">
        <div class="container ">

            <!-- ----------------------- ------------------------ -->
            <div class="container">
           <!-- -------------- -->
           <form method="post" enctype="multipart/form-data">

            <div class="row">
            <div class="col-25">
            <!-- <label for="image">Image</label> -->
            <label for="image">Profile Image:</label>
            <br>
            </div>
            <div class="col-25">
            <img src="<?php echo $data['image']; ?>" width="200" height="200">
            <br>
            <!-- <input type="text" name="imagename" placeholder="Enter new Image Name"> 
            <br>  -->
            <!-- <input type="file" name="image" >--->
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="resume">Resume:</label>
            <br>
            </div>
            <div class="col-25">
            <a href="<?php echo $data['resume']; ?>" target="_blank"><button type="button" class="btn btn-warning">Resume</button></a> 
            <br>
            <!-- <input type="text" name="resumen" placeholder="Enter new resume file name"> 
            <br>  -->
            <!-- <input type="file" name="resume" > -->
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="internship">Internship</label>
            </div>
            <div class="col-25">
          <a href="student_internship.php?email=<?php echo $data['email'] ?>" ><button class="btn btn-info" type="button">Internship</button></a>  
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="email">Email</label>
            </div>
            <div class="col-75">
            <?php echo $data['email'] ?>
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="fname">First Name</label>
            </div>
            <div class="col-75">
            <input type="text" id="fname" name="fname"  value="<?php echo $data['fname'] ?>" placeholder="Your First name..">
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="lname">Last Name</label>
            </div>
            <div class="col-75">
            <input type="text" id="lname" name="lname"  value="<?php echo $data['lname'] ?>" placeholder="Your last name..">
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="rollno">ROLL NO</label>
            </div>
            <div class="col-25">
            <input type="text" id="rollno" name="rollno"  value="<?php echo $data['rollno'] ?>" placeholder="Your Roll No">
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="upr">University Permanent Number</label>
            </div>
            <div class="col-25">
            <input type="text" id="upr" name="upr"  value="<?php echo $data['upr'] ?>" placeholder="Your UPR">
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="semester">Semester</label>
            </div>
            <div class="col-25">
            selected semester: <?php echo $data['semester'] ?>
            <br>
            <select id="semester" name="semester">
                <option value="" disabled>Semester</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option> 
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="department">Department</label>
            </div>
            <div class="col-25">
            selected value: <?php echo $data['department'] ?>
            <br>
            <select id="department" name="department" >
                        <option value="" disabled>Department</option>
                        <option value="Computer">COMPUTER</option>
                        <option value="IT">IT</option>
                        <option value="ETC">ETC</option>
                        <option value="ENE">E&E</option>
                        <option value="CIVIL">CIVIL</option>
                        <option value="Mechanical">MECHANICAL</option>
                        <option value="Mining">MINING</option>
            </select>
            </div>
            </div>
            <br>
            <div class="row">
              <div class="col-25">
                <label for="dob">Date of Birth </label>
              </div>
              <div class="col-25">
              Entered Value: <?php echo $data['dob'] ?>
            <input type="date" name="dob" placeholder="dob">
            </div>
            </div>
            <br>
            selected value: <?php echo $data['gender'] ?>
            <div class="row">
            <div class="col-25">
            <label for="gender">Gender</label>
            </div>
            <div class="col-25">
            <select id="gender" name="gender">
                <option value="" disabled>Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="address">Address</label>
            </div>
            <div class="col-75">
            Street 1
            <input type="text" name="street1"  value="<?php echo $data['street1'] ?>" placeholder="Street address"/>
            Street 2
            <input type="text" name="street2"  value="<?php echo $data['street2'] ?>" placeholder="Street address line 2"/>
            <br>
            City
            <input type="text" name="city"  value="<?php echo $data['city'] ?>" placeholder="City" />
            <!-- State
            <input type="text" name="state" placeholder="Region" /> -->
            Pincode
            <input type="text" name="pincode"  value="<?php echo $data['pincode'] ?>" placeholder="Postal / Zip code" />
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="phno">Phone No</label>
            </div>
            <div class="col-75">
            <input type="text" name="phno"  value="<?php echo $data['phno'] ?>" placeholder="Phone Number"/>
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="tenthmarks">10 standard percentage(%)</label>
            </div>
            <div class="col-25">
            <input type="text" name="tenthmarks"  value=" <?php echo $data['tenthmarks'] ?>"  placeholder="Percentage %"/>
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="twelvemarks">12 standard percentage(%)</label>
            </div>
            <div class="col-25">
            <input type="text" name="twelvemarks"  value="<?php echo $data['twelvemarks'] ?>" placeholder="Percentage %"/>
          </div>
        </div>
        <br>
        selected value: <?php echo $data['backlogs'] ?>
            <div class="row">
            <div class="col-25">
            <label for="backlogs">Any Backlogs</label>
            </div>
            <div class="col-25">
            <select id="backlogs" name="backlogs">
                <option value="" disabled>Backlogs</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                </select>  
            </div>
            </div>
            <br>
            selected value: <?php echo $data['placed'] ?>
            <div class="row">
            <div class="col-25">
            <label for="placed">Placed or Not</label>
            </div>
            <div class="col-25">
            <select id="placed" name="placed">
                <option value="" disabled>Placed</option>
                <option value="Placed">Placed</option>
                <option value="Not Placed">Not Placed</option>
            </select>
            </div>
            </div>
            <br>
            
            
            <!-- -------------semmarks-------- -->
            Semester marks(CGPA) <br>
            <div class="row">
            <div class="col-25">
            <label for="semmarks">Semester 1: </label>
            </div>
            <div class="col-25">
              <input type="text" name="sem1"  value="<?php echo $datam['sem1'] ?>" placeholder="CGPA"/>
            </div>
          </div>
          <br>
            <div class="row">
            <div class="col-25">
            <label for="semmarks">Semester 1: </label>
            </div>
            <div class="col-25">
              <input type="text" name="sem2"  value="<?php echo $datam['sem2'] ?>" placeholder="CGPA"/>
            </div>
          </div>
          <br>
            <div class="row">
            <div class="col-25">
            <label for="semmarks">Semester 3: </label>
            </div>
            <div class="col-25">
              <input type="text" name="sem3"  value="<?php echo $datam['sem3'] ?>" placeholder="CGPA"/>
            </div>
          </div>
          <br>
            <div class="row">
            <div class="col-25">
            <label for="semmarks">Semester 4: </label>
            </div>
            <div class="col-25">
              <input type="text" name="sem4"  value="<?php echo $datam['sem4'] ?>" placeholder="CGPA"/>
            </div>
          </div>
          <br>
            <div class="row">
            <div class="col-25">
            <label for="semmarks">Semester 5: </label>
            </div>
            <div class="col-25">
              <input type="text" name="sem5"  value="<?php echo $datam['sem5'] ?>" placeholder="CGPA"/>
            </div>
          </div>
          <br>
            <div class="row">
            <div class="col-25">
            <label for="semmarks">Semester 6: </label>
            </div>
            <div class="col-25">
              <input type="text" name="sem6"  value="<?php echo $datam['sem6'] ?>" placeholder="CGPA"/>
            </div>
          </div>
          <br>
            <div class="row">
            <div class="col-25">
            <label for="semmarks">Semester 7: </label>
            </div>
            <div class="col-25">
              <input type="text" name="sem7"  value="<?php echo $datam['sem7'] ?>" placeholder="CGPA"/>
            </div>
          </div>
          <br>
            <div class="row">
            <div class="col-25">
            <label for="semmarks">Semester 8: </label>
            </div>
            <div class="col-25">
              <input type="text" name="sem8"  value="<?php echo $datam['sem8'] ?>" placeholder="CGPA"/>
            </div>
          </div>
          <br>
            <div class="row">
            <div class="col-25">
            <label for="semmarks">CGPA: </label>
            </div>
            <div class="col-25">
              <input type="text" name="cgpa"  value="<?php echo $datam['cgpa'] ?>" placeholder="CGPA"/>
            </div>
          </div>
          <br>
          <!-- -------------semmarks-------- -->
          
            <input type="submit" name="update" value="update">
            </form>
           <!-- -------------- -->
          <!-- </div> -->
        </div>





            <!-- ----------------------------------------------- -->

        <!-- </div>
        </div>
        </div>
        </div> -->
            <!-- ----------------------- -->
        
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