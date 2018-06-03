<?php
session_start();
require_once ("admin_config.php");
if (empty($_SESSION) || !isset($_SESSION['username'])) {
    header("location: /index.php");
}
if ($_SESSION['role'] != 1){
    header("location: /index.php");
}

if (isset($_POST['passwd'])) {
    if(empty($_POST['pass'])){
        $error = true;
    } else {
        $password = $_POST['pass'];
    }

    $sql = "UPDATE member SET pass=? WHERE id=?";

    if ($stmt = mysqli_prepare($usrconn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_id);
        $param_id = $_POST['id'];
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        if (mysqli_stmt_execute($stmt)) {
            header("location: index.php");
        } else {
            die("Oops! Something went wrong. Please try again later.");
        }
    }
    mysqli_stmt_close($stmt);
}
elseif (isset($_POST['urole'])) {
    if(empty($_POST['roles'])){
        $error = true;
    } else {
        if ($_POST['roles'] == 'administrator') $role = 1;
        elseif ($_POST['roles'] == 'seller') $role = 2;
        elseif ($_POST['roles'] == 'basic user') $role = 3;
    }

    if ($_POST['id'] == 1) {
        die("Cannot alter role main administrator account");
    }

    $sql = "UPDATE member SET role=? WHERE id=?";
    if ($stmt = mysqli_prepare($usrconn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ds", $param_role, $param_id);
        $param_id = $_POST['id'];
        $param_role = $role;

        if (mysqli_stmt_execute($stmt)) {
            header("location: index.php");
        } else {
            die("Oops! Something went wrong. Please try again later.");
        }
    }
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/css/signup.css" rel="stylesheet" type="text/css">
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="index.php">Admin</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <button style="margin: 0" data-toggle="dropdown" type="button" class="btn btn-link dropdown-toggle">
                    <img src="<?php echo $_SESSION['profpic']; ?>" style="height: 22px; width: auto; border-radius: 3px">
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/index.php">Shop Home</a>
                    <a class="dropdown-item" href="/edituser.php">Edit profile</a>
                    <a class="dropdown-item" href="/changepassword.php">Change Password</a>
                    <a class="dropdown-item" href="/signout.php">Sign Out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<?php
if (isset($_GET['u'])){
    if (isset($_GET['u']) && $_GET['m'] == 'passwd'){
        ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center main-title">
                    <h2>Change Password</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form name="signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                          onchange="validateInput()" method="post">
                        <input type="hidden" name="id" value="<?php echo $_GET['u']; ?>">
                        <div>
                            <label for="passInput"><strong>Password:</strong></label>
                            <input type="password" name="pass" id="passInput" class="form-control"
                                   oninput="analyzePassword()">
                            <div id="passNotif"></div>
                            <p style="font-size: 10pt">Info: Password harus memiliki panjang minimal 8 karakter.</p>
                        </div>
                        <div>
                            <label for="rePassInput"><strong>Konfirmasi Password:</strong></label>
                            <input type="password" name="repass" id="rePassInput" class="form-control"
                                   onchange="checkPassword()" disabled="disabled">
                            <div id="rePassInfo"></div>
                        </div>
                        <div>
                            <input type="submit" value="Change Password" name="passwd" class="btn btn-primary" id="submitform" disabled="disabled">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            let strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
            let mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");
            let passOK = false;
            let rePassStat = false;

            function analyzePassword() {
                let password = document.getElementById("passInput").value;
                if (password.length < 8) {
                    document.getElementById("passNotif").innerHTML = "<div class='alert alert-danger'>Password harus memiliki setidaknya 8 karakter.</div>";
                    passOK = false;
                }
                else if (strongRegex.test(password)) {
                    document.getElementById("passNotif").innerHTML = "<div class='alert alert-success'>Password Anda cukup kuat.</div>";
                    passOK = true;
                }
                else if (mediumRegex.test(password)) {
                    document.getElementById("passNotif").innerHTML = "<div class='alert alert-warning'>Password Anda agak kuat.</div>";
                    passOK = true;
                }
                else {
                    document.getElementById("passNotif").innerHTML = "<div class='alert alert-danger'>Password Anda harus memiliki salah satu kombinasi dari huruf besar/kecil, angka dan karakter khusus.</div>";
                    passOK = false;
                }
                if (passOK) {
                    document.getElementById("rePassInput").removeAttribute("disabled");
                }
            }

            function checkPassword() {
                let password = document.getElementById("passInput").value;
                let repass = document.getElementById("rePassInput").value;
                if (password === repass) {
                    document.getElementById("rePassInfo").innerHTML = "";
                    rePassStat = true;
                }
                else {
                    document.getElementById("rePassInfo").innerHTML = "<div class='alert alert-danger'>Password tidak sesuai.</div>";
                    rePassStat = false;
                }
            }

            function validateInput() {
                if (rePassStat) {
                    document.getElementById("submitform").removeAttribute("disabled");
                }
                else {
                    document.getElementById("submitform").setAttribute("disabled", "disabled");
                }
            }
        </script>
        <?php
    }
    if (isset($_GET['u']) && $_GET['m'] == 'role'){
        ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center main-title">
                <h2>Change Role</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form name="signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                      method="post">
                    <input type="hidden" name="id" value="<?php echo $_GET['u']; ?>">
                    <div>
                        <label for="roles"><strong>Pilih Role: </strong></label>
                        <select name="roles" class="form-control" id="roles" required>
                            <option>administrator</option>
                            <option>seller</option>
                            <option>basic user</option>
                        </select>
                    </div>
                    <div>
                        <input type="submit" value="Change Role" name="urole" class="btn btn-primary" id="submitform">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    }
}
?>
</body>
</html>