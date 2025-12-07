<?php
$conn = mysqli_connect("localhost", "root", "", "medpoint");
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php?type=user");
    exit();
}
if ($_GET["type"] == "profile") {
    $id = $_SESSION["user_id"];
    $fullname = $_POST["full_name"];
    $gender = $_POST["gender"];
    $phone_number = $_POST["phone_number"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $province = $_POST["province"];

    $sql = "UPDATE users SET  full_name = '$fullname', gender = '$gender', phone_number = '$phone_number', address = '$street', city = '$city', province = '$province' WHERE user_id = $id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["fullname"] = $fullname;
        header("Location: profile.php");
        exit();
    } else {
        http_response_code(500);
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    http_response_code(404);
    exit();
}

?>
