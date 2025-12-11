        <?php
        $conn = mysqli_connect("localhost", "root", "", "medpoint");
        session_start();
        include "header.php";
        if (!isset($_SESSION["seller_id"])) {
            header("location: login.php");
            exit();
        }
        $seller_id = $_SESSION["seller_id"];
        if (isset($_GET["query"]) && $_GET["query"] === "add") {
            $price = $_POST["unit_price"];
            $description = $_POST["description"];
            $stock = $_POST["stock"];
            if (
                isset($_POST["medicineName"]) &&
                isset($_POST["medicineCategory"])
            ) {
                $category = $_POST["medicineCategory"];
                $productName = $_POST["medicineName"];
                $sqladdCategory = "INSERT INTO categories (category) VALUES ('$category')";
                if (mysqli_query($conn, $sqladdCategory)) {
                    if (mysqli_query($conn, $sqladdStock)) {
                        header("location: dashboard.php");
                    }
                }
                $categoryid = mysqli_insert_id($conn);
                $sqladdProduct = "INSERT INTO products (name, category_id) VALUES ('$productName', $categoryid)";
                if (mysqli_query($conn, $sqladdProduct)) {
                    $productid = mysqli_insert_id($conn);
                    $sqladdStock = "INSERT INTO inventory (stock, product_id,description,seller_id,unit_price) VALUES ($stock, $productid, '$description', $seller_id, $price)";
                    if (mysqli_query($conn, $sqladdStock)) {
                        header("location: dashboard.php");
                    }
                }
                exit();
            } elseif (isset($_POST["medicineName"])) {
                $categoryid = $_POST["productCategory"];
                $productName = $_POST["medicineName"];
                $sqladdProduct = "INSERT INTO products (name, category_id) VALUES ('$productName', $categoryid)";
                if (mysqli_query($conn, $sqladdProduct)) {
                    $productid = mysqli_insert_id($conn);
                    $sqladdStock = "INSERT INTO inventory (stock, product_id,description,seller_id,unit_price) VALUES ($stock, $productid, '$description', $seller_id, $price)";
                    if (mysqli_query($conn, $sqladdStock)) {
                        header("location: dashboard.php");
                    }
                }
                exit();
            } else {
                $productid = $_POST["productName"];
                $sqladdStock = "INSERT INTO inventory (stock, product_id,description,seller_id,unit_price) VALUES ($stock, $productid, '$description', $seller_id, $price)";
                if (mysqli_query($conn, $sqladdStock)) {
                    header("location: dashboard.php");
                }
                exit();
            }
            exit();
        }
        $productResult = mysqli_query(
            $conn,
            "SELECT name, product_id FROM products",
        );
        $categoryResult = mysqli_query($conn, "SELECT * FROM categories");
        ?>
        <div class='bg-white shadow-md rounded-2xl w-full'>
            <form action="product.php?query=add" method="post" enctype="multipart/form-data">
            <div class="p-7 border-b border-[#eee] flex justify-between items-center">
                <h1 class="text-2xl font-bold text-[#333]">Add a product</h1>
                <div>
                    <button type="button" class="px-5 py-2 rounded-lg text-sm font-semibold cursor-pointer transition-all bg-[#f5f5f5] hover:bg-[#e0e0e0] text-[#555]" onclick="closeModal()">cancel</button>
                    <button name="submit" id="submit" type="submit" class="px-5 py-2 rounded-lg text-sm font-semibold cursor-pointer transition-all bg-[#00bfa5] hover:bg-[#00807b] text-white hover:-translate-y-1 hover:shadow-[0_4px_12px_rgba(0,191,165,0.3)] ">💾 Save Changes</button>
                </div>
            </div>
            <div class="p-8">
            <div class="max-w-[800px]">
                <div class="mb-10">
                    <h3 class="text-lg font-semibold text-[#333] mb-5 pb-2 border-b-2 border-[#f0f0f0]">Medicine Information</h3>
                    <div class="flex mb-2 gap-5">
                        <div class="flex w-full flex-col">
                            <label for="productName" class="font-base font-semibold mb-2 text-[#555]">Medicine name</label>
                                <select name="productName" onchange="selectProduct(event)" id="productName" class="outline-none focus:border-[#00bfa5] hover:bg-white py-3 px-4 border-2 border-[#e0e0e0] rounded-lg text-[15px] bg-[#f9f9f9] transition-all">
                                    <?php while (
                                        $productrow = mysqli_fetch_assoc(
                                            $productResult,
                                        )
                                    ) { ?>
                                        <option value="<?php echo $productrow[
                                            "product_id"
                                        ]; ?>">
                                            <?php echo $productrow[
                                                "name"
                                            ]; ?></option>
                                       <?php } ?>
                                    <option value="0">None of the above</option>
                            </select>
                        </div>
                            <div id="optionalproductName" class="hidden  flex-col">
                            <label for="medicineName" class="font-base font-semibold mb-2 text-[#555]">Medicine name(if not available)</label>
                            <input disabled name="medicineName" placeholder="Enter medicine name" onfocus="insert(event)" required id="medicineName" type="text" class=" outline-none focus:border-[#00bfa5] hover:bg-white py-3 px-4 border-2 border-[#e0e0e0] rounded-lg text-[15px] bg-[#f9f9f9] transition-all" />
                            </div>
                    </div>
                    <div id="optionalCategory" class="hidden mb-2 w-full gap-5">
                        <div class="flex w-full flex-col">
                          <label for="productCategory" class="font-base font-semibold mb-2 text-[#555]">Category</label>
                            <select name="productCategory" onchange="selectCategory(event)" id="productCategory" class="outline-none focus:border-[#00bfa5] hover:bg-white py-3 px-4 border-2 border-[#e0e0e0] rounded-lg text-[15px] bg-[#f9f9f9] transition-all">
                                <?php while (
                                    $categoryrow = mysqli_fetch_assoc(
                                        $categoryResult,
                                    )
                                ) { ?>
                                    <option value="<?php echo $categoryrow[
                                        "category_id"
                                    ]; ?>">
                                        <?php echo $categoryrow[
                                            "category"
                                        ]; ?></option>
                                   <?php } ?>
                                <option value="0">None of the above</option>
                        </select>
                        </div>
                        <div id="optionalproductCategory" class="hidden  flex-col">
                        <label for="medicineCategory" class="font-base font-semibold mb-2 text-[#555]">Category</label>
                        <input disabled name="medicineCategory" placeholder="Enter medicine category" onfocus="insert(event)"  id="medicineCategory" type="text" class=" outline-none focus:border-[#00bfa5] hover:bg-white py-3 px-4 border-2 border-[#e0e0e0] rounded-lg text-[15px] bg-[#f9f9f9] transition-all" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-5" >
                        <div class="flex flex-col">
                            <label for="unit_price" class="font-base font-semibold mb-2 text-[#555]">Unit price</label>
                            <input name="unit_price" onfocus="insert(event)" required id="unit_price" type="text" class="outline-none focus:border-[#00bfa5] hover:bg-white py-3 px-4 border-2 border-[#e0e0e0] rounded-lg text-[15px] bg-[#f9f9f9] transition-all" />
                        </div>
                        <div class="flex flex-col">
                            <label for="stock" class="font-base font-semibold mb-2 text-[#555]">Stock</label>
                            <input name="stock" onfocus="insert(event)" required id="stock" type="text" class="outline-none focus:border-[#00bfa5] hover:bg-white py-3 px-4 border-2 border-[#e0e0e0] rounded-lg text-[15px] bg-[#f9f9f9] transition-all" />
                        </div>
                    </div>

                    <div class="flex flex-col mb-5 ">
                        <label for="description" class="font-base font-semibold mb-2 text-[#555]">Description</label>
                        <textarea name="description" onfocus="insert(event)" required id="description" class="outline-none focus:border-[#00bfa5] hover:bg-white py-3 px-4 border-2 border-[#e0e0e0] rounded-lg text-[15px] bg-[#f9f9f9] transition-all" ></textarea>
                    </div>
                </div>

                <div class="mb-10">
                    <h3 class="text-lg font-semibold text-[#333] mb-5 pb-2 border-b-2 border-[#f0f0f0]">Pictures</h3>
                        <div class="flex flex-col">
                            <label for="docs" class="font-base font-semibold mb-2 text-[#555]">Medicine picture (*.jpg, *.png)</label>
                            <input name="docs" id="docs" type="file" accept=".jpg, .png" class="outline-none focus:border-[#00bfa5] hover:bg-white py-3 px-4 border-2 border-[#e0e0e0] rounded-lg text-[15px] bg-[#f9f9f9] transition-all" />
                        </div>
                </div>
            </form>
    </div>
