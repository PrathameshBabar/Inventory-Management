<?php
    session_start();
    $username = "";
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $u_id = $_SESSION['u_id'];
        $access = $_SESSION['access'];
    }
    else{
        header("Location:index.php");
        exit();
    }
    
    if ($access < 30) {
        header("Location:production.php");
        exit();
    }

    $msg = "";

    $firstname = "";
    $lastname = "";
    $username = "";
    $password = "";
    $password = "";
    $access = "";

    if (isset($_POST['firstname']) and 
        isset($_POST['lastname']) and 
        isset($_POST['username']) and 
        isset($_POST['password']) and 
        isset($_POST['access'])) {
        
        $firstname = addslashes($_POST['firstname']);
        $lastname = addslashes($_POST['lastname']);
        $username = addslashes($_POST['username']);
        $password = addslashes($_POST['password']);
        $password = md5($password);
        $access = addslashes($_POST['access']);

        include 'includes/connection.php';
        $sql = "SELECT * FROM `users` WHERE `username`=?;";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "ERROR IN PREPARE STMT";
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $username); 
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $msg = "Username alredy exist";
            }
            else{
                // Insert to database
                $sql = "INSERT INTO `users` (`u_id`, `username`, `password`, `access`, `firstname`, `lastname`, `date_created`) VALUES (NULL, ?, ?, ?, ?, ?, current_timestamp());";
                $stmt = mysqli_stmt_init($con);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "ERROR IN PREPARE STMT";
                }
                else{
                    mysqli_stmt_bind_param($stmt, "sssss", $username, $password, $access, $firstname, $lastname); 
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    header("Location: employee.php");
                }
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vital | Add Employee</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <link href="css/style.css" rel="stylesheet">



</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include 'includes/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include 'includes/topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <!-- Content Row -->
 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Add Employee</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form action="add-employee.php" method="post">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <br>
                                                    <label>First Name</label>
                                                    <input type="text" name="firstname" class="form-control" placeholder="First Name" required="yes" value="<?php echo $firstname; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <br>
                                                    <label>Last Name</label>
                                                    <input type="text" name="lastname" class="form-control" placeholder="Last Name" required="yes" value="<?php echo $lastname; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <br>
                                                    <label>Username</label>
                                                    <input type="text" name="username" class="form-control" placeholder="Username" required="yes" value="<?php echo $username; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <br>
                                                    <label>Password</label>
                                                    <input type="text" name="password" class="form-control" placeholder="Password" required="yes">
                                                </div>
                                                <div class="col-md-6">
                                                    <br>
                                                    <label>Role</label>
                                                    <select class="form-control" name="access" required="yes">
                                                        <option>Select</option>
                                                        <option value="30">Admin</option>
                                                        <option value="20">Clerk</option>
                                                        <option value="10">Worker</option>
                                                    </select>
                                                </div> 
                                                <div class="col-md-6">
                                                    <br>
                                                </div>
                                                <div class="col-md-3">
                                                    <br>
                                                </div>
                                                <div class="col-md-6">
                                                    <br>
                                                    <br>
                                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="ADD EMPLOYEE">
                                                </div>
                                                <div class="col-md-3">
                                                </div>
                                                <div class="col-md-12">
                                                    <br>
                                                    <label style="color: red;">
                                                        <center><?php echo $msg; ?></center>
                                                    </label>
                                                </div>
                                            </div>
                                            
                                    
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include 'includes/footer.php'; ?>

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

</body>

</html>