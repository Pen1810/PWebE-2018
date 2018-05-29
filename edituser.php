<?php
require_once ('config.php');
session_start();
$error_msg = "";
$target_dir = "img/profile/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 0;
$name = $phone = $email = $address = $profpic = "";
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (isset($_POST["submit"])) {
    if (empty($_FILES['fileToUpload'])) {
        $uploadOk = 1;
        $imgpath = $_SESSION['profpic'];
    }
    else {
        $check = exif_imagetype($_FILES["fileToUpload"]["tmp_name"]);
        if ($check) {
            $uploadOk = 1;
        } else {
            $error_msg = "File yang Anda upload bukan gambar yang valid.";
            $uploadOk = 0;
        }
        if (file_exists($target_file)) {
            $target_file = $_SESSION['username'] . '_' . time() . '.' . $imageFileType;
        }
        if ($_FILES["fileToUpload"]["size"] > 500 * 1024) {
            $error_msg = "Gambar yang Anda upload terlalu besar. Max 500 KB.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $error_msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk != 0) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $imgpath = $target_file;
            } else {
                $error_msg = "Sorry, there was an error uploading your file.";
            }
        }
    }
    if ($uploadOk == 1) {
        $sql = "UPDATE member SET nama=?, alamat=?, telp=?, email=?, profpic=? WHERE username=?";
        if ($stmt = mysqli_prepare($usrconn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssss", $param_nama, $param_alamat, $param_telp, $param_email, $param_profpic, $param_username);
            $param_nama = $_POST['name'];
            $param_alamat = $_POST['address'];
            $param_telp = $_POST['phone'];
            $param_email = $_POST['email'];
            $param_profpic = $imgpath;
            $param_username = $_SESSION['username'];
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['profpic'] = $imgpath;
                header("location: index.php");
            } else {
                die("Something went wrong. Please try again later.");
            }
        }
        mysqli_stmt_close($stmt);
    }
}
$sql = "SELECT nama, telp, alamat, email, profpic FROM member WHERE username = ?";
if ($stmt = mysqli_prepare($usrconn, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $_SESSION['username'];
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $res_name, $res_phone, $res_address, $res_email, $res_profpic);
        mysqli_stmt_fetch($stmt);
        $name = $res_name;
        $address = $res_address;
        $phone = $res_phone;
        $email = $res_email;
        $profpic = $res_profpic;
    } else {
        die("Something went wrong. Please try again later.");
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/signup.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center main-title">
            <h2>Edit Profile</h2>
        </div>
    </div>
    <?php
    if ($uploadOk == 0 && !empty($error_msg)) {
        echo "<div>";
        echo "<div class='alert alert-danger col-sm-12'>$error_msg</div>";
        echo "</div>";
    }
    ?>
    <div class="row">
        <div class="col-sm-12">
            <form name="signup" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                  method="post" enctype="multipart/form-data">
                <div>
                    <label for="nameInput"><strong>Nama Lengkap:</strong></label>
                    <input type="text" name="name" id="nameInput"
                           class="form-control" <?php if ($uploadOk == 0) echo "value='" . $name . "'" ?>>
                </div>
                <div>
                    <label for="emailInput"><strong>Alamat Email:</strong></label>
                    <input type="email" name="email" id="emailInput"
                           class="form-control" <?php if ($uploadOk == 0) echo "value='" . $email . "'" ?>>
                </div>
                <div>
                    <label for="addressInput"><strong>Alamat Rumah:</strong></label>
                    <input type="text" name="address" id="addressInput"
                           class="form-control" <?php if ($uploadOk == 0) echo "value='" . $address . "'" ?>>
                </div>
                <div>
                    <label for="phoneInput"><strong>Nomor Telepon:</strong></label>
                    <input type="text" name="phone" id="phoneInput"
                           class="form-control" <?php if ($uploadOk == 0) echo "value='" . $phone . "'" ?>>
                </div>
                <div>
                    <label for="profilePicture"><strong>Current Profile Image: </strong></label>
                    <img src="<?php echo $profpic; ?>" alt="profpic" style="max-height: 200px; width: auto; margin: 10px;" id="profilePicture">
                </div>
                <div>
                    <label for="fileToUpload"><strong>Profile Picture:</strong></label>
                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                    <p>Maksimal 500 KB</p>
                </div>
                <div>
                    <input type="submit" value="Update" name="submit" class="btn btn-primary" id="submitform">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>