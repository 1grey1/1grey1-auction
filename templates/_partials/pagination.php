<?php

/** @var int    $page */
/** @var int    $pageCount */
/** @var string $nameList */
/** @var ?int   $param */

?>

<ul class="pagination-list">
    <li class="pagination-item pagination-item-prev<?= $page <= 1 ? ' disabled' : '' ?>">
        <a <?= $page > 1 ? ('href="' . $nameList . '.php?page=' . ($page - 1) . (isset($param) ? '&' . $param : '') . '"') : '' ?>>Назад</a>
    </li>

    <?php for ($i = 1; $i <= $pageCount; $i++): ?>
        <li class="pagination-item<?= $page === $i ? ' pagination-item-active' : '' ?>">
            <a href="<?= $nameList ?>.php?page=<?= $i ?><?= isset($param) ? '&' . $param : '' ?>"><?= $i ?></a>
        </li>
    <?php endfor; ?>

    <li class="pagination-item pagination-item-next<?= $page >= $pageCount ? ' disabled' : '' ?>">
        <a <?= $page < $pageCount ? ('href="' . $nameList . '.php?page=' . ($page + 1) . (isset($param) ? '&' . $param : '') . '"') : '' ?>>Вперед</a>
    </li>
</ul>
