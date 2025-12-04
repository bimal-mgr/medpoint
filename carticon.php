<?php
$conn = new mysqli("localhost", "root", "", "medpointdb");
session_start();
if (isset($_GET["number"])) {
    if (!isset($_SESSION["username"])) {
        echo 0;
        exit();
    }
    $username = $_SESSION["username"];
    $sql = "SELECT COUNT(*) FROM tbcart WHERE username = '$username' AND isdelivered = 0";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row["COUNT(*)"];
        exit();
    } else {
        echo 0;
        exit();
    }
}
?>

    <div class="fixed bottom-10 z-30 right-10 w-12 h-12">
        <a href="profile.php" class="relative hover:cursor-pointer">
        <img class="w-full h-full rounded-full bg-white shadow-md p-2" src="./public/cart.svg" alt="">

        <strong id="cartNum" class="absolute -top-2 -right-2 bg-red-500 text-white text-sm w-6 h-6 flex items-center justify-center rounded-full">
        </strong>
        </a>
    </div>
