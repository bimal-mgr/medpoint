<?php
session_start();
if (!isset($_SESSION["username"])) {
    echo "<script>window.location.href = '/medpoint/login.php?type=admin';</script>";
    exit();
}
if ($_SESSION["level"] != 1) {
    echo "<script>window.location.href = '/medpoint/index.php';</script>";
    exit();
}
?>

<?php include "../header.php"; ?>
<body>
  <?php include "../nav.php"; ?>

  <div class="flex flex-1 flex-col">

    <div class="p-4 space-y-4">
        <h1 class="text-2xl font-bold tracking-tight">Products</h1>

      <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl border border-bdr-ash py-6">
          <div class="flex flex-col gap-1.5 px-6">
            <div class="text-sm">Total Sales</div>
            <div class="font-semibold font-display text-2xl lg:text-3xl">$0</div>
          </div>
        </div>
        <div class="rounded-xl border border-bdr-ash py-6">
          <div class="flex flex-col gap-1.5 px-6">
            <div class="text-sm">Number of Sales</div>
            <div class="font-semibold font-display text-2xl lg:text-3xl">$0</div>
          </div>
        </div>
        <div class="rounded-xl border border-bdr-ash py-6">
          <div class="flex flex-col gap-1.5 px-6">
            <div class="text-sm">Affiliate</div>
            <div class="font-semibold font-display text-2xl lg:text-3xl">$0</div>
          </div>
        </div>
        <div class="rounded-xl border border-bdr-ash py-6">
          <div class="flex flex-col gap-1.5 px-6">
            <div class="text-sm">Discounts</div>
            <div class="font-semibold font-display text-2xl lg:text-3xl">$0</div>
          </div>
        </div>
      </div>
      <script src="<?php echo BASE_URL; ?>/public/js/nav.js" ></script>
</body>

</html>
