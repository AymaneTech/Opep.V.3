<?php
function showTheme()
{
    $allThemes = new Theme();
    $result = $allThemes->showAllThemes();

    foreach ($result as $theme) {
        $id = $theme['themeId'];
        ?>
        <tr>
            <form action="../../controllers/mainController.php" method="post">
                <td>
                    <input type="hidden" name="themeId" value="<?= $theme["themeId"] ?>">
                    <div contenteditable="true"><?= $theme["themeId"] ?></div>
                </td>
                <td>
                    <?php echo "<img class='h-15 w-32' src='data:image/jpg;charset=utf8;base64," . base64_encode($theme['themeImage']) . "'>"; ?>
                </td>
                <td>
                    <input style="background: transparent;" type="text" name="themeName"
                           value="<?= $theme["themeName"] ?>">
                </td>
                <td>
                    <input style="background: transparent;" type="text" name="themeDesc"
                           value="<?= $theme["themeDesc"] ?>">
                </td>
                <td>
                    <button type="submit" name="updateTheme">Update</button>
                </td>
            </form>
            <td><a href="../../controllers/mainController.php/?deleteThemeId=<?= $id ?>">Delete</a></td>
        </tr>

    <?php }
}