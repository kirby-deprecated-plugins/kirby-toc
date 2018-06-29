<?php
$filters = c::get('kirby.toc.filters', ['headings', 'auto']);

if(in_array('headings', $filters)) {

    // Set ID to headings. Now the headings will be linkable with anchor hash
    kirbytext::$post[] = function($kirbytext, $value) {
        $TOC = new TOC();
        return $TOC->setIdToHeadings($value);
    };
}

if(in_array('auto', $filters)) {

    // Generate table of content nested list
    // Insert table of content list at the top of the content
    kirbytext::$post[] = function($kirbytext, $value) {
        $TOC = new TOC();
        return $TOC->list($value) . "\n" . $value;
    };
}

if(in_array('tag', $filters)) {

    // Generate table of content nested list
    // Insert table of content list to a replaceable string
    kirbytext::$post[] = function($kirbytext, $value) {
        $TOC = new TOC();
        return $TOC->insertTocList($TOC->list($value), $value);
    };
}