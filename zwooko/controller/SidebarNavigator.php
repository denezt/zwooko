<?php

class SidebarNavigator {
    private $navbarList;

    public function __construct($navbarList){ 
        $this->navbarList = $navbarList;
    }
    
    public function displayNavData($activate_route){
        $arrList = $this->navbarList;
        foreach($arrList as $url_path=>$nav_name) {
            $current_route = explode("=", $url_path);
            // echo $current_route[1] ." === ". $activate_route ."<br>";
            $highlighted = ($current_route[1] === $activate_route) ? 'selected' : '';
            echo '<a class="list-group-item list-group-item-action list-group-item-light p-3 '.$highlighted.'" href="'. $url_path .'">'. $nav_name .'</a>';
        }
    }
}
?>
