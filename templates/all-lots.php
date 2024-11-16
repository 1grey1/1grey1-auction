<?php

/** @var string $lots */
/** @var string $categoryList */
/** @var string $paginationList */
/** @var string $category */
/** @var ?string $searchQuery */

?>
<?= $categoryList ?>

<div class="container">
    <section class="lots">
        <?php if (!$searchQuery): ?>
            <h2>Все лоты в категории <span>«<?= esc($category) ?>»</span></h2>
        <?php else: ?>
            <h2>Результаты поиска по запросу «<span><?= esc($searchQuery) ?></span>»</h2>
        <?php endif; ?>

        <ul class="lots__list">

            <?php foreach ($lots as $lot): ?>
                <?= includeTemplate('_partials/lot.php', [
                    'lot' => $lot,
                ]) ?>
            <?php endforeach; ?>

        </ul>
    </section>
    <?= $paginationList ?>
</div>
