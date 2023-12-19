<?php
require_once '../../config/database.php';
include '../../models/PlantModel.php';
include '../../models/CategoryModel.php';
require_once '../includes/head.php';
require '../../views/plantView.php';
?>

<!doctype html>
<html lang="en">
<head>
    <?php include_once '../includes/head.php' ?>
    <title>Opep | Home</title>
</head>
<body>
<?php include_once '../includes/client-nav.php' ?>

<section class="relative"
         style="background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%,rgba(0,0,0,0.3) 100%), url('../assets/imgs/hero.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="absolute inset-0 bg-white/75 sm:bg-transparent sm:from-white/95 sm:to-white/25 ltr:sm:bg-gradient-to-r rtl:sm:bg-gradient-to-l"></div>

    <div class="text-white relative mx-auto max-w-screen-xl px-4 py-32 sm:px-6 lg:flex lg:h-screen lg:items-center lg:px-8">
        <div class="max-w-xl text-center ltr:sm:text-left rtl:sm:text-right">
            <h1 class="text-3xl font-extrabold sm:text-5xl">
                Let us find your
                <strong class="text-white block font-extrabold"> Forever Home. </strong>
            </h1>

            <p class="mt-4 max-w-lg sm:text-xl/relaxed">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt illo tenetur fuga ducimus
                numquam ea!
            </p>

            <div class="mt-8 flex flex-wrap gap-4 text-center">
                <a
                        href="#"
                        class="block w-full rounded bg-green-600 px-12 py-3 text-sm font-medium text-white shadow hover:bg-green-700 focus:outline-none focus:ring active:bg-green-500 sm:w-auto"
                >
                    Get Started
                </a>
            </div>
        </div>
    </div>
</section>

<div id="products" class="product-header flex justify-center items-center flex-col gap-10">
    <h2 style="font-size:50px;" class="font-black mt-20">Our Products</h2>
    <div class="flex justify-center">
        <?php filterPlants() ?>
        <?php require_once '../includes/searchBar.php' ?>
    </div>
</div>
<div class="container-fluid flex justify-center flex-wrap mt-20 gap-10" id="test">
    <?php
        displayProducts();
    ?>
</div>

<?php require_once '../includes/clientFooter.php'; ?>
<script src="../assets/js/cart.js"></script>
</body>
</html>