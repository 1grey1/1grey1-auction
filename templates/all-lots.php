<?php

/** @var string $lots */
/** @var string $categoryList */

?>
<?= $categoryList ?>

<div class="container">
    <section class="lots">
        <h2>Все лоты в категории <span>«Доски и лыжи»</span></h2>
        <ul class="lots__list">

            <?php foreach ($lots as $lot): ?>
                <?= includeTemplate('_partials/lot.php', [
                    'lot' => $lot,
                ]) ?>
            <?php endforeach; ?>

        </ul>
    </section>
    <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
        <li class="pagination-item pagination-item-active"><a>1</a></li>
        <li class="pagination-item"><a href="#">2</a></li>
        <li class="pagination-item"><a href="#">3</a></li>
        <li class="pagination-item"><a href="#">4</a></li>
        <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
    </ul>
</div>
