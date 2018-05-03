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

    public $id = CONTROLLER_ID_PAGES;
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
      $this->page_id = PAGE_ID_HOME;
      $this->page_model->page_title = 'The Juice Station';
      $this->page_model->css_files = ['home'];
      if (isset($_GET['email_signup'])) {
        $this->page_model->email_signup($_GET['email_signup']);
      }
      $this->view = new Home_View($this->page_model);
    }

    /**
     * Intialize about view
     *
     * @return void
     */
    public function about() {
      require_once('views/pages/about_view.php');
      $this->page_model = new Pages_Model();
      $this->page_model->page_id = PAGE_ID_ABOUT;
      $this->page_model->page_title = 'The Juice Station';
      $this->page_model->css_files = ['about'];
      $this->page_model->js_files = ['about'];
      $this->view = new About_View($this->page_model);
    }

    /**
     * Intialize menu view
     *
     * @return void
     */
    public function menu() {
      require_once('views/pages/menu_view.php');
      $this->page_model = new Pages_Model();
      $this->page_model->page_id = PAGE_ID_MENU;
      $this->page_model->page_title = 'The Juice Station';
      $this->page_model->css_files = ['menu'];
      $this->view = new Menu_View($this->page_model);
    }

    /**
     * Intialize cleanses view
     *
     * @return void
     */
    public function cleanses() {
      require_once('views/pages/cleanses_view.php');
      $this->page_model = new Pages_Model();
      $this->page_model->page_id = PAGE_ID_CLEANSES;
      $this->page_model->page_title = 'The Juice Station';
      $this->page_model->css_files = ['cleanses'];
      $this->view = new Cleanses_View($this->page_model);
    }

    /**
     * Intialize deliveries view
     *
     * @return void
     */
    public function deliveries() {
      require_once('views/pages/deliveries_view.php');
      $this->page_model = new Pages_Model();
      $this->page_model->page_id = PAGE_ID_DELIVERY_SERVICE;
      $this->page_model->page_title = 'The Juice Station';
      $this->page_model->css_files = ['deliveries'];
      $this->page_model->js_files = ['deliveries'];
      if (isset($_POST['delivery_request'])) {
        $this->page_model->delivery_request();
      }
      $this->view = new Deliveries_View($this->page_model);
    }

    /**
     * Intialize error view
     *
     * @return void
     */
    public function error() {
      require_once('views/pages/error_view.php');
      $this->page_model = new Pages_Model();
      $this->page_model->page_title = 'The Juice Station';
      $this->page_model->css_files = ['error'];
      $this->view = new Error_View($this->page_model);
    }
  }
?>