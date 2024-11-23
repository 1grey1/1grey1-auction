<?php

/** @var int $page */
/** @var int $pageCount */

?>

<ul class="pagination-list">
    <li class="pagination-item pagination-item-prev<?= $page <= 1 ? ' disabled' : '' ?>">
        <a <?= $page > 1 ? ('href="index.php?page=' . ($page - 1) . '"') : '' ?>>Назад</a>
    </li>

    <?php for ($i = 1; $i <= $pageCount; $i++): ?>
        <li class="pagination-item<?= $page === $i ? ' pagination-item-active' : '' ?>">
            <a href="index.php?page=<?= $i ?>"><?= $i ?></a>
        </li>
    <?php endfor; ?>

    <li class="pagination-item pagination-item-next<?= $page >= $pageCount ? ' disabled' : '' ?>">
        <a <?= $page < $pageCount ? ('href="index.php?page=' . ($page + 1) . '"') : '' ?>>Вперед</a>
    </li>
</ul>