<?php
session_start();
$conn = new mysqli("localhost", "root", "", "medpoint");
if (isset($_SESSION["username"])) {
    if (isset($_GET["q"])) {
        $query = $_GET["q"];
        $user_id = $_SESSION["user_id"];
        // Process the query
        switch ($query) {
            case "all":
                // all item in cart status to delivered for user
                $sql = "INSERT INTO orders (buyer_id) VALUES ($user_id)";
                mysqli_query($conn, $sql);
                $order_id = mysqli_insert_id($conn); // This gets the LAST_INSERT_ID safely
                $sqlorder = "INSERT INTO order_items(order_id, product_id, seller_id,quantity)
                      SELECT $order_id, inventory.product_id,inventory.seller_id,cart.number from cart
                     INNER JOIN inventory ON inventory.inventory_id=cart.inventory_id where cart.user_id=$user_id AND cart.number <= inventory.stock";
                if (mysqli_query($conn, $sqlorder)) {
                    $sqlreduce = "
                    UPDATE inventory i
                    JOIN cart c ON i.inventory_id = c.inventory_id
                    SET i.stock = i.stock - c.number
                    WHERE c.user_id = $user_id
                    ";
                    mysqli_query($conn, $sqlreduce);
                    $sqlemptycart = "DELETE FROM cart WHERE user_id=$user_id";
                    mysqli_query($conn, $sqlemptycart);
                } else {
                    die("out of stock");
                }
                break;
            case "one":
                $inventory_id = $_GET["id"];
                $quantity = $_GET["quantity"];
                $user_id = $_SESSION["user_id"];

                $sqlcheck = "SELECT stock FROM inventory WHERE inventory_id = $inventory_id";
                $res = mysqli_query($conn, $sqlcheck);
                $row = mysqli_fetch_assoc($res);
                if ($row["stock"] < $quantity) {
                    die("Not enough stock!");
                }
                $sql = "INSERT INTO orders (buyer_id) VALUES ($user_id)";
                mysqli_query($conn, $sql);
                $order_id = mysqli_insert_id($conn);
                $sqlorder = "INSERT INTO order_items(order_id, product_id, seller_id,quantity)
                            SELECT $order_id, inventory.product_id,inventory.seller_id,$quantity from inventory
                            WHERE inventory.inventory_id = $inventory_id ";
                if (mysqli_query($conn, $sqlorder)) {
                    $sqlemptycart = "UPDATE inventory SET stock=stock-$quantity WHERE inventory_id=$inventory_id";
                    mysqli_query($conn, $sqlemptycart);
                    echo $row["stock"] - $quantity;
                }
                break;
        }
    }
} else {
    http_response_code(403);
    die("You are not logged in.");
}
?>
