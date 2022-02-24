<section class="left"> <!-- Administration sidebar based on admin's permissions -->
    <ul>
        <?php if ($user->getPermission(\Ijdb\Entity\User::ADD_MENU)): ?>
            <h4>Menu</h4>
            <li><a href="/menu/manage/active">Active items</a></li>
            <li><a href="/menu/manage/archived">Archived items</a></li>
        <?php endif; ?>

        <?php if ($user->getPermission(\Ijdb\Entity\User::ADD_EDIT_DELETE_CATEGORIES)): ?>
            <h4>Categories</h4>
            <li><a href="/category/list">Manage categories</a></li>
        <?php endif; ?>

        <?php if ($user->getPermission(\Ijdb\Entity\User::LIST_CLOSE_BOOKINGS)): ?>
            <h4>Bookings</h4>
            <li><a href="/booking/active">Active bookings</a></li>
            <li><a href="/booking/closed">Closed bookings</a></li>
        <?php endif; ?>

        <?php if ($user->getPermission(\Ijdb\Entity\User::LIST_CLOSE_ANNOUNCEMENTS)): ?>
            <h4>Announcements</h4>
            <li><a href="/announcement/active">Active announcements</a></li>
            <li><a href="/announcement/closed">Closed announcements</a></li>
        <?php endif; ?>

        <?php if ($user->getPermission(\Ijdb\Entity\User::ADD_ACCOUNTS) || $user->getPermission(\Ijdb\Entity\User::EDIT_ACCOUNTS)): ?>
            <h4>Manage accounts</h4>
            <li><a href="/accounts/register">Create accounts</a></li>
        <?php endif; ?>

        <?php if ($user->getPermission(\Ijdb\Entity\User::EDIT_ACCOUNTS)): ?>
            <li><a href="/accounts/admin">Admin accounts</a></li>
        <?php endif; ?>
    </ul>
</section>