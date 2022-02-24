<?php if ($user->getPermission(\Ijdb\Entity\User::LIST_CLOSE_ANNOUNCEMENTS)): ?>
    <main class="sidebar">
        <?php require 'adminsidebar.html.php'; ?>
        <section class="right">
            <h2>Announcements</h2>
            <table>
                <thead>
                    <tr>
                        <th style="width: 10%">Username</th>
                        <th style="width: 10%">Title</th>
                        <th style="width: 10%">Date posted</th>
                        <th style="width: 70%">Details</th>
                    </tr>
                    <?php foreach ($announcements as $announcement) { ?> <!-- Display active announcements -->
                        <tr>
                            <td> <?= $announcement->getAdmin()->username ?> </td>
                            <td> <?= $announcement->title ?> </td>
                            <td> <?= $announcement->date_posted ?> </td>
                            <td> <?= $announcement->details ?> </td>
                            <td> 
                                <form action="/announcement/close" method="POST">
                                    <input type="hidden" name="announcement[id]" value="<?=$announcement->id?>"/>
                                    <input type="hidden" name="announcement[closed]" value="1"/>
                                    <input type="submit" name="complete" value="Approve">
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