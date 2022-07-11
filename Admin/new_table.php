<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" 
    integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0" crossorigin="anonymous" />


    <link rel="stylesheet" href="new_table.css">
    <title>Document</title>
</head>
<body>
    
<a href="create_new_company.php" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add New Company</span></a>
    
<div class="table-responsive">
    <table class="styled-table">
           <h3>Computer Engineering</h3> 
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
                            <th>Actions</th>
                            <th>    </th>
               
            </tr>
        </thead>
        <tbody>
            <?php

                        include 'dbcon_admin.php';

                        $selectquery = " select * from company_computer ";
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
                            <td><a href="#" data-toggle="tooltip" data-placement="top" title="Update!"><i class="fa fa-edit" aria-hidden="true"></a></i></td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i></td>
                          </tr>

                          <?php
                        }
                          ?>

        </tbody>
    </table>
     </div>

    <table class="styled-table">
           <h3>IT Engineering</h3> 
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
                            <th>Actions</th>
                            <th>    </th>
               
            </tr>
        </thead>
        <tbody>
            <?php

                        include 'dbcon_admin.php';

                        $selectquery = " select * from company_computer ";
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
                            <td><a href="#" data-toggle="tooltip" data-placement="top" title="Update!"><i class="fa fa-edit" aria-hidden="true"></a></i></td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i></td>
                          </tr>

                          <?php
                        }
                          ?>

        </tbody>
    </table>
</body>
</html>



