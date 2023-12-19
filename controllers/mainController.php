<?php
session_start();
require_once '../config/database.php';
require_once 'SignupController.php';
require_once 'LoginController.php';
require_once 'categoryController.php';
require_once 'PlantController.php';
require_once 'ThemeController.php';
require_once '../models/cartModel.php';
require_once '../models/cartPivotModel.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     --------------------------------------------------------------------
//    sign up request
    if (isset($_POST['signup'])) {
        $roleId = (int)$_POST['role'];
        $signupController = new SignupController($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'], $roleId);
        $lastInsertedId = $signupController->signupUser();

        if ($roleId == 2) {
            $cart = new Cart();
            $cart->createCart($lastInsertedId);
        }
        header('Location: ../public/authentication/login.php');
        exit();
    }
//     --------------------------------------------------------------------
    if (isset($_POST['login'])) {
        $loginController = new LoginController($_POST['email'], $_POST['password']);
        if (!$loginController->LoginUser()) {
            header('location: ../public/authentication/login.php?error=account does not exist');
            exit();
        }
        $userRow = $loginController->LoginUser();
        $_SESSION['user'] = $userRow;
        if ($userRow["userType"] == 1) {
            header('Location: ../public/admin');
            exit();
        } else if ($userRow["userType"] == 2) {
            $getCartId = new Cart();
            $array = $getCartId->retrieveUserCart($_SESSION['user']["userId"]);
            $cartId =$array["cartId"];
            $_SESSION['user']['cartId'] = $cartId;
            header('Location: ../public/client');
            exit();
        }
    }
    if(isset($_POST['logout'])){
        session_destroy();
        header('Location: ../public/authentication/login.php?msg=session_destroyed');
    }
    if (isset($_POST['addCategory'])) {
        $categoryController = new CategoryController();
        $categoryController->createCategory($_POST["categoryName"], $_POST["categoryDesc"]);
        header('Location: ../public/admin/category.php');
    }
//     --------------------------------------------------------------------
    if (isset($_POST["updateCategory"])) {
        $categoryController = new CategoryController();

        $categoryController->updateCategory($_POST["categoryName"], $_POST["categoryDesc"], $_POST["categoryId"]);
        header("Location: ../public/admin/category.php?msg=edited");
    }

//     --------------------------------------------------------------------
    if (isset($_POST["addPlant"])) {
        $tmp_name = $_FILES["plantImage"]["tmp_name"];
        $image = file_get_contents($tmp_name);
        $plantController = new PlantController();
        $plantController->__set("plantName", $_POST["plantName"]);
        $plantController->__set("plantDesc", $_POST["plantDesc"]);
        $plantController->__set("plantPrice", $_POST["plantPrice"]);
        $plantController->__set("categoryFk", $_POST["categoryId"]);
        $plantController->__set("plantImage", $image);

        $plantController->createPlant($_POST["plantName"], $_POST["plantDesc"], $_POST["plantPrice"], $image, $_POST["categoryId"]);
        header("Location: ../public/admin/plant.php?msg=plant_added");
    }
    //     --------------------------------------------------------------------
    if (isset($_POST["updatePlant"])) {
        $plantController = new PlantController();
        $plantController->updatePlant($_POST["plantId"], $_POST["plantName"], $_POST["plantDesc"], $_POST["plantPrice"]);
        header("Location: ../public/admin/plant.php?msg=edited");
    }


}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['deleteId'])) {
//        echo $_GET['deleteId'];
        $categoryController = new CategoryController();
        $categoryController->deleteCategory($_GET['deleteId']);
        header('Location: ../../public/admin/category.php?msg=deleted');
    }
    if (isset($_GET['deletePlantId'])) {
        echo $_GET['deleteId'];
        $plantController = new PlantController();
        $plantController->deletePlant($_GET['deletePlantId']);
        header('Location: ../../public/admin/plant.php?msg=deleted');
    }
    if (isset($_GET['deleteThemeId'])) {
        echo $_GET['deleteThemeId'];
        $themeController = new ThemeController();
        $themeController->deleteTheme($_GET['deleteThemeId']);
        header('Location: ../../public/admin/theme.php?msg=deleted');
    }
    if(isset($_GET['deletePlant'])){
        $pivot = new cartPivot();
        $pivot->deleteFromCart($_GET['deletePlant']);
        header('Location: ../../public/client/shoopingCart.php?msg=deleted');
    }
}

if(isset($_POST['addTheme'])){
    echo "here mother fucker";
    $tmp_name = $_FILES["themeImage"]["tmp_name"];
    $image = file_get_contents($tmp_name);
    $themeController = new ThemeController();

    $themeController->createTheme($_POST["themeName"], $_POST["themeDesc"], $image);
    header("Location: ../public/admin/theme.php?msg=theme_added");
}
if (isset($_POST["updateTheme"])) {
    $themeController = new ThemeController();
    $themeController->updateTheme($_POST["themeId"], $_POST["themeName"], $_POST["themeDesc"]);
    header("Location: ../public/admin/theme.php?msg=edited");
}