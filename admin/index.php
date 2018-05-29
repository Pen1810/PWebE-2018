<?php
require_once ('admin_config.php');
session_start();
if (empty($_SESSION) || !isset($_SESSION['username'])) {
    header("location: index.php");
}
if ($_SESSION['role'] != 1){
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
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
                    <a class="dropdown-item" href="/edituser.php">Edit profile</a>
                    <a class="dropdown-item" href="/signout.php">Sign Out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="col-sm-12 text-center" style="margin-top: 70px">
        <h2>Admin Control Panel</h2>
    </div>
</div>
</body>
</html>
