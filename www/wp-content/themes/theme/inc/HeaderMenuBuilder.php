<?php
class HeaderMenuBuilder {
    private $menu_name;
    private $class_name;
    private $menu_items;

    // Конструктор, в который передается имя меню
    public function __construct($menu_name, $class_name) {
        $this->menu_name = $menu_name;
        $this->class_name = $class_name;
        $this->set_menu_items();
    }

    // Метод для установки меню элементов
    private function set_menu_items() {
        $locations = get_nav_menu_locations();
        if (isset($locations[$this->menu_name])) {
            $menu_id = $locations[$this->menu_name];
            $this->menu_items = wp_get_nav_menu_items($menu_id);
        } else {
            $this->menu_items = [];
        }
    }

    // Метод для построения дерева меню
    private function build_menu_tree($parent_id = 0) {
        $menu_tree = [];

        foreach ($this->menu_items as $item) {
            if ($item->menu_item_parent == $parent_id) {
                $menu_tree[] = [
                    'title'      => $item->title,
                    'url'        => $item->url,
                    'parent_id'  => $item->menu_item_parent,
                    'children'   => $this->build_menu_tree($item->ID)
                ];
            }
        }

        return $menu_tree;
    }

    // Метод для получения обработанного меню
    public function get_menu_tree() {
        return $this->build_menu_tree();
    }

    // Метод для рендеринга меню
    public function render_menu_tree($menu_tree = null) {
        if ($menu_tree === null) {
            $menu_tree = $this->get_menu_tree();
        }

        echo "<div class='{$this->class_name}'>";
        echo "<ul class='{$this->class_name}__list'>";
        foreach ($menu_tree as $item) {
            echo "<li class='{$this->class_name}__item'>";
            echo "<a class='{$this->class_name}__link' href=" . esc_url($item['url']) . ">" . esc_html($item['title']) . "</a>";
            if (!empty($item['children'])) {
                $this->render_menu_tree($item['children']);
            }
            echo "</li>";
        }
        echo "</ul>";
        echo "</div>";
        echo "<div class='header-menu__toggle'><img loading='lazy' data-src='". get_template_directory_uri().'/assets/img/spacex/menu-toggle.jpg' ."' width='48' height='48' src='data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==' alt=''></div>";
    }
}