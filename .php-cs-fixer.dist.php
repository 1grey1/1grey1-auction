<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
;

return (new PhpCsFixer\Config())
    ->setRules([
        "binary_operator_spaces" => [
            "default" => "single_space",
            "operators" => [
                "=>" => "align_single_space_minimal"
            ]
        ],
    ])
    ->setFinder($finder);
