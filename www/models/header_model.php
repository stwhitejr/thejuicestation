<?php
  class Header_Model {

    public function get_nav() {
      $nav_items = [];
      $nav_items['home']['url'] = 'home_url';
      $nav_items['home']['text'] = 'home';
      $nav_items['about']['url'] = 'about_url';
      $nav_items['about']['text'] = 'about';
      $nav_items['menu']['url'] = 'menu_url';
      $nav_items['menu']['text'] = 'menu';
      $nav_items['cleanses']['url'] = 'cleanses_url';
      $nav_items['cleanses']['text'] = 'cleanses';
      $nav_items['delivery_service']['url'] = 'delivery_service_url';
      $nav_items['delivery_service']['text'] = 'delivery&nbsp;service';
      $nav_items['location']['url'] = 'location_url';
      $nav_items['location']['text'] = 'location';
      return $nav_items;
    }
  }
?>