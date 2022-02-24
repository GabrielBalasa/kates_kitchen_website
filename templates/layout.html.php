<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/styles.css"/>
		<title> <?=$title?> </title>
	</head>
	<body>
        <header>
            <section>
                <aside>
                    <h3>Opening times:</h3>
                    <p>Sun-Thu: 12:00-22:00</p>
                    <p>Fri-Sat: 12:00-23:30</p>
                </aside>
                <h1>Kate's Kitchen</h1>
            </section>
        </header>
        <nav> <!-- Main navigation menu -->
            <ul>
                <li><a href="/home">Home</a></li>
                <li>Menu
                    <ul>
                        <?php foreach($categories as $category): ?>
                            <li><a href="/menu/list/category?id=<?=$category->id?>"><?=$category->name?></a><li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li><a href="/about">About Us</a></li>
                <li><a href="/faq">FAQ</a></li>
                <li><a href="/book">Book</a></li>
                <?php if ($loggedIn): ?>
                    <li><a href="/announcement">Announcements</a></li>
                    <li><a href="/menu/manage/active">Administration</a></li>
                    <li><a href="/logout">Log out</a></li>
                <?php else: ?>
                    <li><a href="/login">Log in</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <img src="/images/randombanner.php"/>
        <?=$output?>
        <footer>
            <?php include 'footer.html.php'; ?>
        </footer>
    </body>
</html>