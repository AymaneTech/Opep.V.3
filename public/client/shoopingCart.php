<?php
require_once '../../config/database.php';
include '../../models/cartPivotModel.php';
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once '../includes/head.php' ?>
    <title>Shooping Cart</title>
</head>

<style>
    @layer utilities {
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    }
</style>

<body>
<?php
require_once '../includes/client-nav.php';
require_once '../../views/cartPlantView.php';
?>
<div class="h-screen bg-gray-100 pt-20">
    <h1 class="mb-10 text-center text-2xl font-bold">Cart Items</h1>
    <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
        <div class="rounded-lg md:w-2/3">
            <?php
            $array = [];
            showCartPlants();
            ?>
        </div>
        <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
            <div class="flex justify-between">
                <p class="text-lg font-bold">Total</p>
                <div class="">
                    <p class="mb-1 text-lg font-bold">$<?= totalPrice() ?></p>
                    <p class="text-sm text-gray-700">Total price</p>
                </div>
            </div>
            <form method="post" action="../../controllers/cartController.php">
                <input name="total" type="hidden" value="<?=totalPrice()?>">
                <input name="arrayOfCarts" value="<?= urlencode(http_build_query($array)); ?>" type="hidden">
                <button name="checkoutAll" class="mt-6 w-full rounded-md bg-green-500 py-1.5 font-medium text-blue-50 hover:bg-green-600">Check
                    out All
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>