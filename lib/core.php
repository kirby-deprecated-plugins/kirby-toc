<?php
class TOC {
    // Set ID to headings. Now the headings will be linkable with anchor hash
    public function setIdToHeadings($html) {
        $matches = $this->getHeadings($html);
        foreach($matches[1] as $item) {
            if(strpos($item, ' id=') !== false) continue;

            $html = str_replace(
                '>' . $item . '</h',
                ' id="' . $this->getSlug($item) . '">' . $item . '</h',
                $html
            );
        }
        return $html;
    }

    // Get slug from option or Kirby method
    private function getSlug($heading) {
        $method = option('jenstornell.toc.slug.method');
        if(is_callable($method))
            return call($method, $heading);
        return str::slug($heading);
    }

    // Generate table of content nested list
    public function list($html) {
        $matches = $this->getHeadings($html);
        $markdown = '';
    
        foreach($matches[1] as $key => $item) {
            $depth = substr($matches[0][$key], 2, 1) - 2;
            $spaces = str_repeat(' ' , $depth * 4);
            $markdown .= $spaces;
    
            $markdown .= '1. [' . $item . '](#' . $this->getSlug($item) . ')' . "\n";
        }
        $html = markdown($markdown);
        if(!empty($html)) {
            return '<div class="kirby-toc">' . markdown($markdown) . '</div>';
        }
    }

    // Insert table of content list to a replaceable string
    public function insertTocList($toc_list, $html) {
        return str_replace('{{ toc }}', $toc_list, $html);
    }

    // Get headings from html with regex
    private function getHeadings($html) {
        preg_match_all('|<h[^>]+>(.*)</h[^>]+>|iU', $html, $matches);
        return $matches;
    }
}