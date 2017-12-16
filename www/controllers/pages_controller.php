<?php
  // Page Constants
  CONST PAGE_ID_HOME             = 01;
  CONST PAGE_ID_ABOUT            = 02;
  CONST PAGE_ID_MENU             = 03;
  CONST PAGE_ID_CLEANSES         = 04;
  CONST PAGE_ID_DELIVERY_SERVICE = 05;
  CONST PAGE_ID_LOCATION         = 06;
  CONST PAGE_ID_BLOG             = 07;

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
      $this->page_model = new Pages_Model(PAGE_ID_HOME);
      $this->page_model->page_title = 'The Juice Station';
      $this->page_model->css_files = ['home'];
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
        $this->ajax_content = $this->page_model->email_signup($email);
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