<?php
require_once ("admin_config.php");
if (isset($_GET['u'])){
    $id = $_GET['u'];
    $sql = "DELETE FROM member WHERE id=?";
    if ($id == 1) {
        die("Cannot delete main administrator account");
    }
    if ($stmt = mysqli_prepare($usrconn, $sql)) {
        mysqli_stmt_bind_param($stmt, "d", $param_id);
        $param_id = $id;

        if (mysqli_stmt_execute($stmt)) {
            header("location: index.php");
        } else {
            die("Oops! Something went wrong. Please try again later.");
        }
    }
    mysqli_stmt_close($stmt);
}