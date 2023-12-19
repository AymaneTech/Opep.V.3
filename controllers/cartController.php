<?php
require_once '../models/OrderModel.php';
session_start();
require_once '../config/database.php';
require_once '../models/cartPivotModel.php';

$cartId = $_SESSION["user"]["cartId"];
if (isset($_GET["plantId"])) {
    $plantId = $_GET["plantId"];
    $cartPivot = new CartPivot();
    $cartPivot->insertIntoCart($plantId, $cartId);
}

if (isset($_POST["checkoutOne"])) {
    $pivotFk = $_POST["pivotFk"];
    $totalPrice = $_POST["price"];
    $order = new Order();
    $order->__set("pivotFk", $pivotFk);
    $order->__set("totalPrice", $totalPrice);
    $order->makeOrder();
    header("location: ../public/client/shoopingCart.php");
    echo "<script>alert('plant checked successfully');</script>";
    exit();
}
//if (isset($_POST["arrayOfCarts"])) {
//    $orderObject = new Order();
//    $encodedArray = $_POST['arrayOfCarts'];
//    $decodedArray = urldecode($encodedArray);
//    parse_str($decodedArray, $cartArray);
//
//    foreach ($cartArray as $a) {
//        $temp = (int)$a["cartId"];
//        $totalPrice = (int)$_POST["total"];
//        $orderObject->__set("pivotFk", $temp);
//        $orderObject->__set("totalPrice", $totalPrice);
//        $orderObject->makeOrder();
//        header("location: ../public/client/shoopingCart.php?msg=checked");
//    }
//
//}