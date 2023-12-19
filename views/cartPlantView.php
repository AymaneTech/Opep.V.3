<?php

$userId = $_SESSION['user']["userId"];
$cartPlants = new cartPivot();


function showCartPlants()
{
    global $userId;
    global $cartPlants;
    $plants = $cartPlants->retrieveCartPlants($userId);
    global $array;
    foreach ($plants as $plant) {
            $array[] = [
                'cartId' => $plant['cartFk']
            ]; ?>
        <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($plant['plantImage']) ?>" alt="product-image"
                 class="w-full rounded-lg sm:w-40"/>
            <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                <div class="mt-5 sm:mt-0">
                    <h2 class="text-lg font-bold text-gray-900"><?= $plant["plantName"] ?></h2>
                    <p class="mt-1 text-xs text-gray-700"><?= $plant["plantDesc"] ?></p>
                </div>
                <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                    <div class="flex items-center space-x-4">
                        <p class="text-sm">$<?= $plant["plantPrice"] ?></p>
                        <a href="../../controllers/mainController.php?deletePlant=<?=$plant["pivotId"]?>">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    </div>
                    <div>
                        <form method="post" action="../../controllers/cartController.php">
                            <input type="hidden" name="price" value="<?= totalPrice() ?>">
                            <input type="hidden" name="pivotFk" value="<?= $plant['pivotId'] ?>">
                            <button name="checkoutOne"
                                    class="mt-6 w-full rounded-md bg-green-500 py-1.5 px-10 font-medium text-blue-50 hover:bg-green-600">
                                Checkout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
function totalPrice()
{
    global $userId;
    global $cartPlants;
    $array = $cartPlants->totalPrice($userId);
    return $array["total"];
}



