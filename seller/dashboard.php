<?php
session_start();
if (!isset($_SESSION["username"])) {
    echo "<script>window.location.href = '/medpoint/login.php?type=seller';</script>";
    exit();
}
if (!isset($_SESSION["seller_id"])) {
    echo "<script>window.location.href = '/medpoint/index.php';</script>";
    exit();
}
?>

<?php include "../header.php"; ?>
<body>
  <?php include "../nav.php"; ?>

  <div class="w-full" >
  <div class="flex mt-6 mx-auto max-w-[1200px] flex-1  flex-col">
    <div class="p-4 space-y-4">
      <div class="flex items-center justify-between space-y-2">
        <h1 class="text-2xl font-bold tracking-tight">Products</h1>
        <button class="font-semibold p-2 bg-black text-white rounded-md" onclick="openModal()" >
          + Add Product</button>
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
      <div id="item" class="fixed inset-0 justify-center items-center bg-black/40 hidden z-50">
          <div id="item-content" class="max-w-[1200px] max-h-0 transition-all duration-700 ease-in-out overflow-hidden">
              <!-- AJAX content -->
          </div>
      </div>
      <script src="<?php echo BASE_URL; ?>/public/js/nav.js" ></script>
      <script src="<?php echo BASE_URL; ?>/public/js/seller.js" ></script>
</body>

</html>
