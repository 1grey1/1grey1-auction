<?php

/** @var string $categoryList */
/** @var ?array $bets */

?>
<?= $categoryList ?>

<section class="rates container">
    <h2>Мои ставки</h2>
    <table class="rates__list">
        <?php foreach ($bets as $bet): ?>
            <tr class="rates__item">
                <td class="rates__info">
                    <div class="rates__img">
                        <img src="uploads/<?= esc($bet['photo_path']) ?>" width="54" height="40">
                    </div>
                    <h3 class="rates__title"><a href="lot.php?id=<?= esc($bet['lot_id']) ?>"><?= esc($bet['name_lot']) ?></a></h3>
                </td>
                <td class="rates__category">
                    <?= esc($bet['category_name']) ?>
                </td>
                <td class="rates__timer">
                    <!--timer--finishing-->
                    <div class="timer" data-deadline="<?= esc($bet['deadline']) ?>"><?= esc($bet['deadline']) ?></div>
                </td>
                <td class="rates__price">
                    <?= escCost($bet['amount']) ?><b class="rub">р</b>
                </td>
                <td class="rates__time">
                    <?= esc($bet['created_at']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
