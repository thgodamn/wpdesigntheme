<?php

class Walker_Nav_SubFooter extends Walker_Nav_Menu {
    // Start Level
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Do nothing, remove ul start
    }

    // End Level
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        // Do nothing, remove ul end
    }

    // Start Element
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $atts['href'] = (!empty($item->url) && $item->url != '#') ? $item->url : '';
        $title = apply_filters('the_title', $item->title, $item->ID);
        $href = (!empty($atts['href'])) ? "href='{$atts['href']}'" : '';

        $item_output = "<li class='footer-sub-menu__item'><a class='footer-sub-menu__link' $href>$title</a></li>";
        $output .= $item_output;
    }

    // End Element
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        // Do nothing
    }
}