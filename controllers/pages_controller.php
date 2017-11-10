<?php
use Base_Controller;
  class Pages_Controller extends Base_Controller {
    public function index() {
      $this->page_title = 'This is my page title for home';
      $this->content = 'pages/index';
      return $this->get_view();
    }

    public function error() {
      $this->page_title = 'This is my page title for error';
      $this->content = 'pages/error';
      return $this->get_view();
    }
  }
?>