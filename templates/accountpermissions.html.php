<?php if ($user->getPermission(\Ijdb\Entity\User::EDIT_ACCOUNTS)): ?>
    <main class="home">
        <h2>Edit <?=$users->username?>’s Permissions</h2>
        <!-- Code from PHP & MySQL: Novice to Ninja 6th Edition -->
        <form action="/user/permissions" method="POST">
            <?php foreach ($permission as $name => $value): ?> <!-- Display permissions -->
                <div>
                    <input type="hidden" name="id" value="<?=$users->id?>"/>
                    <label><?=$name?></label><input name="permission[]" type="checkbox" value="<?=$value?>"<?php if ($users->getPermission($value)): echo 'checked'; endif; ?> />
                </div>
            <?php endforeach; ?>
            <input type="submit" value="Submit" />
        </form>
    </main>
<?php else: ?>
    <p>You do not have permission to access this page.</p>
<?php endif; ?>