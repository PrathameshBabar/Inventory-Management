<?php

session_start();


$msg = "<br>";

if (isset($_SESSION['username'])) {
    header("Location:dashboard.php");
    exit();
}

if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = addslashes($_POST['username']);
    $password = md5(addslashes($_POST['password']));

    require 'includes/connection.php';


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
            if ($password == $row['password']) {
                echo "SUCCESS: ".$row['username'];
                $_SESSION['u_id'] = $row['u_id'];
                $_SESSION['username'] = $username;
                $_SESSION['access'] = $row['access'];
                header("Location:production.php");
                
                exit();
            }
            else{
                $msg = "INVALID USERNAME PASSWORD";
            }
        }
        else{
            $msg = "INVALID USERNAME PASSWORD";
        }
    }

    // echo $username . " " . $password;
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

    <title>VITAL</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <br>
                                        <br>
                                        <br>
                                        <h1 class="h4 text-gray-900 mb-4">VITAL</h1>
                                    </div>
                                    <form class="user" action="index.php" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Username" name="username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password">
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="LOGIN">
                                        <br>
                                        <center>
                                            <b><?php echo $msg; ?></b>
                                        </center>
                                        <br>
                                        <br>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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

</body>

</html>