<?php
require_once('models/pages_model.php');
  class Pages_Controller {

    public $view;
    public $page_model;
    public $ajax_content;

    /**
     * Intialize home view
     *
     * @return void
     */
    public function home() {
      require_once('views/pages/home_view.php');
      $this->page_model = new Pages_Model();
      $this->view = new Home_View($this->page_model);
    }

    /**
     * Ajax - Adds email to DB
     * Returns success or failure message
     *
     * @return string
     */
    public function email_signup() {
      $email = $_GET['email'];
      $this->page_model = new Pages_Model();
      if ($email) {
        $this->ajax_content = $this->page_model->coming_soon_signup($email);
      } else {
        return false;
      }
    }

    // public function error() {
    //   $this->page_title = 'This is my page title for error';
    //   $this->content_view = 'views/pages/error';
    //   return $this->get_view();
    // }
  }
?>