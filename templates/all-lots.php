<?php

/** @var string $lots */
/** @var string $categoryList */
/** @var string $paginationList */
/** @var string $category */

?>
<?= $categoryList ?>

<div class="container">
    <section class="lots">
        <h2>Все лоты в категории <span>«<?= $category ?>»</span></h2>
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
