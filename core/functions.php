<?php

declare(strict_types=1);

function esc(string $string): string {
    return htmlspecialchars($string);
}
