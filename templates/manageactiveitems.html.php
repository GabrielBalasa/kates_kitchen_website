<main class="sidebar">
    <?php require 'adminsidebar.html.php'; ?>
    <section class="right">
        <?php if ($user->getPermission(\Ijdb\Entity\User::ADD_MENU)): ?>    
            <h2>Menu</h2>
            <h3><a class="new" href="/menu/edit">Add new item</a></h3>
            <div class="categorysearch">
                <h4>List by category</h4>
                <ul class="categories"> <!-- Display categories list -->
                    <?php foreach ($categories as $category): ?>
                        <li>
                            <a href="/menu/manage/active/category?id=<?=$category->id?>"><?= $category->name ?></a>
                        <li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th style="width: 15%">Category</th>
                        <th style="width: 10%">Price</th>
                        <th style="width: 5%">&nbsp</th>
                        <th style="width: 20%">&nbsp</th>
                        <th style="width: 5%">&nbsp</th>
                        <th style="width: 5%">&nbsp</th>
                    </tr>
                    <?php foreach ($menu as $item) { ?> <!-- Dsiaply active items -->
                        <?php if ($user->getPermission(\Ijdb\Entity\User::EDIT_DELETE_ARCHIVE_MENU)): ?>
                            <tr>
                                <td><?=$item->title ?></td>
                                <td><?=$item->getCategory()->name ?></td>
                                <td>£<?=$item->price ?> </td>
                                <td><a style="float: right" href="/menu/edit?id=<?= $item->id ?>">Edit</a></td>
                        <?php endif; ?>

                        <?php if ($user->getPermission(\Ijdb\Entity\User::EDIT_DELETE_ARCHIVE_MENU)):?>
                            <td>
                                <form method="POST" action="/menu/archive">
                                    <input type="hidden" name="menu[id]" value="<?= $item->id ?>" />
                                    <input type="hidden" name="menu[archived]" value="1"/>
                                    <input type="submit" name="archive" value="Archive"/>
                                </form>
                            </td>
                            <td>
                                <form  action="/menu/delete" method="POST">
                                    <input type="hidden" name="id" value="<?= $item->id ?>"/>
                                    <input type="submit" name="delete" value="Delete" />
                                </form>
                            </td>
                        <?php endif; ?>
                            </tr>
                    <?php	}  ?>
                    <?php else: ?> 
                    <p>You do not have the required permission to access this page.</p>
                    <?php endif; ?>
                </thead>
            </table>
    </section>
</main>



		