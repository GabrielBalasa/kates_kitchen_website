<?php if ($user->getPermission(\Ijdb\Entity\User::ADD_EDIT_DELETE_CATEGORIES)): ?>
    <main class="sidebar">
        <?php require 'adminsidebar.html.php'; ?>
        <section class="right">
            <h2>Edit category</h2>
            <form action="" method="POST"> <!-- Edit/Add new category -->
                    <input type="text" hidden name="category[id]" value="<?=$category->id ?? ''?>"/>
                    <label>Name</label><input type="text" required pattern="[A-Za-z0-9\s]{1,90}" name="category[name]" value="<?=$category->name ?? ''?>" />
                    <input type="submit" name="save" value="Save Category" />
                </form>
        </section>
    </main>
<?php else: ?>
    <p>You do not have permission to access this page.</p>
<?php endif; ?>