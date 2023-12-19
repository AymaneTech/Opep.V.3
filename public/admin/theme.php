<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once '../../config/database.php';
    include '../../models/ThemeModel.php';
    require_once '../../views/ThemeView.php';
    require_once '../includes/head.php';
    //    $statistics = statistics();
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
                <div class="numbers"><? php// $statistics["allResult"] ?></div>
                <div class="cardName">All Themes</div>
            </div>

            <div class="iconBx">
                <ion-icon name="chatbubbles-outline"></ion-icon>
            </div>
        </div>
        <div class="card">
            <div>
                <div class="numbers"><? php// $statistics["adminResult"] ?></div>
                <div class="cardName">All admins</div>
            </div>

            <div class="iconBx">
                <ion-icon name="eye-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers"><? php// $statistics["clientResult"] ?></div>
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
                <h2>Themes</h2>
                <div class="flex align-items-center gap-4">
                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                            class="block text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">Add Theme
                    </button>
                </div>
            </div>

            <table>
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Image</td>
                    <td>Theme Name</td>
                    <td>Description</td>
                    <td>Update</td>
                    <td>Delete</td>
                </tr>
                </thead>
                <tbody>
                <?php
                showTheme();
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- add theme modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Create New Theme
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-200">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="../../controllers/mainController.php" method="post" enctype="multipart/form-data"
                  class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Theme name</label>
                        <input type="text" name="themeName" id="name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                               placeholder="Type product name" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <div class="col-span-1">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Theme Image</label>
                            <input type="file" name="themeImage" id="name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                   required="">
                        </div>
                    </div>
                    <div class="col-span-2 sm:col-span">
                        <div class="col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">theme
                                Description</label>
                            <textarea name="themeDesc" id="description" rows="4"
                                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Write product description here"></textarea>
                        </div>
                    </div>
                    <button name="addTheme" type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        Add new theme
                    </button>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalButton = document.querySelector('[data-modal-toggle="crud-modal"]');
        const modal = document.getElementById('crud-modal');

        modalButton.addEventListener('click', function () {
            modal.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        });
    });
</script>
<!-- =========== Scripts =========  -->
<script src="../assets/js/main.js"></script>
<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>