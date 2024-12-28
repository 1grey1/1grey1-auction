<?php

/** @var array  $bets */
/** @var string $categoryList */
/** @var array  $lot */
/** @var array  $errors */
/** @var ?array $user */

?>
<?= $categoryList ?>

<section class="lot-item container">
    <h2><?= esc($lot['title']) ?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img
                    src="uploads/<?= esc($lot['photo_path']) ?>"
                    width="730"
                    height="548"
                    alt="<?= esc($lot['title']) ?>"
                >
            </div>
            <p class="lot-item__category">Категория: <span><?= esc($lot['category_name']) ?></span></p>
            <p class="lot-item__description"><?= esc($lot['description']) ?></p>
        </div>
        <div class="lot-item__right">
            <div class="lot-item__state">
                <div class="lot-item__timer timer" style="width: fit-content;" data-deadline="<?= esc($lot['deadline']) ?>"><?= esc($lot['deadline']) ?></div>
                <div class="lot-item__cost-state">
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost"><?= escCost($lot['start_price']) ?></span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?= escCost($lot['bet_step']+$lot['start_price']) ?></span>
                    </div>
                </div>
                <?php $key = 'cost'; ?>
                <form
                    class="lot-item__form<?= isset($errors[$key]) ? ' form__item--invalid' : '' ?>"
                    action=""
                    method="post"
                    autocomplete="off"
                >
                    <p class="lot-item__form-item form__item">
                        <label for="<?= $key ?>">Ваша ставка</label>
                        <input
                            id="<?= $key ?>"
                            type="text"
                            name="<?= $key ?>"
                            placeholder="12 000"
                        >
                        <?php if (isset($errors[$key])): ?>
                            <span class="form__error"><?= $errors[$key] ?></span>
                        <?php endif; ?>

                    </p>
                    <button type="submit" class="button"<?= !isset($user) ? ' disabled' : '' ?>>Сделать ставку</button>
                </form>
            </div>
            <div class="history">
                <h3>История ставок (<span><?= count($bets) ?></span>)</h3>
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
