<?php
session_start();   

    include('connection.php');
    // $haslog = (isset($_SESSION['hasLog'])?$_SESSION['hasLog']:0);

    if (isset($_SESSION['hasLog'])){
        $haslog = $_SESSION['hasLog'];
    }else{
        $haslog = 0;
    }

    if (empty($haslog)){
        header("location: login.php");
        exit;
    }

    $sql = "select ID, Student_ID, CONCAT(First_Name,' ', Last_Name) as StudName,Image,Blood_Type,Height,Weight,Status, Event ,Sex, Age, Address, Phone, Course, Year_Level from athletes where Year_Level=3";
    $results = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<?php
    include('header.php');
?>






<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.css"/>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
            include ('menu.php');
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <a href ="athleteAdd.php"><button class="btn btn-primary mb-3 mt-3" >Add New Athlete</button> </a>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo " ".$_SESSION['Name']." ";?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    
                       <div class="card card-outline rounded-0 card-maroon">
    <div class="card-header">
        <h3 class="card-title">List of Third Year Athletes</h3>
        
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="table-responsive">
            <table class="table table-bordered text-start" id="example" width="100%" cellspacing="0">

                
                <thead>
                    <tr class="bg-primary text-white">
                    
                        <th class="text-center">Action</th>
                        <th class="text-center">Student ID</th>
                        <th class="text-center">Student Name</th>
                        <th class="text-center">Sex</th>
                        <th class="text-center">Event</th>
                        <th class="text-center">Age</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Course</th>
                        



                        

                        
                        
                    </tr>
                </thead>
                <tbody>

                <?php
                                foreach ($results as $result) {
                                    echo '<tr>
                                            <td>

                                            <a class="mr-2" href="#?id='.$result['ID'].'" data-bs-toggle="modal" data-bs-target="#athleteModal'.$result['ID'].'"><i class="fa fa-eye"></i></a>
                                                <a class = "mr-2" href = "athleteEdit.php?id='.$result['ID'].'">
                                                <i class = "fa fa-edit"></i>
                                                </a>

                                                <a href = "athleteDelete.php?id='.$result['ID'].'">
                                                <i class = "fa fa-trash text-danger"></i>
                                                </a>


                                            </td>
                                            <td>'.$result['Student_ID'].'</td>
                                            <td>'.$result['StudName'].'</td>
                                            <td>'.$result['Sex'].'</td>
                                            <td>'.$result['Event'].'</td>
                                            <td>'.$result['Age'].'</td>
                                            <td>'.$result['Address'].'</td>
                                            <td>'.$result['Phone'].'</td>
                                            <td>'.$result['Course'].'</td>
                                           

                                        </tr>';

                                        echo '<div class="modal fade" id="athleteModal'.$result['ID'].'" tabindex="-1" aria-labelledby="athleteModal'.$result['ID'].'" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">'.$result['StudName'].'</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                        <div class="modal-body">
                            <img src="'.$result['Image'].'" alt="Athlete Image" height="150" width="150">
                            <p><strong>Student ID:</strong> '.$result['Student_ID'].'</p>
                            <p><strong>Event:</strong> '.$result['Event'].'</p>
                            <p><strong>Sex:</strong> '.$result['Sex'].'</p>
                            <p><strong>Age:</strong> '.$result['Age'].'</p>
                            <p><strong>Blood Type:</strong> '.$result['Blood_Type'].'</p>
                            <p><strong>Height:</strong> '.$result['Height'].'</p>
                            <p><strong>Weight:</strong> '.$result['Weight'].'</p>
                            
                            <p><strong>Year Level:</strong> '.$result['Year_Level'].'</p>
                            <p><strong>Course:</strong> '.$result['Course'].'</p>
                            <p><strong>Status:</strong> '.$result['Status'].'</p>
                            <p><strong>Address:</strong> '.$result['Address'].'</p>
                            <p><strong>Phone:</strong> '.$result['Phone'].'</p>
                          
                            
                            

                        </div>
                    </div>
                </div>
            </div>';
                                }

                            ?>

                      </div> 
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.js"></script> 
    
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="assetsDT/js/bootstrap.bundle.min.js"></script>
    <script src="assetsDT/js/jquery-3.6.0.min.js"></script>
    <script src="assetsDT/js/pdfmake.min.js"></script>
    <script src="assetsDT/js/vfs_fonts.js"></script>
    <script src="assetsDT/js/custom.js"></script>
    <script src="assetsDT/js/datatables.min.js"></script>

    <script src="js/sweetalert2.all.min.js"></script>
  <script src="js/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script src="js/delete.js"></script>

<?php
   if(isset($_SESSION['status']) && $_SESSION['status'] !=''){
    ?>
      <script>
      swal({
      title: "<?php echo $_SESSION['status'];?>",
      icon: "<?php echo $_SESSION['status_code'];?>",
       });
 </script>
 <?php
      unset($_SESSION['status']);
   }
?>


</body>

</html>