<?php


function showAllUsers()
{
    $allUsers = new User();
    $result = $allUsers->showAllUsers();

    foreach ($result as $user) {
        ?>
        <tr>
            <td><?= $user["firstName"] ?></td>
            <td><?= $user["lastName"] ?></td>
            <td><?= $user["email"] ?></td>

            <?php if ($user["userType"] == 1) { ?>
                    <td><span class="status admin">Admin</span></td>

            <?php } else { ?>
                    <td><span class="status client">Client</span></td>
            <?php } ?>
        </tr>

    <?php }
}

function showAdmins()
{
    $admins = new User();
    $result = $admins->showAdmins();

    foreach ($result as $user) {
        ?>
                <tr>
                    <td><?= $user["firstName"] ?></td>
                    <td><?= $user["lastName"] ?></td>
                    <td><?= $user["email"] ?></td>

                    <?php if ($user["userType"] == 1) { ?>
                                <td><span class="status admin">Admin</span></td>

                    <?php } else { ?>
                                <td><span class="status client">Client</span></td>
                    <?php } ?>
                </tr>

        <?php }
}
function showClients()
{
    $clients = new User();
    $result = $clients->showClients();

    foreach ($result as $user) {
        ?>
                        <tr>
                            <td><?= $user["firstName"] ?></td>
                            <td><?= $user["lastName"] ?></td>
                            <td><?= $user["email"] ?></td>

                            <?php if ($user["userType"] == 1) { ?>
                                            <td><span class="status admin">Admin</span></td>

                            <?php } else { ?>
                                            <td><span class="status client">Client</span></td>
                            <?php } ?>
                        </tr>

            <?php }
}

function statistics()
{
    $user = new User();
    return $user->statistics();
}