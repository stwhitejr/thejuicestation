<?php
require_once('controllers/base_controller.php');
// require_once('models/pages_model.php');
  class Pages_Controller extends Base_Controller {
    
    protected $view_path ='pages/';

    public function index() {
      $this->page_title = 'home';
      $this->page = 'index';
      return $this->get_view();
    }

    public function about() {
      $this->page_title = 'about';
      $this->page = 'about';
      return $this->get_view();
    }

    // A more dynamic example that might be useful later
    // public function about() {
    //   $model = new Pages_Model('about');
    //   $this->content = $model->page_data;
    //   $this->page_title = 'about';
    //   $this->content_view = get_view_path('pages/about');
    //   return $this->get_view();
    // }

    public function error() {
      $this->page_title = 'This is my page title for error';
      $this->content_view = 'views/pages/error';
      return $this->get_view();
    }
  }
?>