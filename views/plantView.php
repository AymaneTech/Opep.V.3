<?php
function showPlant()
{
    $allPlants = new Plant();
    $result = $allPlants->showAllPlant();
    if (isset($_GET['category'])) {
        $id = (int)$_GET['category'];
        $result = $allPlants->showByCategory($id);
    }
    foreach ($result as $plant) {
        $id = $plant['plantId'];
        ?>
        <tr>
            <form action="../../controllers/mainController.php" method="post">
                <td>
                    <input type="hidden" name="plantId" value="<?= $plant["plantId"] ?>">
                    <div contenteditable="true"><?= $plant["plantId"] ?></div>
                </td>
                <td>
                    <?php echo "<img class='h-15 w-32' src='data:image/jpg;charset=utf8;base64," . base64_encode($plant['plantImage']) . "'>"; ?>
                </td>
                <td>
                    <input style="background: transparent;" type="text" name="plantName"
                           value="<?= $plant["plantName"] ?>">
                </td>
                <td>
                    <input style="background: transparent;" type="text" name="plantDesc"
                           value="<?= $plant["plantDesc"] ?>">
                </td>
                <td>
                    <input style="background: transparent;" type="text" name="plantPrice"
                           value="<?= $plant["plantPrice"] ?>">
                </td>
                <td>
                    <input style="background: transparent;" type="text" name="plantPrice"
                           value="<?= $plant["categoryId"] ?>">
                </td>
                <td>
                    <button type="submit" name="updatePlant">Update</button>
                </td>
            </form>
            <td><a href="../../controllers/mainController.php/?deletePlantId=<?= $id ?>">Delete</a></td>
        </tr>

    <?php }
}

function selectCategories()
{
    $categories = new Category();
    $rows = $categories->showAllCategories();
    foreach ($rows as $cat) {
        ?>
        <option value="<?= $cat["categoryId"] ?>"><?= $cat["categoryName"] ?></option>
        <?php
    }
}

function filterByCategories()
{
    $categories = new Category();
    $rows = $categories->showAllCategories();
    foreach ($rows as $filter) {
        ?>
        <a href="./plant.php?category=<?= $filter['categoryId'] ?>"><?= $filter["categoryName"] ?></a>
        <?php
    }
}

function displayProducts()
{
    $allPlants = new Plant();
    $plants = $allPlants->showAllPlant();
    if (isset($_GET["searchInput"])) {
        $value = $_GET["searchInput"];
        $plants = $allPlants->searchByName($value);
    }

    if(isset($_GET["filterByCategory"])){
        $categoryId = $_GET["filterByCategory"];
        $plants = $allPlants->showByCategory($categoryId);

    }
    foreach ($plants as $plant) { ?>
        <div class="w-full max-w-sm bg-white border-none rounded-lg shadow-2xl dark:border-gray-700">
            <a href="#">
                <?php echo "<img class='h-64 w-full object-contain rounded-lg' src='data:image/jpg;charset=utf8;base64," . base64_encode($plant['plantImage']) . "'>"; ?>
            </a>
            <div class="px-5 py-5 pb-5">
                <a href="#">
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900"><?= $plant["plantName"] ?></h5>
                </a>
                <div class="flex items-center mt-2.5 mb-5">
                    <!-- Additional content here -->
                </div>
                <p class="my-3"><?= $plant["plantDesc"] ?></p>
                <div class="flex items-center justify-between gap-100">
                    <span class="text-3xl font-bold text-gray-900">$<?= $plant["plantPrice"] ?></span>
                    <button onclick="addToCart(<?= $plant['plantId'] ?>)" id="addToCart"
                            class="bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center text-white">Add to cart
                    </button>
                </div>
            </div>
        </div>
        <?php
    }
}

function filterPlants()
{
    $categories = new Category();
    $rows = $categories->showAllCategories();
    ?>
    <div class="text-xs mx-2 p-2 inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-green-200 text-green-700 rounded-full">
        <a href="./">View All</a>
    </div>
    <?php
    foreach ($rows as $filter) {
        ?>
        <div class="text-xs mx-2 p-2 inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-green-200 text-green-700 rounded-full">
            <a href="./?filterByCategory=<?= $filter["categoryId"]?>"><?= $filter["categoryName"] ?></a>
        </div>
        <?php
    }
}

/*onclick="filterByCategory(<?= $filter["categoryId"]?>)"*/