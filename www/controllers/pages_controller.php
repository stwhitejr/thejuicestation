<?php
require_once('controllers/base_controller.php');
require_once('models/pages_model.php');
  class Pages_Controller extends Base_Controller {

    protected $view_path ='pages/';

    public function index() {
      $email = $_GET['email'];
      if ($email) {
        $model =  new Pages_Model();
        $signUpMessage = $model->coming_soon_signup($email);
        echo $signUpMessage;
      } else {
        require_once(get_view_path($this->view_path . 'coming_soon'));
      }
    }

    public function about() {
      $this->page_title = 'about';
      $this->page = 'about';
      return $this->get_view();
    }

    public function error() {
      $this->page_title = 'This is my page title for error';
      $this->content_view = 'views/pages/error';
      return $this->get_view();
    }
  }
?>