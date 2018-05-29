<?php
require_once ("config.php");
session_start();
$username = $_SESSION['username'];
$password = "";
$error = false;

if(isset($_POST['submit'])){
    if(empty($_POST['pass'])){
        $error = true;
    } else {
        $password = $_POST['pass'];
    }

    $sql = "UPDATE member SET pass=? WHERE username=?";

    if ($stmt = mysqli_prepare($usrconn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_username);
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        if (mysqli_stmt_execute($stmt)) {
            header("location: index.php");
        } else {
            die("Oops! Something went wrong. Please try again later.");
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($usrconn);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/signup.css" rel="stylesheet" type="text/css">
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
</head>
<body>
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
                    <input type="submit" value="Change Password" name="submit" class="btn btn-primary" id="submitform" disabled="disabled">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>