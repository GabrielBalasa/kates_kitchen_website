<?php if ($user->getPermission(\Ijdb\Entity\User::ADD_EDIT_DELETE_CATEGORIES)): ?>
    <main class="sidebar">
        <?php require 'adminsidebar.html.php'; ?>
        <section class="right">
            <h2>Categories</h2>
            <a class="new" href="/category/edit">Add new category</a>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th style="width: 5%">&nbsp;</th>
                        <th style="width: 5%">&nbsp;</th>
                    </tr>
                    <?php foreach ($categories as $category) { ?> <!-- List categories -->
                        <tr>
                            <td><?= $category->name ?></td>
                            <td><a style="float: right" href="/category/edit?id=<?= $category->id ?>">Edit</a></td>
                            <td>
                                <form action="/category/delete" method="POST">
                                    <input type="hidden" name="id" value="<?=$category->id?>" />
                                    <input type="submit" name="delete" value="Delete" />
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </thead>
            </table>
        </section>
    </main>
<?php else: ?>
    <p>You do not have permission to access this page.</p>
<?php endif; ?>