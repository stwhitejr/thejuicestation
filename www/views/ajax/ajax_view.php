<?php
  /**
   * This contains all base level ajax items. Nothing specific should be here
   */
  class Ajax_View {

    private $model;
    private $content;

    public function __construct($model) {
      $this->model = $model;
    }
  }
?>