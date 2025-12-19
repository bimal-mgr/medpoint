<?php   
$conn = mysqli_connect("localhost", "root", "", "medpoint");
session_start();
if (!isset($_SESSION["username"])) {
    echo "<script>window.location.href = '/medpoint/login.php?type=admin';</script>";
    exit();
}
if ($_SESSION["level"] != 1) {
    echo "<script>window.location.href = '/medpoint/index.php';</script>";
    exit();
}
$sql = "SELECT * FROM `seller` WHERE approval=0;";
$result = mysqli_query($conn, $sql);
?>

<?php include "../header.php"; ?>
<body>
  <?php include "../nav.php"; ?>
<div class="w-full p-6" >

  <div class=" max-w-[1200px] mx-auto shadow-lg bg-white rounded-2xl p-4">
    <h1 class="text-3xl font-bold mb-4 text-[#333]">Admin Dashboard </h1>

<div class="flex flex-col gap-5" >
<?php if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="grid grid-cols-[100px_1fr_auto] gap-5 border-2 hover:-translate-y-1 duration-500 border-[#eee] p-6 rounded-xl transition-all hover:border-[#00bfa5] hover:shadow-lg">
        <div onclick="openModal(<?php echo $row["seller_id"]; ?>)"
            class="w-24 h-24 bg-[#f5f5f5] rounded-lg flex items-center justify-center p-5">
            <img class="aspect-square h-14" src="<?php echo BASE_URL .
                "/" .
                $row["document_path"]; ?>"/>
        </div>
        <div class="flex-1">
            <div class="font-semibold text-xl color-[#333] mb-2">
                Shop Name:
                <?php echo $row["shop_name"]; ?>
            </div>
            <div class="text-sm font-semibold text-[#666]">
                Registration Number:
                <?php echo $row["reg_id"]; ?>
            </div>
        </div>
        <div class="flex  items-end gap-3">
            <button class="px-6 py-2 text-white cursor-pointer rounded-md text-sm transition-all bg-[#00bfa5] active:bg-[#00897b] hover:text-white hover:font-semibold hover:-translate-y-1" onclick='accept(<?php echo $row[
                "seller_id"
            ]; ?>)' >✅ Approve</button>
            <button class="px-6 py-2 text-white cursor-pointer rounded-md text-sm transition-all bg-orange-500 active:bg-orange-900 hover:font-semibold hover:-translate-y-1" onclick='reject(<?php echo $row[
                "seller_id"
            ]; ?>)'>❎ Deny</button>
        </div>
    </div>
<?php }
} else {
     ?>
     <strong>Nothing to update</strong>
    <?php
} ?>
  </div>
   </div>
</div>
<div id="item" class="fixed inset-0 justify-center items-center bg-black/40 hidden z-50">
    <div id="item-content" class="max-w-[1200px] max-h-0 no-scrollbar transition-all duration-700 ease-in-out overflow-y-auto">
        <!-- AJAX content -->
    </div>
</div>
    <script src="<?php echo BASE_URL; ?>/public/js/admin.js" ></script>
    <script src="<?php echo BASE_URL; ?>/public/js/nav.js" ></script>
</body>

</html>
