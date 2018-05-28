<?php
require_once ("config.php");


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
                    <input type="submit" value="Sign Up" name="submit" class="btn btn-primary" id="submitform">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>