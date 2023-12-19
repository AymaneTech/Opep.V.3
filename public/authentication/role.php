<!DOCTYPE html>
<html lang="en">
<?php
include '../includes/head.php';
?>

<body>
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div
                class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
        </div>
        <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
            <div class="max-w-md mx-auto">
                <div>
                    <h1 class="text-2xl mb-5 font-semibold">Choose a Role for you</h1>
                </div>
                <div class="divide-y divide-gray-200">
                    <form method="post" action="../../controllers/mainController.php">
                        <div class="roleType">
                            <input name="role" id="admin" type="radio" value="1">
                            <label for="admin">Admin</label>
                        </div>
                        <div class="roleType">
                            <input  name="role" id="client" type="radio" value="2">
                            <label for="client">Client</label>
                        </div>
                        <button type="submit" name="roleType"
                                class="mt-5 block w-full bg-indigo-600 mt-4 py-2 rounded-2xl text-white font-semibold mb-2">Sign Up
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>