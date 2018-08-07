<?php
include __DIR__ . '/lib/core.php';

Kirby::plugin('jenstornell/toc', [
    'options' => [
        'auto' => true,
        'slug.method' => null
    ],
    'hooks' => [
        'kirbytags:after' => function ($text, array $data = [], array $options = []) {
            $TOC = new TOC();

            $text = Kirby\Cms\App::markdown($text);
            $text = $TOC->setIdToHeadings($text);

            if(option('jenstornell.toc.auto'))
                return $TOC->list($text) . "\n" . $text;
            
            return $TOC->insertTocList($TOC->list($text), $text);
        }
    ],
    'fieldMethods' => [
        'toc' => function($field) {
            $TOC = new TOC();
            $text = $TOC->setIdToHeadings($field->value);

            $field->value = (option('jenstornell.toc.auto')) ? $TOC->list($text) . "\n" . $text : $text;
            return $field;
        }
    ]
]);