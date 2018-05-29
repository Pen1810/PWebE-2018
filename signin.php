<?php
require_once ("config.php");
session_start();
if (!empty($_SESSION) && isset($_SESSION['username'])) {
    header("location: index.php");
}

$username = $password = "";
$error = false;

if(isset($_POST['submit'])){
    if(empty(trim($_POST["username"]))){
        $error = true;
    }
    else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST['password']))){
        $error = true;
    }
    else{
        $password = trim($_POST['password']);
    }

    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT username, pass, role, profpic FROM member WHERE username = ?";

        if($stmt = mysqli_prepare($usrconn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password, $role, $profpic);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['role'] = $role;
                            $_SESSION['profpic'] = $profpic;
                            header("location: index.php");
                        }
                        else{
                            $error = true;
                        }
                    }
                }
                else{
                    $error = true;
                }
            }
            else{
                die("Oops! Something went wrong. Please try again later.");
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($usrconn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/signup.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center main-title">
            <h2>Sign-in to Sample Shopping</h2>
        </div>
    </div>
    <?php
    if (isset($_GET['register']) && $_GET['register'] == "success"){
        echo "<div class='row'>";
        echo "<div class='col-sm-12 alert alert-success'>Anda telah terdaftar. Silakan masuk menggunakan akun Anda.</div>";
        echo "</div>";
    }
    ?>
    <div class="row">
        <div class="col-sm-12">
            <form name="signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                  onchange="validateInput()" method="post">
                <div>
                    <label for="usernameInput"><strong>Username atau email:</strong></label>
                    <input type="text" name="username" id="usernameInput"
                           class="form-control" <?php if ($error) echo "value='" . $_POST['username'] . "'" ?>>
                </div>
                <div>
                    <label for="passInput"><strong>Password:</strong></label>
                    <input type="password" name="pass" id="passInput" class="form-control"
                           oninput="analyzePassword()">
                    <?php if ($error) echo "<div class='alert alert-danger'>Username atau password tidak valid!</div>" ?>
                </div>
                <div>
                    <input type="submit" value="Sign In" name="submit" class="btn btn-primary" id="submitform">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>