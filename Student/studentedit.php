<?php
session_start();
include "dbcon.php"; // Using database connection file here
if(!ISSET($_SESSION['username'])){
  header('location:login.php');
}

// $id = $_GET['id']; // get id through query string
$emailx=$_SESSION['email'];
$qry = mysqli_query($con,"select * from studentdetails where email ='$emailx'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

// $recordmarks = mysqli_query($con,"select * from studentmarks where email='$emailx'"); // fetch data from database
// $datam = mysqli_fetch_array($recordmarks); 

$qrym = mysqli_query($con,"select * from studentmarks where email ='$emailx'"); // select query    
$datam = mysqli_fetch_array($qrym); 

if(isset($_POST['update'])) // when click on Update button
{
  $n=0;
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
    if(!empty($sem1))
    {
        $n++;
    }
    $sem2 = $_POST['sem2'];
    if(!empty($sem2))
    {
        $n++;
    }
    $sem3 = $_POST['sem3'];
    if(!empty($sem3))
    {
        $n++;
    }
    $sem4 = $_POST['sem4'];
    if(!empty($sem4))
    {
        $n++;
    }
    $sem5 = $_POST['sem5'];
    if(!empty($sem5))
    {
        $n++;
    }
    $sem6 = $_POST['sem6'];
    if(!empty($sem6))
    {
        $n++;
    }
    $sem7 = $_POST['sem7'];
    if(!empty($sem7))
    {
        $n++;
    }
    $sem8 = $_POST['sem8'];
    if(!empty($sem8))
    {
        $n++;
    }
    // $cgpa = $_POST['cgpa'];
    $cgpa = ($sem1+$sem2+$sem3+$sem4+$sem5+$sem6+$sem7+$sem8)/$n;
    $cgpa=round($cgpa,2);
    // ---------------------------
    $imagen=$_POST['imagename'];
    if($imagen==NULL)
    {
      $dst_db=$data['image'];
    }
    else
    {
      $var1 = rand(11111,99999);  // generate random number in $var1 variable
      $var2 = rand(11111,99999);  // generate random number in $var2 variable
    
      $var3 = $var1.$var2;  // concatenate $var1 and $var2 in $var3
      $var3 = md5($var3);   // convert $var3 using md5 function and generate 32 characters hex number
  
      $fnm = $_FILES["image"]["name"];    // get the image name in $fnm variable
      $dst = "./all_images/".$var3.$fnm;  // storing image path into the {all_images} folder with 32 characters hex number and file name
      $dst_db = "all_images/".$var3.$fnm; // storing image path into the database with 32 characters hex number and file name
  
      move_uploaded_file($_FILES["image"]["tmp_name"],$dst);  // move image into the {all_images} folder with 32 characters hex number and image name
      
    }

    
    // ---------------------------
    
    // ---------------------------
    $resumen=$_POST['resumen'];
    if($resumen==NULL)
    {
      $dst_db1=$data['resume'];
    }
    else
    {
      $var11 = rand(111,999);  // generate random number in $var1 variable
      $var21 = rand(111,999);  // generate random number in $var2 variable
    
      $var31 = $var11.$var21;  // concatenate $var1 and $var2 in $var3
      $var31 = md5($var31);   // convert $var3 using md5 function and generate 32 characters hex number
  
      $fnm1 = $_FILES["resume"]["name"];    // get the image name in $fnm variable
      $dst1 = "./all_images/".$var31.$fnm1;  // storing image path into the {all_images} folder with 32 characters hex number and file name
      $dst_db1 = "all_images/".$var31.$fnm1; // storing image path into the database with 32 characters hex number and file name
  
      move_uploaded_file($_FILES["resume"]["tmp_name"],$dst1);  // move image into the {all_images} folder with 32 characters hex number and image name
      
    }

    
    // ---------------------------
    
    $id=$_SESSION['email'];
    // $edit = mysqli_query($con,"update studentdetails set name ='$name' ,gender='$gender' where rollno ='$id'");
    // $edit = mysqli_query($con,"UPDATE studentdetails set fname ='$fname' ,lname ='$lname',rollno ='$rollno',upr ='$upr',dob ='$dob',gender ='$gender',street1 ='$street1',street2 ='$street2',city ='$city',pincode ='$pincode',placed ='$placed',backlogs ='$backlogs',tenthmarks ='$tenthmarks',twelvemarks ='$twelvemarks',department='$department' ,semester='$semester',image='$dst_db' where email='$id'");
    $sql = "UPDATE studentdetails SET  fname ='$fname' ,lname ='$lname',rollno ='$rollno',upr ='$upr',dob ='$dob',gender ='$gender',phno ='$phno',street1 ='$street1',street2 ='$street2',city ='$city',pincode ='$pincode',placed ='$placed',backlogs ='$backlogs',tenthmarks ='$tenthmarks',twelvemarks ='$twelvemarks',department='$department' ,semester='$semester',image='$dst_db',resume='$dst_db1' WHERE email='$id'";

    // ---------------------------

    if ($con->query($sql) === TRUE)
    {
      $sql = "UPDATE studentmarks SET sem1 ='$sem1',sem2 ='$sem2',sem3 ='$sem3',sem4 ='$sem4',sem5 ='$sem5',sem6 ='$sem6',sem7 ='$sem7', sem8 ='$sem8' , cgpa='$cgpa' WHERE email='$id'";
      if ($con->query($sql) === TRUE)
      {
          $con->close(); // Close connection
          header("location: studentcd.php"); // redirects to all records page
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
    <link rel="stylesheet" href="studentdash.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>STUDENT | STUDENT EDIT</title>
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
      <li class="active">
       <a href="studentcd.php">
         <i class='bx bx-user' ></i>
         <span class="links_name">Change Details</span>
       </a>
       <span class="tooltip">Change Details</span>
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
         <i class='bx bx-menu' ></i>
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
          <div class="text">Edit Details</div>
      </header>
      <section class="cbody-section">
          <div class="container">
          <h1 align="center" >EDIT STUDENT DETAILS</h1>
            <hr>
        <!-- <div class="fhtml fbody fdiv"> -->

          <div class="container">
           <!-- -------------- -->
           <form method="post" enctype="multipart/form-data">

            <div class="row">
            <div class="col-25">
            <!-- <label for="image">Image</label> -->
            <label for="image">Change Profile Image:</label>
            <br>
            </div>
            <div class="col-25">
            <img src="<?php echo $data['image']; ?>" width="100" height="100">
            <br>
            <input type="text" name="imagename" placeholder="Enter new Image Name"> 
            <br> 
            <input type="file" name="image" >
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-25">
            <label for="resume">Update Resume:</label>
            <br>
            </div>
            <div class="col-25">
            <a href="<?php echo $data['resume']; ?>" target="_blank"><button type="button">Resume</button></a> 
            <br>
            <input type="text" name="resumen" placeholder="Enter new resume file name"> 
            <br> 
            <input type="file" name="resume" >
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
                <option value="" >Semester</option>
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
                        <option value="" >Department</option>
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
            Entered Value: <?php echo $data['dob'] ?>
            <div class="row">
              <h4>Adding dob is must if NULL *</h4>
            <div class="col-25">
            <label for="dob">Date of Birth </label>
            </div>
            <div class="col-75">
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
                <option value="" >Gender</option>
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
            <input type="text" name="tenthmarks" value="<?php echo $data['tenthmarks'] ?>"  placeholder="Percentage %"/>
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
                <option value="" >Backlogs</option>
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
                <option value="" >Placed Status</option>
                <option value="Placed">Placed</option>
                <option value="Not Placed">Not Placed</option>
            </select>
            </div>
            </div>
            <br>
            
            
            <!-- -------------semmarks-------- -->
            Semester marks(CGPA) <br>
            <h6>Enter 2 digits after decimal</h6>
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
            <label for="semmarks">Semester 2: </label>
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
              <input type="text" name="cgpa"  value="<?php echo $datam['cgpa'] ?>" placeholder="CGPA" readonly/>
            </div>
          </div>
          <br>
          <!-- -------------semmarks-------- -->
          
            <input type="submit" name="update" value="update">
            </form>
           <!-- -------------- -->
          <!-- </div> -->
        </div>
        <hr>
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