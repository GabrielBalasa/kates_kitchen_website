<main class="home">
    <?php
        if (isset($error)): //Display errors if login failed
            echo '<div class="errors" style="color:red">' . $error . '</div>';
        endif;
    ?>
    <form action="/login" method="POST"> <!-- Login form -->
        <label>Username</label><input type="text" required name="username" />
        <label>Password</label>	<input type="password" required name="password" />
        <input type="submit" name="login" value="Log In" />
    </form>
</main>