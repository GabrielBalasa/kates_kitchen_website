<main class="home">
    <p> Welcome to Kate's Kitchen, we're a family run restaurant in Northampton. Take a look around our site to see our menu!</p>
    <h2>Take a look at our menu:</h2>
    <ul class="noStyle">
        <?php foreach ($categories as $category){ ?> <!-- Display categories -->
            <li><a href="menu/list/category?id=<?= $category->id ?>"><?= $category->name ?></a></li>
        <?php } ?>
    </ul>
</main>