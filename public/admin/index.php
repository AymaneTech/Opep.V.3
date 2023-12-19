
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once '../../config/database.php';
    include '../../models/UserModel.php';
    require_once '../../views/usersView.php';
    require_once '../includes/head.php';
    $statistics = statistics();
    ?>
    <title>Dashboard | Home</title>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <?php
        include '../includes/admin-sidebar.php';

        include '../includes/admin-nav.php';
        ?>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                
                <div class="card">
                    <div>
                        <div class="numbers"><?= $statistics["allResult"] ?></div>
                        <div class="cardName">All users</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers"><?=$statistics["adminResult"] ?></div>
                        <div class="cardName">All admins</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?= $statistics["clientResult"] ?></div>
                        <div class="cardName">All clients</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Users</h2>
                    
                        <div class="dropdown">
                            <a  onclick="myFunction()" class="dropbtn btn">View All</a>
                            <div id="myDropdown" class="dropdown-content">
                                <a href="./">View All</a>
                                <a href="./?viewId=1">Admins</a>
                                <a href="./?viewId=2">Clients</a>
                            </div>
                        </div>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Email</td>
                                <td>User Type</td>
                                <td>date</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php        
                            if(!isset($_GET["viewId"])){
                                showAllUsers();
                            }
                            if (isset($_GET["viewId"]) && $_GET["viewId"] == "1"){
                                showAdmins();
                            }else if (isset($_GET["viewId"]) && $_GET["viewId"]== "2"){
                                showClients();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- =========== Scripts =========  -->
    <script src="../assets/js/main.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>