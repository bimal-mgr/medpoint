<?php
$conn = mysqli_connect("localhost", "root", "", "medpoint");
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php?type=user");
    exit();
}
$id = $_SESSION["user_id"];
if ($_GET["type"] == "profile") {
    $fullname = $_POST["full_name"];
    $gender = $_POST["gender"];
    $phone_number = $_POST["phone_number"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $province = $_POST["province"];

    $sql = "UPDATE users SET  full_name = '$fullname', gender = '$gender', phone_number = '$phone_number', address = '$street', city = '$city', province = '$province' WHERE user_id = $id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["fullname"] = $fullname;
        header("Location: profile.php?query=profile");
        exit();
    } else {
        http_response_code(500);
        echo "Error updating record: " . mysqli_error($conn);
    }
} elseif (
    $_GET["type"] == "seller" &&
    isset($_POST["shopname"]) &&
    isset($_POST["regid"])
) {
    $shopname = $_POST["shopname"];
    $regid = $_POST["regid"];
    if (isset($_FILES["docs"]) && $_FILES["docs"]["error"] == UPLOAD_ERR_OK) {
        $target_dir = "documents/";
        $uploadOk = 1;
        $imageFileType = strtolower(
            pathinfo($_FILES["docs"]["name"], PATHINFO_EXTENSION),
        );
        // Check if image file is a actual image or fake image
        if ($imageFileType != "jpg" && $imageFileType != "png") {
            echo "<script>alert('Sorry, only JPG and PNG files are allowed.');</script>";
            $uploadOk = 0;
        }

        $safeName = preg_replace("/[^A-Za-z0-9_-]/", "", $shopname);
        $filename = $safeName . "_regDoc." . $imageFileType;
        $target_file = $target_dir . $filename;

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["docs"]["tmp_name"], $target_file)) {
                $sqlseller = "INSERT INTO seller (reg_id, shop_name, document_path, user_id) VALUES ('$regid', '$shopname', '$target_file', '$id')";
                if (mysqli_query($conn, $sqlseller)) {
                    $_SESSION["level"] = 2;
                    header("Location: seller/dashboard.php");
                    exit();
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                http_response_code(500);
            }
        }
    } else {
        echo "No file uploaded";
    }
} else {
    http_response_code(404);
    exit();
}

?>
