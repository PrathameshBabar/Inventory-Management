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

    require 'includes/connection.php';


    if (isset($_GET['e_id'])) {
        $e_id = addslashes($_GET['e_id']);
        // echo "DELETING ITEM ".$i_id;

        $sql = "SELECT * FROM `purchased` WHERE `e_id`=?;";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "ERROR IN PREPARE STMT";
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $e_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $e_id = $row['e_id'];
                $itemcode = $row['item_code'];
                $date = $row['date'];
                $quantity = $row['quantity'];
            }
            else{
                header("Location: production.php");
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

    <title>Vital | Edit Purchased</title>

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
                                    <h6 class="m-0 font-weight-bold text-primary">EDIT PURCHASED</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form action="p-raw.php" method="post">
                                        <div class="form-group">
                                            <label>Item Code</label>
                                                <select name="itemcode" class="form-control" required="yes">
                                                    <option value="<?php echo $itemcode; ?>"><?php echo $itemcode; ?></option>
                                                    
                                                </select>
                                            <br>
                                            <label>Date</label>
                                            <input type="date" name="date" class="form-control" placeholder="Date" required="yes" value="<?php echo $date; ?>">
                                            <br>
                                            <label>Quantity</label>
                                            <input type="number" name="quantity" class="form-control" placeholder="Quantity" required="yes" value="<?php echo $quantity; ?>">
                                            <br>
                                            <input type="hidden" name="e_id" value="<?php echo $e_id; ?>">
                                            <input type="submit" class="btn btn-primary btn-user btn-block" value="UPDATE PRODUCT">
                                            <br>
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