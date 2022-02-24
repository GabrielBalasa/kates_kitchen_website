<?php if ($user->getPermission(\Ijdb\Entity\User::LIST_CLOSE_ANNOUNCEMENTS)): ?>
    <main class="sidebar">
        <?php require 'adminsidebar.html.php'; ?>
        <section class="right">
            <h2>Completed announcements</h2>
            <table>
                <thead>
                    <tr>
                        <th style="width: 10%">Username</th>
                        <th style="width: 10%">Title</th>
                        <th style="width: 10%">Date posted</th>
                        <th style="width: 70%">Details</th>
                    </tr>

                    <?php foreach ($announcements as $announcement) { ?> <!-- List approved announcements -->
                        <tr>
                            <td> <?= $announcement->getAdmin()->username ?> </td>
                            <td> <?= $announcement->title ?> </td>
                            <td> <?= $announcement->date_posted ?> </td>
                            <td> <?= $announcement->details ?> </td>
                        </tr>
                    <?php }  ?>
                <thead>
            </table>
        </section>
    </main>
<?php else: ?>
    <p>You do not have permission to access this page.</p>
<?php endif; ?>