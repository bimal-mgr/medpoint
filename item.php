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
    $row = mysqli_fetch_assoc($result); ?>
    <section class="w-full" >
        <div class='max-w-[1200px] h-fit mt-10 py-8 px-5 mx-auto'>
            <div class="grid grid-cols-2 gap-16 p-10 bg-white rounded-2xl shadow-md" >
                <div>
                    <div class="bg-[#f5f5f5] rounded-xl p-16 flex justify-center items-center mb-5 border-2 border-[#eee]" >
                        <img class='w-[300px] h-[300px]'src=<?php echo $row[
                            "image_path"
                        ]; ?> alt= <?php echo $row["name"]; ?> >
                    </div>
                    <div class="flex gap-4 flex-wrap mt-5">
                         <div class="text-[#2e7d32] bg-[#e8f5e9] text-sm rounded-lg font-medium px-4 py-2">
                             ✓ 100% Authentic
                         </div>
                         <div class="text-[#2e7d32] bg-[#e8f5e9] text-sm rounded-lg font-medium px-4 py-2">
                            ✓ Licensed Product
                        </div>
                        <div class="text-[#2e7d32] bg-[#e8f5e9] text-sm rounded-lg font-medium px-4 py-2">
                            ✓ Quality Assured
                        </div>
                     </div>
                </div>

                <div class='flex flex-col'>
                    <span class='inline-block bg-[#ff5252] text-white px-4 py-2 mb-3 rounded-3xl text-sm font-semibold w-fit'>
                       🔥 only <p class='inline-block' data-stock='
                           <?php echo $row["stock"]; ?>
                           ' id='stock'>
                               <?php echo $row["stock"]; ?></p> left in stock
                    </span>
                    <div class='text-[#00796b] text-sm font-semibold uppercase mb-2'>
                        <?php echo $row["category"]; ?>
                    </div>
                    <div class='text-4xl font-bold mb-3 text-[#333]'>
                        <?php echo $row["name"]; ?>
                    </div>
                    <div class="bg-[#f8f9fa] p-6 rounded-xl my-5" >
                        <p class="text-4xl font-bold text-[#00796b] mb-2" >Rs. <?php echo $row[
                            "price"
                        ]; ?> /-</p>
                        <p class="text-sm text-[#666]" >inclusive of all taxes</p>
                    </div>
                    <div class="mx-6 mb-2" >
                        <p class="text-sm font-semibold mb-2 text-[#666]">Quantity</p>
                        <div class="flex items-center gap-4 mb-2" >
                            <button id="remove" class="w-10 h-10 border-2 border-[#e0e0e0] bg-white rounded-lg text-xl hover:cursor-pointer transition-all hover:border-[#00bfa5] hover:bg-[e0f2f1] ">-</button>
                            <p id="quantity">1</p>
                            <button id="add" class="w-10 h-10 border-2 border-[#e0e0e0] bg-white rounded-lg text-xl hover:cursor-pointer transition-all hover:border-[#00bfa5] hover:bg-[e0f2f1] ">+</button>
                        </div>
                    </div>
                    <?php if (isset($_SESSION["username"])) { ?>
                        <div class="flex items-center gap-4 my-2" >
                            <button data-id='<?php echo $row[
                                "id"
                            ]; ?>' onclick='buyNow(event)' id='buyButton' class='text-white rounded-lg font-semibold hover:cursor-pointer p-3 hover:shadow-lg shadow-md w-full hover:-translate-y-1 transition-all  active:bg-orange-900 bg-orange-500'>
                                Buy now
                            </button>
                            <button data-id='<?php echo $row[
                                "id"
                            ]; ?>' onclick='addToCart(event)' id='cartButton' class='text-white rounded-lg font-semibold hover:cursor-pointer p-3 hover:shadow-lg shadow-md w-full active:bg-[#00897b] hover:-translate-y-1 transition-all bg-[#00bfa5]'>
                                Add to cart
                            </button>
                        </div>
                    <?php } else { ?>
                        <div class="flex items-center gap-4 my-2" >
                            <a class="w-full" href='login.php'>
                                <button class='text-white rounded-lg font-semibold hover:cursor-pointer p-3 hover:shadow-lg shadow-md w-full hover:-translate-y-1 transition-all  active:bg-orange-900 bg-orange-500'>
                                    Buy now
                                </button>
                            </a>
                            <a class="w-full" href='login.php'>
                                <button class='text-white rounded-lg font-semibold hover:cursor-pointer p-3 hover:shadow-lg shadow-md w-full active:bg-[#00897b] hover:-translate-y-1 transition-all bg-[#00bfa5]'>
                                    Add to cart
                                </button>
                            </a>
                        </div>
                    <?php } ?>
                    <hr class="border-1 my-3 border-1 border-[#eee]">
                    <div>
                        <p class="font-semibold mb-3 text-sm" >Share our product</p>
                        <button id="share" class="w-10 h-10 border-2 border-[#e0e0e0] bg-white rounded-lg text-xl hover:cursor-pointer transition-all hover:border-[#00bfa5] active:bg-[#e8f5e9] hover:-translate-y-1 hover:bg-[e0f2f1]" onclick="shareItem()" >
                            <img class="w-6 mx-auto h-6" src="public/share.svg" alt="share">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
} else {
     ?>
    <div>Item not found</div>
<?php
}
mysqli_close($conn);
?>
    <section class="w-full" >
        <div class="max-w-[1200px] mx-auto px-5" >
            <h2 class='font-extrabold text-[#333] mt-6 text-2xl'>
                Checkout More...
            </h2>
            <hr class="border-1 my-3 border-1 border-[#eee]">
            <?php include "items.php"; ?>
        </div>
    </section>
    <?php include "carticon.php"; ?>
    <script src="<?php echo BASE_URL; ?>/public/js/nav.js" ></script>
    <script src="<?php echo BASE_URL; ?>/public/js/item.js" ></script>
</body>
</html>
