<?php
require_once('models/header_model.php');
  class Base_Controller {

    protected $page_title;
    protected $layout_view = 'base';
    protected $page;
    protected $view_path;
    protected $content = [];

    public function get_view() {
      $page_title = $this->page_title;
      $header_model = new Header_Model();
      $nav_items = $header_model->get_nav();
      $footer = $this->footer_content();
      $content_view = get_view_path($this->view_path . $this->page);
      $content = $this->content;
      require_once(get_view_path($this->layout_view));
    }

    private function footer_content() {
      return 'footer content';
    }
  }
?>