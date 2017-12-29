<?php
  /**
   */
  require_once('page_view.php');
  class Deliveries_View extends Page_View {

    private $template_name = 'deliveries';

    /**
     * Delivery request success/failure
     *
     * @return boolean
     */
    public function delivery_request() {
      return $this->model->delivery_request;
    }

    /**
     * Content
     *
     * @return string
     */
    public function content() {
      return $this->render_mustache($this->template_name, $this);
    }
  }
?>