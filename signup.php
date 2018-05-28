<?php
require_once ("config.php");

$error = false;
$username = $password = "";
$username_err = "";

if (isset($_POST['submit'])){
    $sql = "SELECT username FROM member WHERE username=?";
    if ($stmt = mysqli_prepare($usrconn, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = trim($_POST["username"]);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                $username_err = "This username is already taken.";
                $error = true;
            }
            else {
                $username = trim($_POST["username"]);
            }
        }
    }

    if (!$error) {
        $sql = "INSERT INTO member (username, pass, nama, alamat, telp, email) VALUES (?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($usrconn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_pass, $param_nama, $param_alamat, $param_telp, $param_email);
            $param_username = $username;
            $param_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $param_nama = $_POST['name'];
            $param_alamat = $_POST['address'];
            $param_telp = $_POST['phone'];
            $param_email = $_POST['email'];
            if (mysqli_stmt_execute($stmt)) {
                header("location: signin.php?register=success");
            } else {
                die("Something went wrong. Please try again later.");
            }
        }

        mysqli_stmt_close($stmt);
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
    <link href="css/signup.css" rel="stylesheet" type="text/css">
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
            let name = document.forms["signup"]["name"].value.trim();
            let username = document.forms["signup"]["username"].value.trim();
            let email = document.forms["signup"]["email"].value.trim();
            let address = document.forms["signup"]["address"].value.trim();
            let phone = document.forms["signup"]["phone"].value.trim();
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
        <div class="col-sm-12 text-center main-title">
            <h2>Sign-up to Sample Shopping</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form name="signup" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                  onchange="validateInput()" method="post">
                <div>
                    <label for="nameInput"><strong>Nama Lengkap:</strong></label>
                    <input type="text" name="name" id="nameInput"
                           class="form-control" <?php if ($error) echo "value='" . $_POST['name'] . "'" ?>>
                </div>
                <div>
                    <label for="usernameInput"><strong>Username:</strong></label>
                    <input type="text" name="username" id="usernameInput"
                           class="form-control" <?php if ($error) echo "value='" . $_POST['username'] . "'" ?>>
                    <?php
                    if ($username_err != "") echo "<div class='alert alert-danger'>$username_err</div>";
                    ?>
                </div>
                <div>
                    <label for="emailInput"><strong>Alamat Email:</strong></label>
                    <input type="email" name="email" id="emailInput"
                           class="form-control" <?php if ($error) echo "value='" . $_POST['email'] . "'" ?>>
                </div>
                <div>
                    <label for="addressInput"><strong>Alamat Rumah:</strong></label>
                    <input type="text" name="address" id="addressInput"
                           class="form-control" <?php if ($error) echo "value='" . $_POST['address'] . "'" ?>>
                </div>
                <div>
                    <label for="phoneInput"><strong>Nomor Telepon:</strong></label>
                    <input type="text" name="phone" id="phoneInput"
                           class="form-control" <?php if ($error) echo "value='" . $_POST['phone'] . "'" ?>>
                </div>
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
                    <label>
                        <input type="checkbox" name="agreement" id="agreement" value="ok" onclick="setAgreed()">
                        <span style="font-size: 10pt;">Saya setuju dengan <a href="term_and_conditions.html">syarat dan ketentuan</a> pada e-commerce ini.</span>
                    </label>
                </div>
                <div>
                    <input type="submit" value="Sign Up" name="submit" class="btn btn-primary" id="submitform"
                           disabled="disabled">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
