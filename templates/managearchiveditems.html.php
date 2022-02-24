<main class="sidebar">
    <?php require 'adminsidebar.html.php'; ?>
    <section class="right">
        <h2>Archived items</h2>
        <?php if ($user): ?>
            <div class="categorysearch">
                <h4>List by category</h4> 
                <ul class="categories"> <!-- Display categories list -->
                    <?php foreach ($categories as $category): ?>
                        <li><a href="/menu/manage/archived/category?id=<?=$category->id?>"><?=$category->name?></a><li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <table>
                <thead>
                    <tr>
                        <th style="width: 30%">Title</th>
                        <th style="width: 20%">Category</th>
                        <th style="width: 10%">Price</th>
                        <th style="width: 20%">&nbsp</th>
                        <th style="width: 10%">&nbsp</th>
                        <th style="width: 5%">&nbsp</th>
                    </tr>
                    <?php foreach ($menu as $item){ ?> <!-- Display archived items -->
                        <tr>
                            <td> <?=$item->title ?></td>
                            <td> <?=$item->getCategory()->name ?></td>
                            <td> £<?=$item->price ?> </td>
                            <?php if ($user->getPermission(\Ijdb\Entity\User::EDIT_DELETE_ARCHIVE_MENU)): ?>
                                <td><a style="float: right" href="\menu\edit?id=<?= $item->id ?>">Edit and re-post</a></td>
                                <td>
                                    <form method="POST" action="\menu\delete">
                                        <input type="hidden" name="id" value="<?= $item->id ?>"/>
                                        <input type="submit" name="delete" value="Delete" />
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php } ?>
                </thead>
            </table>
        <?php endif; ?>
    </section>
</main>