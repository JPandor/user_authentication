<?php
    session_start();

    include ("connect.php");

    if (isset ($_POST['email'])){
        //getting user input 
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $user_type = $_POST['user-role'];
        $security = $_POST['security'];

        //getting user role
        if ($user_type == "librarian"){
            $user_type = true;
        }else {
            $user_type = 0;
        }

        //sql for adding user 
        $sql = "INSERT INTO users (email, password, librarian, colour)
        VALUES ('$email', '$password', $user_type, '$security')";


        //adding user to database
        if ($conn->query($sql) === TRUE) {
            $_SESSION['new_user'] = true;
            header("Location: login.php");
        
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign Up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form validate-form" action="sign_up.php" method="post">
                    <span class="login100-form-title p-b-49">
                        Sign Up
                    </span>
                    <?php
                        if ($_SESSION['delete_acc'] == true){
                            echo "<div class='alert alert-danger' role='alert'>
                            Your account has been deleted. Goodbye :(
                            </div>";
                            $_SESSION['delete_acc'] = false;
                        }
                    ?>
                    <div class="wrap-input100 validate-input m-b-23" data-validate="Email is required">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="text" name="email" placeholder="Type your email">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input  m-b-23" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Type your password">
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Security question is required">
                        <span class="label-input100">What is your favourite colour?</span>
                        <input class="input100" type="text" name="security" placeholder="Type your favourite colour">
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>


                    <div class="wrap-input100 p-t-15 p-b-15">
                        <label class="label-input100" for="user-role">Please select a user type:</label><br>
                        <select class="select" name="user-role" id="user-role">
                            <option class="input100 option" value="librarian">Librarian</option>
                            <option class="input100" value="member">Member</option>
                        </select>
                    </div>

                    <div class="container-login100-form-btn p-t-31">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn" type="submit">
                                Sign Up
                            </button>
                        </div>
                    </div>

                    <div class="flex-col-c p-t-50">
						<span class="txt1 p-b-17">
							Already a member?
						</span>

						<a href="login.php" class="txt2">
							Login
						</a>
					</div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>

</html>

<?php

}

?>