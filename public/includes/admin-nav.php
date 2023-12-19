<?php session_start();
if(!isset($_SESSION['user'])){
    header('Location: ../authentication/login.php');
    exit();
}
if($_SESSION['user']['userType'] !== '1'){
    header('Location: ../accessDenied.php');
}
?>
<div class="main">
    <div class="topbar">
        <div class="toggle">
            <ion-icon name="menu-outline"></ion-icon>
        </div>

        <div class="search">
            <label>
                <input type="text" placeholder="Search here">
                <ion-icon name="search-outline"></ion-icon>
            </label>
        </div>
        <div class="flex gap-10">
            <h2>
                Welcome
                <span class="font-bold text-2xl"><?= $_SESSION['user']['firstName'] ?></span>
            </h2>
            <div class="user">
                <img src="../assets/imgs/profile.jpg" alt="">
            </div>

        </div>
    </div>