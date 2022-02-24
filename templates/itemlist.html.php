<main class="sidebar">
    <section class="left">
        <ul>
            <h4>Search by category</h4> <!-- List categories sidebar -->
            <?php foreach ($categories as $category): ?>
                <li><a href="/menu/list/category?id=<?=$category->id?>"><?=$category->name?></a><li>
            <?php endforeach; ?>
        </ul>
    </section>
    <section class="right">
        <ul class="listing"> <!-- List items -->
            <?php foreach ($menu as $item): ?>
                <li>
                    <div class="details">
                        <h2><?= $item->title ?></h2>
                        <h3>£<?= $item->price ?></h3>
                        <p><?=nl2br($item->description)?></p>
                    </div>
                </li>
            <?php endforeach; ?>
	    </ul>
    </section>
</main>