<main class="home">
    <?php if ($user->getPermission(\Ijdb\Entity\User::LIST_CLOSE_ANNOUNCEMENTS)): ?>
        <h2>Announcement</h2>
        <form action="" method = "POST"> <!-- Announcement form -->
            <input type="hidden" name="announcement[id]"/>
            <input type="hidden" name="announcement[user_id]" value="<?=$user->id?>"/>
            <input type="hidden" name="announcement[date_posted]" value="<?=date("Y-m-d")?>"/>
            <label>Title</label>
            <input type="text"  name="announcement[title]" required />
            <label>Details</label>
            <textarea name="announcement[details]" required></textarea>
            <input type="submit" name="submit" value="Place announcement">
        </form>
    <?php else: ?>
        <p>You do not have permission to access this page.</p>
    <?php endif; ?>
</main>