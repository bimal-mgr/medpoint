<?php
$conn = mysqli_connect("localhost", "root", "", "medpoint");
session_start();
if (!isset($_SESSION["username"])) {
    echo "<script>window.location.href = '/medpoint/login.php?type=seller';</script>";
    exit();
}
if (!isset($_SESSION["seller_id"])) {
    echo "<script>window.location.href = '/medpoint/index.php';</script>";
    exit();
}
$sellerid = $_SESSION["seller_id"];
$sqlApproval = "SELECT approval FROM seller WHERE seller_id = $sellerid";
$resultApproval = mysqli_query($conn, $sqlApproval);
$rowApproval = mysqli_fetch_assoc($resultApproval);
$approval = $rowApproval["approval"];
?>

<?php include "../header.php"; ?>
<body>
  <?php include "../nav.php"; ?>

  <div class="w-full" >
  <div class="flex mt-6 mx-auto max-w-[1200px] bg-white rounded-2xl shadow-lg flex-1  flex-col">
    <div class="p-4 space-y-4">
      <div class="flex items-center justify-between space-y-2">
        <h1 class="text-2xl font-bold tracking-tight">sales</h1>
        <?php if ($approval == 1) { ?>
        <button class="font-semibold p-2 bg-[#00bfa5] text-white rounded-md" onclick="openModal()" >
          + Add Product</button>
        <?php } ?>
      </div>

      <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl border border-bdr-ash py-6">
          <div class="flex flex-col gap-1.5 px-6">
            <div class="text-sm">Total Sales</div>
            <div class="font-semibold font-display text-2xl lg:text-3xl">Rs. 0</div>
          </div>
        </div>
        <div class="rounded-xl border border-bdr-ash py-6">
          <div class="flex flex-col gap-1.5 px-6">
            <div class="text-sm">Number of Sales</div>
            <div class="font-semibold font-display text-2xl lg:text-3xl">Rs. 0</div>
          </div>
        </div>
        <div class="rounded-xl border border-bdr-ash py-6">
          <div class="flex flex-col gap-1.5 px-6">
            <div class="text-sm">Affiliate</div>
            <div class="font-semibold font-display text-2xl lg:text-3xl">0</div>
          </div>
        </div>
        <div class="rounded-xl border border-bdr-ash py-6">
          <div class="flex flex-col gap-1.5 px-6">
            <div class="text-sm">Discounts</div>
            <div class="font-semibold font-display text-2xl lg:text-3xl">0</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="flex mt-6 mx-auto max-w-[1200px] bg-white rounded-2xl shadow-lg flex-1  flex-col">
      <div class="p-4 space-y-4">
          <h1 class="text-2xl font-bold tracking-tight">Products</h1>

          <?php if ($approval == 1) {
              $sql = "SELECT * from inventory i INNER JOIN products p ON i.product_id = p.product_id WHERE seller_id = $sellerid";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="grid grid-cols-[100px_1fr_auto] gap-5 border-2 hover:-translate-y-1 duration-500 border-[#eee] p-6 rounded-xl transition-all hover:border-[#00bfa5] hover:shadow-lg">
                  <div onclick="openModal(<?php echo $row["seller_id"]; ?>)"
                      class="w-24 h-24 bg-[#f5f5f5] rounded-lg flex items-center justify-center p-5">
                      <img class="aspect-square h-14" src="<?php echo BASE_URL .
                          "/" .
                          $row["image_url"]; ?>"/>
                  </div>
                  <div class="flex-1 flex flex-col gap-2">
                      <div class="font-semibold text-xl color-[#333]">
                          Product Name:
                          <?php echo $row["name"]; ?>
                      </div>
                      <div class="text-sm font-semibold text-[#666]">
                          Description:
                          <?php echo $row["description"]; ?>
                      </div>
                      <div class="text-base font-semibold text-[#333]">
                          Stock:
                          <?php echo $row["stock"]; ?>
                      </div>
                  </div>
                  <div class="flex flex-col items-end gap-3">
                      <div class="text-3xl font-bold text-[#00796b]">Rs. <?php echo $row[
                          "unit_price"
                      ]; ?></div>
                      <button class="font-semibold p-2 bg-[#00bfa5] text-white rounded-md" onclick="openModal()" >
                          Edit Product </button>
                  </div>
              </div>
          <?php }
          } ?>
     </div>
  </div>
  <!--ajax part-->
      <div id="item" class="fixed inset-0 justify-center items-center bg-black/40 hidden z-50">
          <div id="item-content" class="max-w-[1200px] max-h-0 transition-all duration-700 ease-in-out overflow-y-auto no-scrollbar">
              <!-- AJAX content -->
          </div>
      </div>
      <script src="<?php echo BASE_URL; ?>/public/js/nav.js" ></script>
      <script src="<?php echo BASE_URL; ?>/public/js/seller.js" ></script>
</body>

</html>
