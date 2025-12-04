<?php

$conn = new mysqli("localhost", "root", "", "medpointdb");
if ($conn->connect_error) {
    die("Connection failed: ");
}
if (isset($_GET["query"])) {
    $searchQuery = $_GET["query"];
    $sql = "SELECT * FROM tbproduct WHERE name LIKE '%$searchQuery%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) { ?>
    <h3 class='font-extrabold text-[#333] text-3xl col-span-full'>
        Search Results...
    </h3>
    <div class="grid gap-6 mt-7 mx-auto w-full grid-cols-1 md:grid-cols-4 sm:grid-cols-3 ">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <a href="item.php?id=<?php echo $row["id"]; ?>">
            <div class='flex bg-white rounded-xl transition-all hover:-translate-y-1 flex-col items-start shadow-[0_2px_8px_rgba(0,0,0,0.08)] hover:shadow-[0_8px_24px_rgba(0,0,0,0.15)]'>
                <div class='h-[200px] w-full bg-[#f5f5f5] flex justify-center items-center'>
                    <img class="h-28 w-28" src="<?php echo $row[
                        "image_path"
                    ]; ?>" alt='item'>
                </div>
                <div class='p-4 overflow-hidden flex w-full flex-col gap-2'>
                    <p class="text-[#333] overflow-hidden font-semibold">
                        <?php echo $row["name"]; ?>
                    </p>
                    <p class="text-[#00796b] text-2xl font-extrabold">
                        Rs. <?php echo $row["price"]; ?>
                    </p>
                </div>
            </div>
        </a>
            <?php } ?>
    </div>
        <?php } else { ?>
            <h3 class='font-extrabold text-[#333] text-3xl col-span-full'>
                No Results...
            </h3>
            <?php }
} ?>
