<?php if ($user->getPermission(\Ijdb\Entity\User::EDIT_DELETE_ARCHIVE_MENU)): ?>
    <main class="sidebar">
        <?php require 'adminsidebar.html.php'; ?>
        <section class="right">
            <form action="/menu/edit" method="POST"> <!-- Edit/Add item form -->
                <input type="hidden" name="item[id]" value="<?= $item->id ?? ''?>"/>
                <input type="hidden" name="item[archived]" value="0"/>
                <input type="hidden" name="item[user_id]" value="<?=$item->user_id ?? ''?>"/>
                <label>Title</label>
                <input type="text" required pattern="[A-Za-z0-9\s]{1,90}" name="item[title]" value="<?=$item->title ?? ''?>" />
                <label>Description</label>
                <textarea name="item[description]"  required pattern="[A-Za-z0-9\s]{1,90}"><?=$item->description ?? ''?></textarea>
                <label>Price</label>
                <input type="text" name="item[price]" required pattern="[0-9]{1,5}[.]{1}[0-9]{2}" value="<?=$item->price ?? ''?>"/>
                <label>Select category</label>
                <select name="item[categoryId]">
                    <?php foreach ($categories as $category){ ?>
                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php } ?>
                </select>
                <input type="submit" name="submit" value="Confirm" />
            </form>
        </section>
    </main>
<?php else: ?>
    <p>You do not have the required permission.</p>
<?php endif; ?>