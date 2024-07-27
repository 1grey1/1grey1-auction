<?php

/** @var array $lots */

?>

<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <li class="promo__item promo__item--boards">
            <a class="promo__link" href="all-lots.php">Доски и лыжи</a>
        </li>
        <li class="promo__item promo__item--attachment">
            <a class="promo__link" href="all-lots.php">Крепления</a>
        </li>
        <li class="promo__item promo__item--boots">
            <a class="promo__link" href="all-lots.php">Ботинки</a>
        </li>
        <li class="promo__item promo__item--clothing">
            <a class="promo__link" href="all-lots.php">Одежда</a>
        </li>
        <li class="promo__item promo__item--tools">
            <a class="promo__link" href="all-lots.php">Инструменты</a>
        </li>
        <li class="promo__item promo__item--other">
            <a class="promo__link" href="all-lots.php">Разное</a>
        </li>
    </ul>
</section>

<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">

        <?php foreach ($lots as $lot): ?>
            <?= includeTemplate('_partials/lot.php', [
                'lot' => $lot,
            ]) ?>
        <?php endforeach; ?>

    </ul>
</section>
