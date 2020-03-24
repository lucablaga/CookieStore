<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');

mysqli_select_db($con, 'userregistration');
if (isset($_POST['tip'])) {
    if ($_POST['tip'] == "registration") {


        $name = $_POST['user'];
        $pass = $_POST['password'];
        $name = mysqli_escape_string($con, $name);


        $s = "select * from usertable where name='{$name}'";
        $result = mysqli_query($con, $s);
        $num = mysqli_num_rows($result);

        if ($num == 1) {
            header("Location: proiectweb.php?error=1"); // username already taken
        }
        else {
            $reg = "insert into usertable(name,password) values ('$name','$pass')";
            mysqli_query($con, $reg);
            header("Location: proiectweb.php?success=1"); // Registration successful
        }
    }
    elseif ($_POST['tip'] == "login"){


        $name = $_POST['user'];
        $pass = $_POST['password'];
        $name = mysqli_escape_string ($con, $name);

        $s = "select * from usertable where name='$name' && password= '$pass'";
        $result = mysqli_query($con, $s);

        $num = mysqli_num_rows($result);

        if ($num==1){
            $_SESSION['username']=$_POST['user'];
            echo "corect";
            header("Location: home.php?success=2"); // login successful
        }
        else{
            echo "incorect";
            header("Location:proiectweb.php?error=2"); // unsuccessful login
        }

    }
}
?>


<html>
<head>
    <title>User Login and registration</title>
    <link rel="stylesheet" type="text/css"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style1.css">

</head>
<div>

    <div class="container">
        <div class="login-box">
            <div class="row">

                <div class="login-left">
                    <h2> Login Here </h2>
                    <?php if (isset($_GET['error']) and $_GET['error'] == 2) { ?> <span style="color: red"> Unsuccesfull login. </span> <?php } ?>
                    <?php if (isset($_GET['success']) and $_GET['success'] == 2) { ?> <span style="color: green"> Successful login. </span> <?php } ?>
                    <form action="" method="post">
                        <input type="hidden" name="tip" value="login">
                        <div class="form-group"
                        <label>Username</label>
                        <input type="text" name="user" class="form-control" required>
                </div>
                <div class="form-group"
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn-primar"> Login</button>
            </form>
        </div>

        <div class="login-right">
            <h2> Register Here </h2>
            <?php if (isset($_GET['error']) and $_GET['error'] == 1) { ?><span style="color:red">Username is already taken.</span>  <?php } ?>
            <?php if (isset($_GET['success']) and $_GET['success'] == 1) { ?><span style="color: green ">Registration successful.</span> <?php } ?>
            <form action="" method="post">
                <input type="hidden" name="tip" value="registration">
                <div class="form-group"
                <label>Username</label>
                <input type="text" name="user" class="form-control" required>
        </div>
        <div class="form-group"
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn-primar"> Register</button>
    </form>

</div>

</div>


</div>
</div>

</body>
</html>