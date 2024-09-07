<?php

declare(strict_types=1);

function esc(string $string): string
{
    return htmlspecialchars($string);
}

function dump(array $array): void
{
    print('<pre>');
    print_r($array);
    print('</pre>');
    exit;
}
