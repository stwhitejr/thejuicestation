<?php
// TODO set paths/namespace
  class Base_Controller {

    protected $page_title;
    protected $layout_view = '../views/base';
    protected $content;

    public function get_view() {
      $content = require_once('../' . $this->content . '_view.php');
      $page_title = $this->page_title;
      $header = header_content();
      $footer = footer_content();
      require_once('../' . $this->layout_view . 'view.php');
    }

    private function header_content() {
      return 'header content';
    }

    private function footer_content() {
      return 'footer content';
    }
  }
?>