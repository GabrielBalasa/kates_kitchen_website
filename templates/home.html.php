<main class="home">
    <ul class="listing"> <!-- List latest announcements -->
        <?php foreach ($announcements as $announcement): ?>
            <li>
                <div class="details">
                    <h2><?= $announcement->title ?></h2>
                    <h4><?= $announcement->date_posted ?></h4>
                    <p><?=nl2br($announcement->details)?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</main>