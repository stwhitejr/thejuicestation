<?php
  class Header_Model {

    public function get_nav() {
      $nav_items = [];
      $nav_items['home']['url'] = 'home_url';
      $nav_items['home']['text'] = 'home text';
      $nav_items['about']['url'] = 'about_url';
      $nav_items['about']['text'] = 'about text';
      return $nav_items;
    }
  }
?>