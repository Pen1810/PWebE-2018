<?php
require_once ("config.php");

$username = $password = "";

if (isset($_POST['signup'])){
    $sql = "SELECT username FROM anggota WHERE username=?";
    if ($stmt = mysqli_prepare($usrconn, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = trim($_POST["username"]);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                $username_err = "This username is already taken.";
            }
            else {
                $username = trim($_POST["username"]);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- link href="css/signup.css" rel="stylesheet" type="text/css"-->
    <script>
        let strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
        let mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");
        let passOK = false;
        let rePassStat = false;
        let agreed = false;

        function setAgreed() {
            agreed = !agreed;
        }

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
            let name = document.forms["signup"]["name"].value;
            let username = document.forms["signup"]["address"].value;
            let email = document.forms["signup"]["email"].value;
            let address = document.forms["signup"]["address"].value;
            let phone = document.forms["signup"]["phone"].value;
            if (name !== "" && username !== "" && email !== "" && address !== "" && phone !== "" && rePassStat && agreed) {
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
        <div class="col-sm-12 text-center">
            <h2>Sign-up to forum</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <form name="signup" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onchange="validateInput()" method="post">
                <div>
                    <label for="nameInput">Nama Lengkap:</label>
                    <input type="text" name="name" id="nameInput" class="form-control">
                </div>
                <div>
                    <label for="usernameInput">Username:</label>
                    <input type="text" name="username" id="usernameInput" class="form-control">
                </div>
                <div>
                    <label for="emailInput">Alamat Email:</label>
                    <input type="email" name="email" id="emailInput" class="form-control">
                </div>
                <div>
                    <label for="addressInput">Alamat Rumah:</label>
                    <input type="text" name="address" id="addressInput" class="form-control">
                </div>
                <div>
                    <label for="phoneInput">Nomor Telepon:</label>
                    <input type="text" name="phone" id="phoneInput" class="form-control">
                </div>
                <div>
                    <label for="passInput">Password:</label>
                    <input type="password" name="pass" id="passInput" class="form-control" oninput="analyzePassword()">
                    <div id="passNotif"></div>
                    <p>Info: The password must be 8 characters or longer.</p>
                </div>
                <div>
                    <label for="rePassInput">Konfirmasi Password:</label>
                    <input type="password" name="repass" id="rePassInput" class="form-control"
                           onchange="checkPassword()" disabled="disabled">
                    <div id="rePassInfo"></div>
                </div>
                <div>
                    <label>
                        <input type="checkbox" name="agreement" id="agreement" value="ok" onclick="setAgreed()">
                        <span style="font-size: 9pt;">Saya setuju dengan <a href="term_and_conditions.html">syarat dan ketentuan</a> pada e-commerce ini.</span>
                    </label>
                </div>
                <div>
                    <input type="submit" value="Sign Up" name="submit" class="btnSubmit" id="submitform"
                           disabled="disabled">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
