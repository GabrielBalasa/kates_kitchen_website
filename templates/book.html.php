<?php 
    $tomorrow = strtotime("+1 day");
    $max = strtotime("+2 months");
    $date = date("Y-m-d", $tomorrow);
    $datemax = date("Y-m-d", $max);
 ?>
<main class="home">
    <p> If you would like to book a table with us you can add your booking below! </p>
    <form action="" method = "POST"> <!-- Booking form -->
        <input type="hidden" name="booking[id]" />
        <label>Your name</label>
        <input type="text" required pattern="[A-Za-z\s]{1,90}" name="booking[name]"/>
        <label>Your email address</label>
        <input type="email" required pattern="[a-z0-9._]+@[a-z0-9.-]+\.[a-z]{2,}$" name="booking[email]" />
        <label>Phone number (Optional)</label>
        <input type="text" name="booking[phone]" pattern="[0-9]" />
        <label>Date</label>
        <input type="date" name="booking[date]" id="userdate" min="<?=$date?>" max="<?=$datemax?>" required />
        <label>Time</label>
        <input type="time" name="booking[time]" id="time" required />
        <input type="submit" name="submit" value="Place booking">
    </form>
</main>