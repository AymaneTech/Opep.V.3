<?php

function showCategory()
{
    $allCategories = new Category();
    $result = $allCategories->showAllCategories();

    foreach ($result as $category) {
        $id = $category['categoryId'];
        ?>
        <tr>
            <form action="../../controllers/mainController.php" method="post">
                <td>
                    <input type="hidden" name="categoryId" value="<?= $category["categoryId"] ?>">
                    <div contenteditable="true"><?= $category["categoryId"] ?></div>
                </td>
                <td>
                    <input style="background: transparent;" type="text" name="categoryName" value="<?= $category["categoryName"] ?>">
                </td>
                <td>
                    <input style="background: transparent;" type="text" name="categoryDesc" value="<?= $category["categoryDesc"] ?>">
                </td>
                <td>
                    12
                </td>
                <td>
                    <button type="submit" name="updateCategory">Update</button>
                </td>
            </form>
            <td><a href="../../controllers/mainController.php/?deleteId=<?= $id ?>">Delete</a></td>
        </tr>


    <?php }

}
