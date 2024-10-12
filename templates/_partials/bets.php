<?php

/** @var array $bet */

?>
<tr class="history__item">
    <td class="history__name"><?= esc($bet['user_name']) ?></td>
    <td class="history__price"><?= escCost($bet['amount']) ?> р</td>
    <td class="history__time"><?= date('Y-m-d', strtotime($bet['created_at'])) ?></td>
</tr>
