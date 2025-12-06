<?php
session_start();
$conn = new mysqli("localhost", "root", "", "medpoint");
if ($conn->connect_error) {
    die("Connection failed: ");
}
if (isset($_GET["q"])) {
    $qry = $_GET["q"];
    if (!isset($_SESSION["username"])) { ?>
        <div class='w-full h-full flex justify-center items-center'>";
        <strong class='w-full text-center text-5xl items-center' >log in first</strong>";
        </div>";
        <?php exit();}
    $user_id = $_SESSION["user_id"];
    $querycart = "SELECT name,image_url,unit_price,number,cart_id FROM cart JOIN inventory ON inventory.inventory_id = cart.inventory_id JOIN products ON products.product_id = inventory.product_id WHERE user_id = '$user_id'";
    $querydelivered = "SELECT o.order_id, o.order_date, p.name AS product_name, i.image_url, oi.quantity, i.unit_price, (oi.quantity * i.unit_price) AS total_price, i.seller_id FROM orders o JOIN order_items oi ON o.order_id = oi.order_id JOIN inventory i ON oi.product_id = i.product_id AND oi.seller_id = i.seller_id JOIN products p ON i.product_id = p.product_id WHERE o.buyer_id = '$user_id' ORDER BY o.order_date DESC, o.order_id DESC";
    $resultcart = mysqli_query($conn, $querycart);
    $resultdelivered = mysqli_query($conn, $querydelivered);
    switch ($qry) { case "profile": ?>
            <section class='flex flex-col w-full h-full gap-2 flex-cols' >
            <div class='w-full flex gap-4' >
            <div class='p-4 w-full shadow-md rounded-md bg-white' ><strong>User Name:</strong><br/><em><?php echo $_SESSION[
                "username"
            ]; ?>
                </em></div>
            <div class='p-4 w-full shadow-md rounded-md bg-white'><strong>Full Name:</strong><br/><em>
              <?php echo $_SESSION["fullname"]; ?>
                </em></div>
            </div>
            <table class='bg-white table-auto shadow-md rounded-md w-full'>
            <?php
            if (mysqli_num_rows($resultcart) > 0) { ?>
                <thead>
                <tr class='border-b text-center' >
                <th class='p-2' >Name</th>
                <th class='p-2' >Image</th>
                <th class='p-2' >Price</th>
                <th class='p-2' >Quantity</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($resultcart)) {
                        echo "<tr class='text-center' >";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td><img class='h-20 mx-auto p-2 aspect-auto' src=" .
                            $row["image_url"] .
                            " /></td>";
                        echo "<td>" . $row["unit_price"] . "</td>";
                        echo "<td>" . $row["number"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "</section>";
                    }
            break;
            case "address": ?>
            <div class='w-full h-full flex justify-center items-center'>
            Address Edit Section
            </div>
            <?php break;case "orders":
            if (mysqli_num_rows($resultcart) > 0) { ?>
                <div class='bg-white table-auto p-4 shadow-md rounded-md w-full'>
                <table class="w-full" >
                <thead>
                <tr class='border-b text-center'>
                <th class='p-2' >Name</th>
                <th class='p-2' >Image</th>
                <th class='p-2' >Price</th>
                <th class='p-2' >Quantity</th>
                <th class='p-2' ></th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultcart)) {

                    echo "<tr class='text-center' >";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td><img class='h-20 mx-auto p-2 aspect-auto' src=" .
                        $row["image_url"] .
                        " /></td>";
                    echo "<td>" . $row["unit_price"] . "</td>";
                    echo "<td>" . $row["number"] . "</td>";
                    ?>
                   <td><button onclick="removeFromCart(event,<?php echo $row[
                       "cart_id"
                   ]; ?>)" class="p-2 rounded-md active:bg-gray-300 active:text-white" >
                       <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 24 24">
                       <path d="M 10 2 L 9 3 L 3 3 L 3 5 L 4.109375 5 L 5.8925781 20.255859 L 5.8925781 20.263672 C 6.023602 21.250335 6.8803207 22 7.875 22 L 16.123047 22 C 17.117726 22 17.974445 21.250322 18.105469 20.263672 L 18.107422 20.255859 L 19.890625 5 L 21 5 L 21 3 L 15 3 L 14 2 L 10 2 z M 6.125 5 L 17.875 5 L 16.123047 20 L 7.875 20 L 6.125 5 z"></path>
                       </svg>
                   </button></td>
                    <?php echo "</tr>";
                } ?>
                </tbody>
                </table>
                <div class="p-4 w-full">
                    <button onclick="deliverComponent()" class="w-full p-2 text-lg font-semibold text-white bg-orange-500 active:bg-orange-900 rounded-md" >Buy Now</button>
                </div>
                </div>
                <?php } else { ?>
                    <div class='bg-white flex items-center justify-center p-4 shadow-md rounded-md min-h-[40vh] w-full'>
                    <strong class='my-auto text-center text-xl items-center' >Nothing in cart</strong>
                    </div></div>
                    <?php }
            break;

        case "delivered":
            if (mysqli_num_rows($resultdelivered) > 0) {

                $data = [];
                while ($row = mysqli_fetch_assoc($resultdelivered)) {
                    $order_id = $row["order_id"];
                    $data["$order_id"][] = $row;
                }
                ?>
                           <div class='bg-white table-auto p-4 shadow-md rounded-md w-full'>
                           <table class="w-full" >
                           <thead>
                           <tr class='border-b text-center'>
                           <th class='p-2' >order id</th>
                           <th class='p-2' >Name</th>
                           <th class='p-2' >Image</th>
                           <th class='p-2' >Price</th>
                           <th class='p-2' >Quantity</th>
                           </tr>
                           </thead>
                           <tbody>
                               <?php foreach ($data as $order_id => $orders) {
                                   $itemCount = count($orders); // number of items in this order
                                   foreach ($orders as $index => $order) { ?>
                                       <tr class="text-center" >
                                           <?php if ($index == 0) { ?>
                                               <td class="p-2" rowspan="<?php echo $itemCount; ?>">
                                                   <?php echo $order_id; ?>
                                               </td>
                                           <?php } ?>
                                           <td class="p-2"><?php echo $order[
                                               "product_name"
                                           ]; ?></td>
                                           <td class="p-2">
                                               <img src="<?php echo $order[
                                                   "image_url"
                                               ]; ?>" class="w-16 h-16 mx-auto object-cover" />
                                           </td>
                                           <td class="p-2"><?php echo $order[
                                               "unit_price"
                                           ]; ?></td>
                                           <td class="p-2"><?php echo $order[
                                               "quantity"
                                           ]; ?></td>
                                       </tr>
                               <?php }
                               } ?>
                           </tbody>
                           </table>
                               <?php
            } else {
                 ?>
                               <div class='bg-white flex items-center justify-center p-4 shadow-md rounded-md min-h-[40vh] w-full'>
                               <strong class='my-auto text-center text-xl items-center' >No delivered orders</strong>
                               </div></div>
                               <?php
            }
            break;
        default:
            echo "Invalid Request";
            break;
    }
    exit();
}
?>


