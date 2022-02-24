<?php if ($user->getPermission(\Ijdb\Entity\User::LIST_CLOSE_BOOKINGS)): ?>
    <main class="sidebar">
        <?php require 'adminsidebar.html.php'; ?>
        <section class="right">
            <h2>Completed bookings</h2>
            <table>
                <thead>
                    <tr>
                        <th style="width: 30%">Name</th>
                        <th style="width: 30%">Email</th>
                        <th style="width: 10%">Phone</th>
                        <th style="width: 10%">Date</th>
                        <th style="width: 10%">Time</th>
                        <th style="width: 10%">Approved by</th>
                    </tr>
                    <?php foreach ($bookings as $booking) { ?> <!-- List approved bookings -->
                        <tr>
                            <td> <?= $booking->name ?> </td>
                            <td> <?= $booking->email ?> </td>
                            <td> <?= $booking->phone ?> </td>
                            <td> <?= $booking->date ?> </td>
                            <td> <?= $booking->time ?> </td>
                            <td> <?= $booking->getAdmin()->username ?> </td>
                        </tr>
                    <?php }  ?>
                <thead>
            </table>
        </section>
    </main>
<?php else: ?>
    <p>You do not have permission to access this page.</p>
<?php endif; ?>