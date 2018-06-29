<?php
field::$methods[c::get('kirby.toc.field.method.name', 'toc')] = function($field) {
    $TOC = new TOC();
    if(c::get('kirby.toc.auto', true))
        return $TOC->list($field->value) . "\n" . $TOC->setIdToHeadings($field->value);
    else
        return $TOC->setIdToHeadings($field->value);
};