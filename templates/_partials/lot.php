<?php

/** @var array $lot */

?>
<li class="lots__item lot">
    <div class="lot__image">
        <img
            src="./uploads/<?= esc($lot['photo_path']) ?>"
            width="350"
            height="260"
            alt="<?= esc($lot['title']) ?>"
        >
    </div>
    <div class="lot__info">
        <span class="lot__category"><?= esc($lot['category_name']) ?></span>
        <h3 class="lot__title">
            <a
                class="text-link"
                href="lot.php?id=<?= esc($lot['id']) ?>"
            ><?= esc($lot['title']) ?></a>
        </h3>
        <div class="lot__state">
            <div class="lot__rate">
                <span class="lot__amount">Стартовая цена</span>
                <span class="lot__cost">
                    <?= escCost($lot['start_price'])?><b class="rub">р</b>
                </span>
            </div>
            <div class="lot__timer timer" data-deadline="<?= esc($lot['deadline']) ?>"><?= esc($lot['deadline']) ?></div>
        </div>
    </div>
</li>
