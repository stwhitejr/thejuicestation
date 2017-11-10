<?php
  class PagesController {
    public function home() {
      $first_name = 'Jon';
      $last_name  = 'Snow';
      $page_title = 'This is my page title for home';
      require_once('views/pages/home.php');
    }

    public function error() {
      require_once('views/pages/error.php');
    }
  }
?>