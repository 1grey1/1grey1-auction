<?php

$categories = [];

/** @var $link */
foreach (getCategories($link) as $category) {
    $categories[] = $category;
}
