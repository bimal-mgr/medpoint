<?php
session_start();
$conn = new mysqli("localhost", "root", "", "medpoint");

if (isset($_SESSION["username"])) {
    $user_id = $_SESSION["user_id"];
    //1. add to cart
    if (isset($_GET["id"]) && isset($_GET["quantity"])) {
        $inventoryid = $_GET["id"];
        $quantity = $_GET["quantity"];
        //check stock
        $sqlgetstock = "SELECT stock FROM inventory WHERE inventory_id = $inventoryid";
        $result = mysqli_query($conn, $sqlgetstock);
        $row = mysqli_fetch_assoc($result);
        if ($quantity > $row["stock"]) {
            http_response_code(400);
            die("Insufficient stock");
        }
        // Check if the user already has this product in the cart
        $sqlCheck = "SELECT * FROM cart WHERE user_id = $user_id AND inventory_id = $inventoryid";
        $resultCheck = mysqli_query($conn, $sqlCheck);

        if (mysqli_num_rows($resultCheck) > 0) {
            // Product exists in cart → update cart and stock
            $sqlupdatecart = "UPDATE cart SET number = number + $quantity WHERE user_id='$user_id' AND inventory_id = $inventoryid";
            mysqli_query($conn, $sqlupdatecart);
            exit();
        } else {
            // Product not in cart → insert into cart
            $sqlinsert = "INSERT INTO cart (user_id, inventory_id, number)
                          VALUES ('$user_id', $inventoryid, $quantity)";
            mysqli_query($conn, $sqlinsert);
            exit();
        }
    }
    // 2. Remove from cart
    if (isset($_GET["cartid"])) {
        $cartid = $_GET["cartid"];
        $sqlremove = "DELETE FROM cart WHERE cart_id=$cartid";
        if (mysqli_query($conn, $sqlremove)) {
            echo "Product removed from cart.";
        } else {
            http_response_code(500);
            echo "Failed to remove product from cart.";
        }
        exit();
    }
    exit();
} else {
    http_response_code(403);
    die("You are not logged in.");
}
