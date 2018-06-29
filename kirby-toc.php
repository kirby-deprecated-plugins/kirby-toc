<?php
include __DIR__ . '/lib/core.php';
include __DIR__ . '/lib/filters.php';
include __DIR__ . '/lib/methods.php';

/*
DOCS
----
Ej hoppa flera levels

$TOC = new TOC();
echo $TOC->list($html);
echo $TOC->list($page->text()->kt());

Byter inte ut id om id redan är satt
*/