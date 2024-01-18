<?php

class SidebarNavigator {
    private $navbarList;

    public function __construct($navbarList){ 
        $this->navbarList = $navbarList;
    }
    
    public function displayNavData(){
        $arrList = $this->navbarList;
        foreach($arrList as $url_path=>$nav_name) {
            echo '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="'. $url_path .'">'. $nav_name .'</a>';
        }
    }
}
?>
