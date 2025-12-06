<?php
$conn = new mysqli("localhost", "root", "", "medpoint");
session_start();
if (isset($_GET["number"])) {
    if (!isset($_SESSION["user_id"])) {
        echo 0;
        exit();
    }
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT COUNT(*) FROM cart WHERE user_id = '$user_id'";
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

    <div class="fixed bottom-10 z-30 right-10 hover:cursor hover:-translate-y-1 transition-all w-12 h-12">
        <a href="profile.php" class="">
            <div class="w-fit h-fit shadow-md hover:shadow-lg transition-colors relative bg-white p-2 rounded-full text-[#00bfa5] active:bg-[#00bfa5] active:text-white" >
            <svg class="w-8 h-8 my-auto fill-current " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
            </div>
        <strong id="cartNum" class="absolute -top-2 -right-2 bg-red-500 text-white hover:shadow-sm hover:bg-white hover:text-red-500 transition-colors text-sm w-6 h-6 flex items-center justify-center rounded-full">
        </strong>
        </a>
    </div>
