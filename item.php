<?php include "header.php"; ?>
<body>
    <?php include "nav.php"; ?>
    <?php
    session_start();
    if (!isset($_GET["id"])) {
        echo "<script>window.location.href = 'index.php';</script>";
        exit();
    }
    $id = $_GET["id"];
    $conn = mysqli_connect("localhost", "root", "", "medpointdb");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM  tbproduct WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        echo "<div class='w-[50%] h-fit bg-white shadow-md rounded-md mt-10 p-6 mx-auto grid grid-cols-2'>";
        echo "<img src='" .
            $row["image_path"] .
            "' alt='" .
            $row["name"] .
            "' class='w-full h-full object-contain p-4'>";
        echo "<div class='flex flex-col gap-2 text-start justify-start items-start'>";
        echo "<strong class='text-xl font-bold'>" .
            $row["category"] .
            "</strong>";
        echo "<em class='pt-2 mt-6 w-full text-end border-t-2 border-main-gray'>only <p class='inline-block' data-stock='" .
            $row["stock"] .
            "' id='stock'>" .
            $row["stock"] .
            "</p> left</em>";
        echo "<strong>" . $row["name"] . "</strong>";
        echo "<em>Rs. " . $row["price"] . "/-</em>";
        ?>
        <button id="share" class="self-end border-2 border-transparent box-border bg-white shadow-md active:bg-slate-500 rounded-full p-2" onclick="shareItem()" >
        <img class="w-6 h-6" src="public/share.svg" alt="share">
        </button>
        <div class="flex gap-2 w-full justify-center items-center text-lg font-semibold" >
            <button id="remove" class="rounded-full bg-gray-200 aspect-square h-8" >-</button>
            <p id="quantity">1</p>
            <button id="add" class="rounded-full bg-gray-200 aspect-square h-8" >+</button>
        </div>
        <?php if (isset($_SESSION["username"])) {
            echo "<div>
                <button data-id='" .
                $row["id"] .
                "' id='cartButton' class='text-center m-4 p-1 text-white font-semibold hover:cursor-pointer active:bg-orange-900 bg-orange-500 rounded-full w-[8rem]'>
                Buy now
                </button>
                <button data-id='" .
                $row["id"] .
                "' onclick='addToCart(event)' id='buyButton' class='text-center m-4 p-1 text-white font-semibold hover:cursor-pointer active:bg-med-drklime bg-med-lime rounded-full w-[8rem]'>
                Add to cart
                </button>
                </div>";
        } else {
             ?>
            <div>
            <a href='login.php'>
            <button class='text-center m-4 p-1 text-white font-semibold hover:cursor-pointer active:bg-orange-900 bg-orange-500 rounded-full w-[8rem]'>
            Buy now
            </button>
            </a>
            <a href='login.php'>
            <button class='text-center m-4 p-1 text-white font-semibold hover:cursor-pointer active:bg-med-drklime bg-med-lime rounded-full w-[8rem]'>
            Add to cart
            </button>
            </a>
            </div>
        <?php
        } ?>
         </div></div>
<?php
    } else {
        echo "<h1>Item not found</h1>";
    }
    mysqli_close($conn);
    echo "<div class=p-6 ><strong  >Checkout more..</strong>";
    echo "<hr class='border-1 my-6 border-main-gray'>";
    include "items.php";
    include "cart.php";
    echo "</div>";
    ?>
    <script src="<?php echo BASE_URL; ?>/public/js/nav.js" ></script>
    <script src="<?php echo BASE_URL; ?>/public/js/item.js" ></script>
</body>
</html>
