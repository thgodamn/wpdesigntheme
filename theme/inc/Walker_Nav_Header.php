<?php

class Walker_Nav_Header extends Walker_Nav_Menu {
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

        $active = '';
        if ( $item->current || $item->current_item_ancestor || $item->current_item_parent ) {
            $active = 'active'; // добавляем класс если элемент активен
        }

        $item_output = "<li class='header-menu__item'><a class='header-menu__link $active' $href>$title</a></li>";
        $output .= $item_output;
    }

    // End Element
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        // Do nothing
    }
}