<?php if ($user->getPermission(\Ijdb\Entity\User::LIST_CLOSE_BOOKINGS)): ?>
    <main class="sidebar">
        <?php require 'adminsidebar.html.php'; ?>
        <section class="right">
            <h2>Bookings</h2>
			<table>
                <thead>
                    <tr>
                        <th style="width: 30%">Name</th>
                        <th style="width: 30%">Email</th>
                        <th style="width: 20%">Phone</th>
                        <th style="width: 10%">Date</th>
                        <th style="width: 10%">Time</th>
                    </tr>
                    <?php foreach ($bookings as $booking) { ?> <!-- Dsiaply active bookins -->
                        <tr>
                            <td> <?= $booking->name ?> </td>
                            <td> <?= $booking->email ?> </td>
                            <td> <?= $booking->phone ?> </td>
                            <td> <?= $booking->date ?> </td>
                            <td> <?= $booking->time ?> </td>
                            <td> 
                                <form action="/booking/close" method="POST">
                                    <input type="hidden" name="booking[id]" value="<?=$booking->id?>"/>
                                    <input type="hidden" name="booking[closed]" value="1"/>
                                    <input type="submit" name="complete" value="Accept">
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