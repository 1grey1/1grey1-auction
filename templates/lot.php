<?php

/** @var string $bets */
/** @var string $categoryList */

?>
<?= $categoryList ?>

<section class="lot-item container">
    <h2>DC Ply Mens 2016/2017 Snowboard</h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src="resources/img/lot-image.jpg" width="730" height="548" alt="Сноуборд">
            </div>
            <p class="lot-item__category">Категория: <span>Доски и лыжи</span></p>
            <p class="lot-item__description">
                Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив
                снег
                мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот
                снаряд
                отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом
                кэмбер
                позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется,
                просто
                посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла
                равнодушным.
            </p>
        </div>
        <div class="lot-item__right">
            <div class="lot-item__state">
                <div class="lot-item__timer timer">10:54</div>
                <div class="lot-item__cost-state">
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost">10 999</span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span>12 000 р</span>
                    </div>
                </div>
                <form class="lot-item__form" action="" method="post" autocomplete="off">
                    <p class="lot-item__form-item form__item form__item--invalid">
                        <label for="cost">Ваша ставка</label>
                        <input id="cost" type="text" name="cost" placeholder="12 000">
                        <span class="form__error">Введите наименование лота</span>
                    </p>
                    <button type="submit" class="button">Сделать ставку</button>
                </form>
            </div>
            <div class="history">
                <h3>История ставок (<span>10</span>)</h3>
                <table class="history__list">

                    <?php foreach ($bets as $bet): ?>
                        <?= includeTemplate('_partials/bets.php', [
                                'bet' => $bet,
                        ]) ?>
                    <?php endforeach; ?>

                </table>
            </div>
        </div>
    </div>
</section>