<!-- html code -->
<?php include "header.php"; ?>

<body>
    <!--nav bar-->
    <nav class="z-[40] bg-ash shadow-md sticky top-0">
      <div class="flex max-w-[1200px] mx-auto w-full inherit flex-wrap items-center justify-between p-3">
        <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="./public/med-logo.png" class="h-8" alt="Logo" />
          <h1 class="self-center whitespace-nowrap font-bold text-2xl text-[#00bfa5] ">med<bold class="text-[#00796b]" >point</bold></h1>
        </a>

        <div class="relative flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <?php
            session_start();
            if (isset($_SESSION["username"])) {
                echo "<span class='mr-4'>HOWDEY, " .
                    $_SESSION["username"] .
                    "</span>";
            }
            ?>
          <button type="button" class="text-white bg-[#00bfa5] rounded-full p-1 hover:bg-white hover:text-[#00bfa5]" id="user-menu-button" aria-expanded="false">
              <svg class="h-8 w-8 stroke-current stroke-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
          </button>
          <!-- Dropdown menu -->
          <div class="z-50 hidden min-w-32 text-start absolute top-5 right-0  my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
            <div class="px-4 py-3">
              <span class="block text-sm text-gray-900 dark:text-white">
                <?php
                session_start();
                if (isset($_SESSION["username"])) {
                    echo $_SESSION["username"];
                } else {
                    echo "Guest";
                }
                ?>
              </span>
              <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">
                <?php if (isset($_SESSION["fullname"])) {
                    echo $_SESSION["fullname"];
                } else {
                    echo "Welcome to MedPoint";
                } ?>
              </span>
            </div>
            <ul class="py-2" aria-labelledby="user-menu-button">
                <?php if (isset($_SESSION["username"])) {
                    echo "<li>
                    <a href='profile.php' class='block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white'>cart</a>
              </li>";
                    echo "<li>
                    <a href='/medpoint/logout.php' class='block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white'>
                      sign out
                  </a>";
                } else {
                    echo "<a href='/medpoint/login.php?type=user' class='block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white'>
                    sign in
                </a>";
                } ?>
              </li>
            </ul>
          </div>

        </div>
      </div>
    </nav>


    <main>
        <section class="w-full h-full px-2 mt-6" >
            <div class="max-w-[1200px] mx-auto flex gap-8" >
                <div class="bg-white rounded-2xl h-fit sticky shadow-md w-[280px] top-[90px]">
                    <div class="flex flex-col px-8 py-6 justify-center items-center border-b border-[#eee] gap-2">
                        <div class=" bg-[radial-gradient(circle_at_top_left,_#20e3b2,_#0d9488)]
                            rounded-full h-20 w-20 flex justify-center mb-2 items-center">
                            <svg class="stroke-white stroke-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        <div class="text-nowrap text-lg text-[#333] font-semibold">
                          <?php if (isset($_SESSION["fullname"])) {
                              echo $_SESSION["fullname"];
                          } else {
                              echo "Guest Kumar";
                          } ?>
                        </div>
                        <div class="text-nowrap text-[#333] font-light">
                          <?php if (isset($_SESSION["username"])) {
                              echo $_SESSION["username"];
                          } else {
                              echo "Guest";
                          } ?>
                        </div>
                    </div>
                    <div class="py-5" >
                        <div class="text-nowrap text-[#999] px-3 font-light">
                            Account
                        </div>
                        <div>
                            <ul class="text-[#555]" >
                                <li class="hover:bg-[#f5f5f5] border-l-2 border-transparent hover:border-[#00bfa5] transition-all hover:text-[#00796b]" ><button class="px-6 py-[12px]" id="profile"><span>👤</span> Edit Profile</button></li>
                                <li class="hover:bg-[#f5f5f5] border-l-2 border-transparent hover:border-[#00bfa5] transition-all hover:text-[#00796b]" ><button class="px-6 py-[12px]" id="address"><span>📍</span> Edit Address</button></li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <div class="text-nowrap text-[#999] px-3 font-light">
                                               Orders
                        </div>
                        <div>
                            <ul class="text-[#555]" >
                                <li class="hover:bg-[#f5f5f5] border-l-2 border-transparent hover:border-[#00bfa5] transition-all hover:text-[#00796b]" ><button class="px-6 py-[12px]" id="orders"><span>🛒</span> Orders</button></li>
                                <li class="hover:bg-[#f5f5f5] border-l-2 border-transparent hover:border-[#00bfa5] transition-all hover:text-[#00796b]" ><button class="px-6 py-[12px]" id="delivered"><span>📦</span> Shipped</button></li>
                            </ul>
                        </div>
                    </div>
                    <div class="py-5" >
                        <div>
                            <ul class="text-[#555]" >
                                <li class="hover:bg-[#f5f5f5] border-l-2 border-transparent hover:border-[#00bfa5] transition-all hover:text-[#00796b] py-3 " ><a class="px-6" href="logout.php"><span>🚪</span> log out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="profileContent" class="w-full h-[80vh]"></div>
            </div>
        </section>
    </main>
    <script src="public/js/profile.js"></script>
    <script src="public/js/nav.js"></script>
</body>
