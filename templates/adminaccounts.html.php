<?php if ($user->getPermission(\Ijdb\Entity\User::EDIT_ACCOUNTS)): ?>
    <main class="sidebar">
        <?php require 'adminsidebar.html.php'; ?>
        <section class="right">
            <h2>Admin accounts management</h2>
            <table>
                <thead>
                    <tr>
                        <th style="width: 10%">Username</th>
                        <th style="width: 80%">&nbsp;</th>
                        <th style="width: 10%">&nbsp;</th>
                    </tr>
                    <?php foreach ($users as $admin) { ?>
                        <tr>
                            <td><?= $admin->username ?></td> <!-- Display admin accounts -->
                            <td>
                                <form action="/accounts/delete" method="POST">
                                    <input type="hidden" name="id" value="<?=$admin->id?>" />
                                    <input type="submit" name="delete" value="Delete" />
                                </form>
                            </td>
                            <td><a href="/user/permissions?id=<?=$admin->id;?>">Edit Permissions</a></td>
                        </tr>
                    <?php } ?>
                </thead>
            </table>
        </section>
    </main>
<?php else: ?>
    <p>You do not have permission to access this page.</p>
<?php endif; ?>