<?php if ($user->getPermission(\Ijdb\Entity\User::ADD_ACCOUNTS)): ?>
<main class="sidebar">
    <?php require 'adminsidebar.html.php'; ?>
    <section class="right">
        <h2>Create an admin account</h2>
        <form action="" method="POST"> <!-- New admin creation form -->
        <?php if (count($errors) > 0){ ?>
                <ul style="color: red;">
                    <?php foreach ($errors as $error){ ?>
                        <li class="textD"><?=$error?></li>
                    <?php } ?>
                </ul>
            <?php } ?>
            <input type="hidden" name="account[id]"/> 
            <input type="hidden" name="account[role]" value="admin"/>
            <label>Username</label><input type="text"  name="account[username]" value="<?= $account['username'] ?? ''?>" />
            <label>Password</label><input type="password"  name="account[password]" value="<?= $account['password'] ?? ''?>" />
            <input type="submit" name="register" value="Create account">
        </form>
    </section>
</main>
<?php else: ?>
    <p>You do not have permission to access this page.</p>
<?php endif; ?>