<?php
require_once ('admin_config.php');
session_start();
if (empty($_SESSION) || !isset($_SESSION['username'])) {
    header("location: /index.php");
}
if ($_SESSION['role'] != 1){
    header("location: /index.php");
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
    <script>
        function promptDelete(id){
            if (confirm("Anda yakin ingin menghapus seluruh data member dari id " + id +"?. Tindakan ini tidak dapat diurungkan.")){
                window.location.replace('/admin/delete.php?u=' + id);
            }
        }
    </script>
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
<div class="container">
    <div class="col-sm-12 text-center" style="margin-top: 70px">
        <h2>Admin Control Panel</h2>
    </div>
    <div class="col-sm-12">
        <h4>User List</h4>
        <table class="table table-striped table-hover">
            <thead class="text-center">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT id, username, role FROM member";
            if ($stmt = mysqli_prepare($usrconn, $sql)) {
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    mysqli_stmt_bind_result($stmt, $res_id, $res_username, $res_role);
                    while (mysqli_stmt_fetch($stmt)) {
                        if ($res_role == 1) $rolename = "administrator";
                        elseif ($res_role == 2) $rolename = "seller";
                        elseif ($res_role == 3) $rolename = "basic member";
                        echo "<tr>";
                        echo "<td>$res_id</td>";
                        echo "<td>$res_username</td>";
                        echo "<td>$rolename</td>";
                        ?>
                        <td class="text-center">
                            <a href="/admin/edit.php?u=<?php echo $res_id; ?>&m=role">Change Role</a> |
                            <a href="/admin/edit.php?u=<?php echo $res_id; ?>&m=passwd">Change Password</a> |
                            <a href="#" onclick="promptDelete(<?php echo $res_id; ?>)">Delete User</a>
                        </td>
                        <?php
                        echo "</tr>";
                    }
                } else {
                    die("Something went wrong. Please try again later.");
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
