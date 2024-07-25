<?php
class Walker_Nav_Footer extends Walker_Nav_Menu {

    private $depth_0_counter = 0;

    // Start Level
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $this->depth_0_counter++;

        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class='footer-menu__column'><div class='footer-menu__column-list'>\n";
    }

    // Start Element
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        $atts['href'] = (!empty( $item->url ) && $item->url != '#') ? $item->url : '';
        $title = $item->post_title;

        $href = (!empty($atts['href'])) ? "href='{$atts['href']}'" : '';

        if ($depth == 0) {
            $output .= "<li class='footer-menu__item footer-menu__item-depth-$depth'>";
            $output .= "<a class='footer-menu__link footer-menu__link-title' $href>$title</a>";
        } else {
            $output .= "<li class='footer-menu__item footer-menu__item-depth-$depth'>";
            $output .= "<a class='footer-menu__link' $href>$title</a>";
        }

    }

    // End Element
    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }

    // End Level
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
//        $output .= "$indent</div></ul>\n";

        // Check if we're at the last level and if it's depth 0
        if ($depth == 0 && $this->depth_0_counter == 2) {
            $output .= "$indent</div><a href='/' class='footer-menu__button'>Book a tour</a></ul>\n";
        } else $output .= "$indent</div></ul>\n";
    }
}