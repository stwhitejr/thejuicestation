<?php

  require_once('models/ajax_model.php');
  class Ajax_Controller {

    public $id = CONTROLLER_ID_AJAX;
    public $view;
    public $ajax_model;

    /**
     * Add email to DB
     * Returns success or failure message
     *
     * @return string
     */
    public function email_signup() {
      $email = $_GET['email'];
      $this->ajax_model = new Ajax_Model();
      require_once('views/ajax/ajax_view.php');
      if ($email) {
        $this->view = new Ajax_View($this->ajax_model);
        $this->view->content = $this->ajax_model->email_signup($email);
      } else {
        return false;
      }
    }

  }
?>